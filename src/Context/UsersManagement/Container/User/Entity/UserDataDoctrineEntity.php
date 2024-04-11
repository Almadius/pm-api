<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Entity;

use App\Context\UsersManagement\Container\Request\Repository\RequestDoctrineRepository;
use App\Shared\Definition\BaseEntity;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method array getContent()
 */
#[ORM\Entity]
#[ORM\Table(name: 'users_data')]
#[ORM\Index(columns: ["user_id"], name: "fk_users")]
#[ORM\Index(columns: ["content"], name: "idx_content")]
class UserDataDoctrineEntity extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: UserDoctrineEntity::class, inversedBy: 'userData')]
    protected UserDoctrineEntity $user;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(name: 'user_id', type: 'integer', length: 11, nullable: false)]
    protected ?int $userId;

    #[ORM\Column(type:"json", nullable: false, options:["jsonb" => true])]
    protected array $content;

    #[ORM\Column(name: 'status_id', type: 'integer', nullable: false, options: ['default' => 1])]
    protected int $statusId;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    protected DateTime $createdAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    protected ?DateTime $deletedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
}