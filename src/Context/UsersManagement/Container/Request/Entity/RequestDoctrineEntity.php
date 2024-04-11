<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Request\Entity;

use App\Context\UsersManagement\Container\Request\Repository\RequestDoctrineRepository;
use App\Shared\Definition\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestDoctrineRepository::class)]
#[ORM\Index(columns: ["user_id"], name: "fk_users")]
#[ORM\Index(columns: ["content"], name: "idx_content")]
final class RequestDoctrineEntity extends BaseEntity
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        protected int $id,

        #[ORM\Column(type: 'binary', length: 16, nullable: false)]
        protected string $uuid,

        #[ORM\Column(type: 'integer', length: 11, nullable: false)]
        protected int $userId,

        #[ORM\Column(type: 'integer', length: 3, nullable: true)]
        protected int $typeId,

        #[ORM\Column(type: 'jsonb', nullable: false)]
        protected array $content,

        #[ORM\Column(type: 'integer', length: 3, nullable: true)]
        protected int $statusId,

        #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
        protected int $createdAt,

        #[ORM\Column(type: 'datetime', nullable: true)]
        protected int $deletedAt,
    ) {
    }
}