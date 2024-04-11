<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Model;

use App\Context\UsersManagement\Container\User\Entity\UserDoctrineEntity;
use App\Context\UsersManagement\Container\User\Enum\UserPersonalDataKey;
use App\Shared\Definition\BaseEntity;
use App\Shared\Parent\Model\UserParentModel;
use App\Shared\Support\Authenticator\Model\AuthenticatableUserModel;

/**
 * @property BaseEntity|UserDoctrineEntity $entity
 * @method int getId()
 * @method string getUuid()
 * @method int getStatus()
 * @method string getLogin()
 * @method string getPhone()
 * @method string getEmail()
 * @method string getLastName()
 * @method string getFirstName()
 * @method void setId(int $id)
 */
final class UserModel extends AuthenticatableUserModel
{
    protected int $id;

    protected string $login;

    protected string $firstName;

    protected string $lastName;

    protected string $email;

    protected string $phone;

    protected int $status;

    public function getPersonalData(): array
    {
        return [
            UserPersonalDataKey::FirstName->value => $this->getFirstName(),
            UserPersonalDataKey::LastName->value => $this->getLastName(),
            UserPersonalDataKey::Email->value => $this->getEmail(),
            UserPersonalDataKey::Phone->value => $this->getPhone(),
        ];
    }

    public function getPublicData(): array
    {
        return [
            'uuid' => $this->getUuid(),
            'login' => $this->getLogin(),
        ];
    }
}