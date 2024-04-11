<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Controller;

use App\Context\UsersManagement\Container\User\Action\RegisterUserAction;
use App\Context\UsersManagement\Container\User\Action\LoginUserWithPasswordAction;
use App\Context\UsersManagement\Container\User\Action\LogoutUserAction;
use App\Context\UsersManagement\Container\User\DTO\LoginWithPasswordDTO;
use App\Context\UsersManagement\Container\User\DTO\UserRegistrationDTO;
use App\Shared\Definition\BaseController;
use App\Shared\Definition\BaseException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class AuthenticationController extends BaseController
{
    public function registration(
        #[MapRequestPayload] UserRegistrationDTO $userRegistrationDTO,
        Request                                  $request,
        RegisterUserAction                       $registerUserAction
    ): Response
    {
        try {
            $userRegistrationDTO->validate($request);

            $data = json_decode($request->getContent(), true, 50);

            $result = $registerUserAction->run($data);

            return $this->json($result->result, 200);
        } catch (BaseException $e) {
            return $this->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Bad request'], 400);
        }
    }

    public function loginWithPassword(
        #[MapRequestPayload] LoginWithPasswordDTO $loginWithPasswordDTO,
        Request                                   $request,
        LoginUserWithPasswordAction               $loginUserAction,
    ): Response
    {
        try {
            $loginWithPasswordDTO->validate($request);

            $data = json_decode($request->getContent(), true);

            $result = $loginUserAction->run($data);

            return $this->json($result->result, 200);
        } catch (BaseException $e) {
            return $this->json(['error' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Bad request'], 400);
        }
    }

    public function loginWithCode(
        Request                     $request,
        LoginUserWithPasswordAction $loginUserAction,
        Security                    $security
    ): Response
    {
        try {
            $data = json_decode($request->getContent(), true);

            $result = $loginUserAction->run($data);

            return $this->json($result->result, 200);
        } catch (BaseException $e) {
            return $this->json(['error' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Bad request'], 400);
        }
    }

    public function logout(LogoutUserAction $logoutUserAction): Response
    {
        try {
            $result = $logoutUserAction->run();
            return $this->json($result->result, 200);
        } catch (BaseException $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Bad request'], 400);
        }
    }
}