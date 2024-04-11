<?php

namespace Feature\Context\UsersManagement\Container\User\Controller\AuthenticationController;

use App\Kernel;
use App\Shared\Definition\BaseTestCase;

//class LoginTest extends BaseTestCase
//{
//    protected static function getKernelClass(): string
//    {
//        return Kernel::class;
//    }
//    public function testLoginWithLoginStrategy()
//    {
//        $client = static::createClient();
//        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
//            'type' => 'login',
//            'login' => 'testuser',
//            'password' => 'password123',
//        ]));
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }
//
//    public function testLoginWithPhoneCodeStrategy()
//    {
//        $client = static::createClient();
//        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
//            'type' => 'phone',
//            'phone' => '1234567890',
//            'phoneCode' => '1234',
//        ]));
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }
//
//    public function testLoginWithAuthCodeStrategy()
//    {
//        $client = static::createClient();
//        $client->request('POST', '/api/v1/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
//            'type' => 'sso',
//            'authCode' => 'SSO_AUTH_CODE',
//        ]));
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }
//}