<?php

namespace App\Context\UsersManagement\Container\User\Action;

use App\Context\UsersManagement\Container\User\Task\UserFillDataByUuidTask;
use App\Context\UsersManagement\Container\User\Task\UserLogoutTask;
use App\Shared\Definition\BaseAction;
use App\Shared\Definition\ActionResult;
use Symfony\Bundle\SecurityBundle\Security;

final class LogoutUserAction extends BaseAction
{
    public function __construct(
        private readonly UserLogoutTask $userLogoutTask,
        private readonly UserFillDataByUuidTask $fillDataByUuidTask,
        private readonly Security $security,
    )
    {
    }

    public function run(array $data = []): ActionResult
    {
        try {
            $this->fillDataByUuidTask->run(['uuid' => $this->security->getUser()->getUuid()]);

            $this->userLogoutTask->run($data);
            return new ActionResult([
                'message' => 'Successfully logged out.'
            ]);
        } catch (\Exception $e) {
            return new ActionResult(['error' => $e->getMessage()], 400);
        }
    }
}
