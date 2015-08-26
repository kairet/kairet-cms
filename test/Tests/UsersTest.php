<?php
namespace KCMS\Tests;

use GuzzleHttp\Client;
use PHPUnit_Framework_TestCase;

class UsersTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    protected function setUp()
    {
        $this->guzzleClient = new Client(
            [
                'base_url' => 'http://localhost:8080/',
                'defaults' => ['exceptions' => false]
            ]
        );
    }

    public function testUserAdd()
    {
        $response = $this->guzzleClient->put(
            'users/{"username":"test.user","firstName":"Test","lastName":"User","email":"test@test.com","password":' .
            '"password"}'
        );
        $this->assertEquals(201, $response->getStatusCode());
    }
}
