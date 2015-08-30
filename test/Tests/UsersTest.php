<?php
namespace KCMS\Tests;

use GuzzleHttp\Client;
use KCMS\Models\User;
use PHPUnit_Framework_TestCase;

class UsersTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @var User
     */
    private $testUser;

    protected function setUp()
    {
        $this->guzzleClient = new Client(
            [
                'base_url' => 'http://localhost:8080/',
                'defaults' => ['exceptions' => false]
            ]
        );

        $testUser = new User();
        $testUser->setUsername('test.user');
        $testUser->setFirstName('First');
        $testUser->setLastName('Last');
        $testUser->setEmail('test@test.com');
        $testUser->setPassword('123456');
        $this->testUser = $testUser;
    }

    public function testUserAdd()
    {
        $response = $this->guzzleClient->post('users/', [
            'body' => json_encode([
                'username'  => $this->testUser->getUsername(),
                'firstName' => $this->testUser->getFirstName(),
                'lastName'  => $this->testUser->getLastName(),
                'email'     => $this->testUser->getEmail(),
                'password'  => $this->testUser->getPassword()
            ])
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * @depends testUserAdd
     */
    public function testUserGet()
    {
        $response = $this->guzzleClient->get('users/1');

        $this->assertEquals(200, $response->getStatusCode());

        $user = json_decode($response->getBody(), true);
        $this->assertEquals($this->testUser->getUsername(), $user['username']);
        $this->assertEquals($this->testUser->getFirstName(), $user['firstName']);
        $this->assertEquals($this->testUser->getLastName(), $user['lastName']);
        $this->assertEquals($this->testUser->getEmail(), $user['email']);
    }
}
