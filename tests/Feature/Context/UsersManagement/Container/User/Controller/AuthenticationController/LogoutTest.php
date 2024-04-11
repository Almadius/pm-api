<?php

namespace Feature\Context\UsersManagement\Container\User\Controller\AuthenticationController;

use App\Kernel;
use App\Shared\Definition\BaseTestCase;

//class LogoutTest extends BaseTestCase
//{
//    protected static function getKernelClass(): string
//    {
//        return Kernel::class;
//    }
//
//    public function testLogout()
//    {
//        $client = static::createClient();
//
//        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
//            'username' => 'testuser',
//            'password' => 'password123',
//        ]));
//
//        $response = $client->getResponse();
//        $data = json_decode($response->getContent(), true);
//        $token = $data['token'];
//
//        $client->request('POST', '/api/v1/logout', [], [], [
//            'HTTP_AUTHORIZATION' => 'Bearer ' . $token,
//            'CONTENT_TYPE' => 'application/json'
//        ]);
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }
//}
