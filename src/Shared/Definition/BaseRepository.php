<?php

declare(strict_types=1);

namespace App\Shared\Definition;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class BaseRepository extends ServiceEntityRepository
{
    protected bool $autoSync = true;

    public function turnOnAutoSync(): void
    {
        $this->autoSync = true;
    }

    public function turnOffAutoSync(): void
    {
        $this->autoSync = false;
    }
}