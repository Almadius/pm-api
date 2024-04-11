<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Entity;

use App\Context\UsersManagement\Container\Role\Entity\RoleDoctrineEntity;
use App\Context\UsersManagement\Container\User\Repository\UserDoctrineRepository;
use App\Shared\Definition\BaseEntity;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @method int getId()
 * @method string getLogin()
 * @method string getPassword()
 * @method int getStatusId()
 * @method DateTime getCreatedAt()
 * @method DateTime getUpdatedAt()
 * @method DateTime getDeletedAt()
 * @method void setUuid(string $uuid)
 * @method void setLogin(string $login)
 * @method void setPassword(string $password)
 * @method void setStatusId(int $statusId)
 * @method void setUpdatedAt(DateTime $timestamp)
 * @method void setDeletedAt(DateTime $timestamp)
 * @method void setUserData(Collection $userData)
 */
#[ORM\Entity(repositoryClass: UserDoctrineRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\Index(columns: ["login"], name: "idx_login")]
#[ORM\Index(columns: ["status_id"], name: "idx_status_id")]
class UserDoctrineEntity extends BaseEntity
{
    #[ORM\ManyToMany(targetEntity: RoleDoctrineEntity::class, inversedBy: 'users', fetch: 'EAGER')]
    #[ORM\JoinTable(name: "roles_to_users")]
    protected Collection $roles;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserDataDoctrineEntity::class, cascade: ['persist', 'remove'], fetch: 'EAGER')]
    protected Collection $userData;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(type: "uuid", unique: true, nullable: false)]
    protected UuidInterface|string|null $uuid;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    protected string $login;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    protected ?string $password;

    #[ORM\Column(name: 'status_id', type: 'integer', length: 3, nullable: false)]
    protected int $statusId;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    protected DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    protected ?DateTime $updatedAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    protected ?DateTime $deletedAt;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->userData = new ArrayCollection();

        $this->createdAt = new DateTime();
    }

    public function getUuid(): string
    {
        return $this->uuid->toString();
    }
}