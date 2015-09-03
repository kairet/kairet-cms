<?php
namespace KCMS\Tests\RestTests;

use GuzzleHttp\Client;
use KCMS\Config;

/**
 * Abstract base class for rest-api-tests using Guzzle-{@see Client}
 *
 * @package KCMS\Tests
 */
abstract class AbstractRestApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $guzzleClient;

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
