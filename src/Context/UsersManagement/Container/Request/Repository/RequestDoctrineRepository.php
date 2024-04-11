<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Request\Repository;

use App\Context\UsersManagement\Container\Request\Contract\RequestRepositoryContract;
use App\Context\UsersManagement\Container\Request\Entity\RequestDoctrineEntity;
use App\Context\UsersManagement\Container\Request\Model\RequestModel;
use App\Shared\Definition\BaseRepository;
use Doctrine\Persistence\ManagerRegistry;
final class RequestDoctrineRepository extends BaseRepository implements RequestRepositoryContract
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestDoctrineEntity::class);
    }

    public function createRequest(RequestModel $model): void
    {
        $entity = $model->getEntity();

        $this->getEntityManager()->persist($entity);
    }

    public function deleteRequest()
    {

    }

    public function getRequest()
    {
        // TODO: Implement getUser() method.
    }

    public function updateRequest()
    {
        // TODO: Implement updateUser() method.
    }

    public function getRequestsList()
    {
        // TODO: Implement getUserList() method.
    }
}