<?php

namespace Feature\Context\UsersManagement\Container\User\Controller\AuthenticationController;

describe('AuthenticationController->registration()', function () {
    test('Common registration scenario', function ($url) {
        // 1 Initialization
        $data = [
            'phone' => '+77473816270'
        ];

        // 2 Act
        $this->client->request(
            method: 'POST',
            uri: $this->getContainer()->get('router')->generate('api.v1.auth.registration'),
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode($data)
        );

        // 3 Assertion
        $this->assertResponseStatusCodeSame(200);


    })->with(static function (): ?\Generator {
        yield ['/api/v1/registration'];
    });

    test('Registration with invalid phone number', function (string $phoneNumber) {
        // 1 Initialization
        $data = [
            'phone' => $phoneNumber
        ];

        // 2 Act
        $this->client->request(
            method: 'POST',
            uri: $this->getContainer()->get('router')->generate('api.v1.auth.registration'),
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode($data)
        );

        // 3 Assertion
        $this->assertResponseStatusCodeSame(422);
    })->with(['']);

    test('Attempt to register with a phone number that is already registered', function () {
        // 1 Initialization

        // 2 Act
        $data = [
            'phone' => '+77473816270'
        ];

        $this->client->request(
            method: 'POST',
            uri: $this->getContainer()->get('router')->generate('api.v1.auth.registration'),
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode($data)
        );

        // 3 Assertion
        $this->assertResponseStatusCodeSame(409);
    });

    test('Successful registration with response structure verification', function () {
        // 1 Initialization
        $data = [
            'phone' => '+77473816270'
        ];

        // 2 Act
        $this->client->request(
            method: 'POST',
            uri: $this->getContainer()->get('router')->generate('api.v1.auth.registration'),
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode($data)
        );

        // 3 Assertion
        $response = $this->client->getResponse();
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonStructure($response, [
            'authToken',
        ]);
    });

    //test на authToken
});