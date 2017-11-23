<?php

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Client;


/**
 * Created by PhpStorm.
 * User: jordi.gracia
 * Date: 20/11/2017
 * Time: 14:24
 */
class MeetUpControllerTest extends WebTestCase
{

    private $service;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->service = static::$kernel->getContainer()
            ->get('eight_points_guzzle.client.api_meetup')
        ;
    }

    private $client;

    private $container;

    public function testApiMeetupGETCities()
    {
        $this->client = static::createClient();
        $this->container = $this->client->getContainer();

        $client2 = $this->container->get('eight_points_guzzle.client.api_meetup');
        $response = $client2->get('/2/cities');

        $this->assertEquals(200, $response->getStatusCode());
        print_r($response->hasHeader('Location'));

        //$this->assertTrue($response->hasHeader('Location'));
    }
}