<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Test\Functional\Movie\MovieControllerTestBase;

class createMovieControllerTest extends MovieControllerTestBase
{
    private const CREATE_URL = '/movie/create';
    private const GET_URL = '/movie/';

    public function testCreateMovie(): void
    {
        $payload = [
            'name' => 'Fake name',
            'year' => 2022,
            'URL' => 'videoPepito',
            'library_id' => 'b7efea82-2b4d-44c5-87dd-568404efe1b3',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_URL, [], [], [], json_encode($payload));

        $ResponseCreate = self::$client->getResponse();

        $ResponseCreateData = json_decode($ResponseCreate->getContent(), true);

        $movieId = $ResponseCreateData['id'];
        self::$client->request(Request::METHOD_GET, self::GET_URL.$movieId);
        $ResponseGet = self::$client->getResponse();
        $ResponseGetData = json_decode($ResponseGet->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $ResponseCreate->getStatusCode());

        /* Assert que tiene los campos deseados */
        $this->assertArrayHasKey('id', $ResponseCreateData);
        $this->assertArrayHasKey('name', $ResponseCreateData);
        $this->assertArrayHasKey('description', $ResponseCreateData);

        /* Assert que coinciden los campos */
        $this->assertEquals($movieId, $ResponseGetData['id']);
        $this->assertEquals($payload['name'], $ResponseCreateData['name']);
        $this->assertEquals($payload['description'], $ResponseCreateData['description']);
    }
}
