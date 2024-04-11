<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Repository;

use App\Context\UsersManagement\Container\Role\Contract\RoleRepositoryContract;
use App\Context\UsersManagement\Container\Role\Entity\RoleDoctrineEntity;
use App\Context\UsersManagement\Container\Role\Factory\RoleDoctrineEntityFactory;
use App\Context\UsersManagement\Container\Role\Factory\RoleModelFactory;
use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Definition\BaseRepository;
use Doctrine\Persistence\ManagerRegistry;

final class RoleDoctrineRepository extends BaseRepository implements RoleRepositoryContract
{
    private readonly RoleDoctrineEntityFactory $roleDoctrineEntityFactory;

    public function __construct(
        ManagerRegistry           $registry,
        RoleDoctrineEntityFactory $roleDoctrineEntityFactory,
        RoleModelFactory $roleModelFactory,
    )
    {
        parent::__construct($registry, RoleDoctrineEntity::class);

        $this->roleDoctrineEntityFactory = $roleDoctrineEntityFactory;
        $this->roleModelFactory = $roleModelFactory;
    }

    public function createRole(RoleModel $model): RoleModel
    {
        /** @var RoleDoctrineEntity $entity */
        $entity = $this->roleDoctrineEntityFactory->build($model->toArray());

        $em = $this->getEntityManager();

        $em->persist($entity);

        if ($this->autoSync) {
            $em->flush();
        }

        $model->setId($entity->getId());

        return $model;
    }

    public function deleteRole(int $roleId): void
    {
        $em = $this->getEntityManager();

        $entity = $em
            ->createQueryBuilder()
            ->select('r')
            ->from(RoleDoctrineEntity::class, 'r')
            ->where('r.id = :id')
            ->setParameter('id', $roleId);

        $em->remove($entity);
    }

    public function filterRolesBy(array $filters): array
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('r')
            ->from(RoleDoctrineEntity::class, 'r');

        if (array_key_exists('id', $filters)) {
            $query
                ->andWhere('r.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (array_key_exists('name', $filters)) {
            $query
                ->andWhere('r.name = :name')
                ->setParameter('name', $filters['name']);
        }

        return array_map(
            function(RoleDoctrineEntity $roleDoctrineEntity) {
                $roleData = $roleDoctrineEntity->toArray();

                return $this->roleModelFactory->build($roleData);
            },
            $query->getQuery()->getResult()
        );
    }

    public function updateRole(RoleModel $model): RoleModel
    {
        $em = $this->getEntityManager();

        $entity = $em
            ->createQueryBuilder()
            ->select('r')
            ->from(RoleDoctrineEntity::class, 'r')
            ->where('r.id = :id')
            ->setParameter('id', $model->getId());

        $em->persist($entity);

        if ($this->autoSync) {
            $em->flush();
        }

        return $model;
    }

    public function syncWithDataSource(): void
    {
        if (!$this->autoSync) {
            $this->getEntityManager()->flush();
        }
    }
}