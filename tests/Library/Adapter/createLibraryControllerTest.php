<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Test\Library\Adapter\LibraryControllerTestBase;

class createLibraryControllerTest extends LibraryControllerTestBase
{
    private const CREATE_URL = 'library/create';
    private const GET_URL = '';

    public function testCreateLibrary(): void
    {
        $payload = [
            'name' => 'Fake name',
            'description' => 'Fake description test',
        ];


        self::$client->request(Request::METHOD_POST, self::CREATE_URL, [], [], [], json_encode($payload));
        $ResponseCreate = self::$client->getResponse();
        $ResponseCreateData = json_decode($ResponseCreate->getContent(), true,512,0);


        self::$client->request(Request::METHOD_GET,self::GET_URL.$ResponseCreateData['id']);
        $ResponseGet = self::$client->getResponse();
        $ResponseGetData = json_decode($ResponseGet->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $ResponseCreate->getStatusCode());

        /* Assert que tiene los campos deseados */
        $this->assertArrayHasKey('id', $ResponseCreateData);
        $this->assertArrayHasKey('name', $ResponseCreateData);
        $this->assertArrayHasKey('description', $ResponseCreateData);

        /* Assert que coinciden los campos */
        $this->assertEquals($ResponseCreateData['id'], $ResponseGetData['id']);
        $this->assertEquals($payload['name'], $ResponseCreateData['name']);
        $this->assertEquals($payload['description'], $ResponseCreateData['description']);
    }
}
