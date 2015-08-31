<?php
namespace KCMS\Tests\RestTests;

use GuzzleHttp\Client;
use KCMS\Config;

/**
 * Class AbstractRestApiTest
 * @package KCMS\Tests
 */
class AbstractRestApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->guzzleClient = new Client(
            [
                'base_url' => Config::UNIT_TEST_BASE_URL,
                'defaults' => ['exceptions' => false]
            ]
        );
    }
}
