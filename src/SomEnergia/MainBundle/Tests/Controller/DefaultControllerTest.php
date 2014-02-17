<?php

namespace SomEnergia\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/admin/login');

        $this->assertTrue($client->getResponse()->getStatusCode() == 200);
    }
}
