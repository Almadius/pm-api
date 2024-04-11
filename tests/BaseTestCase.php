<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class BaseTestCase extends WebTestCase
{
    protected EntityManagerInterface $entityManager;

    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();

        $this->entityManager = $this->getContainer()->get(EntityManagerInterface::class);

        $this->entityManager->getConnection()->setNestTransactionsWithSavepoints(true);

        $this->entityManager->beginTransaction();
    }
}
