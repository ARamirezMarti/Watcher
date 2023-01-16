<?php

use App\Library\Domain\Model\Library;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Test\Library\Adapter\LibraryControllerTestBase;

class deleteLibraryControllerTest extends LibraryControllerTestBase
{
    private const CREATE_URL = '/library/create';
    private const GET_URL = '';

    public function testDeleteLibrary(): void
    {
        $payload = [
            'name' => 'Fake name',
            'description' => 'Fake description test',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_URL, [], [], [], json_encode($payload));

        $ResponseCreate = self::$client->getResponse();
        $ResponseCreateData = json_decode($ResponseCreate->getContent(), true);

        $esta = isset( $ResponseCreateData['id' ]);
        $LibraryId = $ResponseCreateData['id'];

        self::$client->request(Request::METHOD_DELETE, self::GET_URL.$LibraryId);
        $ResponseDelete = self::$client->getResponse();
        $ResponseDeleteData = json_decode($ResponseDelete->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $ResponseCreate->getStatusCode());
        $this->assertEquals(JsonResponse::HTTP_OK, $ResponseDelete->getStatusCode());

        /* Assert que tiene los campos deseados */
        $this->assertArrayHasKey('status', $ResponseDeleteData);

        /* Assert que coinciden los campos */
        $this->assertEquals('deleted', $ResponseDeleteData['status']);
    }
}
