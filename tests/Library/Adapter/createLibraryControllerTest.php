<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Test\Library\Adapter\LibraryControllerTestBase;

class createLibraryControllerTest extends LibraryControllerTestBase
{
    private const CREATE_URL = '/library/create';
    private const GET_URL = '/library/';

    public function testCreateLibrary(): void
    {
        $payload = [
            'name' => 'Fake name',
            'description' => 'Fake description test',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_URL, [], [], [], json_encode($payload));

        $ResponseCreate = self::$client->getResponse();
        $ResponseCreateData = json_decode($ResponseCreate->getContent(), true);

        $LibraryId = $ResponseCreateData['id'];

        self::$client->request(Request::METHOD_GET, self::GET_URL.$LibraryId);
        $ResponseGet = self::$client->getResponse();
        $ResponseGetData = json_decode($ResponseGet->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $ResponseCreate->getStatusCode());

        /* Assert que tiene los campos deseados */
        $this->assertArrayHasKey('id', $ResponseCreateData);
        $this->assertArrayHasKey('name', $ResponseCreateData);
        $this->assertArrayHasKey('description', $ResponseCreateData);

        /* Assert que coinciden los campos */
        $this->assertEquals($LibraryId, $ResponseGetData['id']);
        $this->assertEquals($payload['name'], $ResponseCreateData['name']);
        $this->assertEquals($payload['description'], $ResponseCreateData['description']);
    }
}
