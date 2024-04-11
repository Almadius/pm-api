<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Context\UsersManagement\Container\User\Contract\UserRepositoryContract;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseTask;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

final class CredentialsCheckTask extends BaseTask
{
    private UserRepositoryContract $userRepository;
    private UserPasswordCheckTask $passwordCheckTask;

    public function __construct(UserRepositoryContract $userRepository, UserPasswordCheckTask $passwordCheckTask)
    {
        $this->userRepository = $userRepository;
        $this->passwordCheckTask = $passwordCheckTask;
    }

    public function run(array $data): UserModel
    {
        $user = $this->userRepository->filterUsersBy($data);

        if (!$user || !$this->passwordCheckTask->run((array)$user, $data['password'])) {
            throw new CustomUserMessageAuthenticationException('Invalid credentials.');
        }

        return $user;
    }
}