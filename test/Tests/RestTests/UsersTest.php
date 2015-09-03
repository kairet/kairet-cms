<?php
namespace KCMS\Tests\RestTests;

use KCMS\Models\User;

/**
 * Test class for the user-api
 *
 * @package KCMS\Tests
 */
class UsersTest extends AbstractRestApiTest
{
    /**
     * @var User
     */
    private $testUser;

    protected function setUp()
    {
        parent::setUp();

        $testUser = new User();
        $testUser->setUsername('test.user');
        $testUser->setFirstName('First');
        $testUser->setLastName('Last');
        $testUser->setEmail('test@test.com');
        $testUser->setPassword('123456');
        $this->testUser = $testUser;
    }

    /**
     * @return int
     */
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
        $user = json_decode($response->getBody(), true);

        return $user['id'];
    }

    /**
     * @depends testUserAdd
     *
     * @param $userId
     */
    public function testUserGet($userId)
    {
        $response = $this->guzzleClient->get('users/' . $userId);

        $this->assertEquals(200, $response->getStatusCode());

        $user = json_decode($response->getBody(), true);
        $this->assertEquals($this->testUser->getUsername(), $user['username']);
        $this->assertEquals($this->testUser->getFirstName(), $user['firstName']);
        $this->assertEquals($this->testUser->getLastName(), $user['lastName']);
        $this->assertEquals($this->testUser->getEmail(), $user['email']);

        return $userId;
    }

    /**
     * @depends testUserGet
     *
     * @param $userId
     */
    public function testUserDelete($userId)
    {
        $response = $this->guzzleClient->delete('users/' . $userId);
        $this->assertEquals(204, $response->getStatusCode());

        $response2 = $this->guzzleClient->get('users/' . $userId);
        $this->assertEquals(404, $response2->getStatusCode());
    }
}
