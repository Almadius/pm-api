<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Entity;

use App\Context\UsersManagement\Container\Role\Repository\RoleDoctrineRepository;
use App\Context\UsersManagement\Container\User\Entity\UserDoctrineEntity;
use App\Shared\Definition\BaseEntity;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method int getId();
 */
#[ORM\Entity(repositoryClass: RoleDoctrineRepository::class)]
#[ORM\Table(name: 'roles')]
class RoleDoctrineEntity extends BaseEntity
{
    #[ORM\ManyToMany(targetEntity: UserDoctrineEntity::class, mappedBy: 'roles')]
    protected Collection $users;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 60, nullable: false)]
    protected string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    protected string $description;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    protected ?DateTime $deletedAt = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
}