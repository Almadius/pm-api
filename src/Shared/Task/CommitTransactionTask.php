<?php

namespace App\Shared\Task;

use App\Shared\Definition\BaseTask;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CommitTransactionTask extends BaseTask
{
    public function __construct(
        #[Autowire(env: 'DB_DRIVER')]
        private readonly string $dbDriver,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function run(array $data = [])
    {
        if ($this->dbDriver === 'Doctrine') {
            $this->entityManager->commit();
        }
    }
}