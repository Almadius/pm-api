<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Repository;

use App\Context\UsersManagement\Container\User\Factory\UserDataDoctrineEntityFactory;
use App\Context\UsersManagement\Container\User\Contract\UserRepositoryContract;
use App\Context\UsersManagement\Container\User\Entity\UserDataDoctrineEntity;
use App\Context\UsersManagement\Container\User\Entity\UserDoctrineEntity;
use App\Context\UsersManagement\Container\User\Enum\UserDataContentFieldKey;
use App\Context\UsersManagement\Container\User\Enum\UserDataStatus;
use App\Context\UsersManagement\Container\User\Enum\UserPersonalDataKey;
use App\Context\UsersManagement\Container\User\Factory\UserDoctrineEntityFactory;
use App\Context\UsersManagement\Container\User\Factory\UserModelFactory;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\ArrayShape;

final class UserDoctrineRepository extends BaseRepository implements UserRepositoryContract
{
    private readonly UserDoctrineEntityFactory $userDoctrineEntityFactory;
    private readonly UserModelFactory $userModelFactory;
    private readonly UserDataDoctrineEntityFactory $userDataDoctrineEntityFactory;

    public function __construct(
        ManagerRegistry               $registry,
        UserDoctrineEntityFactory     $userDoctrineEntityFactory,
        UserDataDoctrineEntityFactory $userDataDoctrineEntityFactory,
        UserModelFactory $userModelFactory,
    )
    {
        parent::__construct($registry, UserDoctrineEntity::class);

        $this->userDoctrineEntityFactory = $userDoctrineEntityFactory;
        $this->userDataDoctrineEntityFactory = $userDataDoctrineEntityFactory;
        $this->userModelFactory = $userModelFactory;
    }

    #[ArrayShape(['id' => 'int'])]
    public function createUser(UserModel $model): UserModel
    {
        $em = $this->getEntityManager();

        $entity = $this->userDoctrineEntityFactory->build(
            [
                ...$model->toArray(),
                'statusId' => $model->getStatus(),
            ]
        );

        $em->persist($entity);

        $entity->setUserData(new ArrayCollection(
            array_map(
                function ($personalDataKey) use ($model, $entity) {
                    $userDataEntity = $this->userDataDoctrineEntityFactory->build(
                        [
                            'content' => [
                                UserDataContentFieldKey::Key->value => $personalDataKey,
                                UserDataContentFieldKey::Value->value => $model->getPersonalData()[$personalDataKey],
                            ],
                            'statusId' => UserDataStatus::Active->value,
                        ]
                    );

                    $userDataEntity->setUser($entity);

                    return $userDataEntity;
                },
                array_keys($model->getPersonalData())
            )
        ));

        $em->persist($entity);

        if ($this->autoSync) {
            $em->flush();
        }

        $model->setId($entity->getId());

        return $model;
    }

    public function deleteUser(int $userId): void
    {
        $em = $this->getEntityManager();
        $user = $em->find(UserDoctrineEntity::class, $userId);
        if ($user) {
            $user->setDeletedAt(new \DateTime());
            $em->persist($user);

            if ($this->autoSync) {
                $em->flush();
            }
        }
    }

    public function updateUser(UserModel $model): void
    {
        // TODO: Implement updateUser() method.
    }

    public function syncWithDataSource(): void
    {
        if (!$this->autoSync) {
            $this->getEntityManager()->flush();
        }
    }

    public function filterUsersBy(array $filters): array
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('u')
            ->from(UserDoctrineEntity::class, 'u');

        if (array_key_exists('id', $filters)) {
            $query
                ->andWhere('u.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (array_key_exists('uuid', $filters)) {
            $query
                ->andWhere("u.uuid = :uuid")
                ->setParameter('uuid', $filters['uuid']);
        }

        if (array_key_exists('login', $filters)) {
            $query
                ->andWhere('u.login = :login')
                ->setParameter('login', $filters['login']);
        }

        if (array_key_exists('email', $filters)) {
            $query
                ->andWhere('CONTAINS(d.content, %:email%)')
                ->setParameter('email', $filters['email']);
        }

        if (array_key_exists('firstName', $filters)) {
            $query
                ->andWhere('CONTAINS(d.content, %:firstName%)')
                ->setParameter('firstName', $filters['firstName']);
        }

        if (array_key_exists('lastName', $filters)) {
            $query
                ->andWhere('CONTAINS(d.content, %:lastName%)')
                ->setParameter('lastName', $filters['lastName']);
        }

        return array_map(
            function (UserDoctrineEntity $userEntity) {
                $userData = array_reduce(
                    $userEntity->getUserData()->toArray(),
                    function (array $accum, UserDataDoctrineEntity $nextDataItem) {
                        $accum[$nextDataItem->getContent()[UserDataContentFieldKey::Key->value]]
                            = $nextDataItem->getContent()[UserDataContentFieldKey::Value->value];

                        return $accum;
                    },
                    []
                );

                return $this->userModelFactory->build(
                    [
                        'id' => $userEntity->getId(),
                        'login' => $userEntity->getLogin(),
                        'uuid' => $userEntity->getUuid(),
                        'password' => $userEntity->getPassword(),
                        'statusId' => $userEntity->getStatusId(),
                        'phone' => $userData[UserPersonalDataKey::Phone->value],
                        'email' => $userData[UserPersonalDataKey::Email->value],
                        'firstName' => $userData[UserPersonalDataKey::FirstName->value],
                        'lastName' => $userData[UserPersonalDataKey::LastName->value],
                    ]
                );
            },
            $query->getQuery()->getResult()
        );
    }
}