<?php

namespace Test\Movie\Adapter;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class MovieControllerTestBase extends WebTestCase
{
    protected static ?AbstractBrowser $client = null;

    private const CREATE_LIBRARY_URL = '/library/create';
    private const GET_URL = '/library/';

    public function setUp(): void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameter('CONTENT_TYPE', 'application/json');
        }
    }
}
