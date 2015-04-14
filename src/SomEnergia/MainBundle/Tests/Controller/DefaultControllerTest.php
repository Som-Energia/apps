<?php

namespace SomEnergia\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class DefaultControllerTest
 *
 * @category Test
 * @package  SomEnergia\MainBundle\Tests\Controller
 * @author   David Romaní <david@flux.cat>
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test page is successful
     *
     * @dataProvider provideUrls
     *
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->getAdminClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Get admin client
     *
     * @return Client
     */
    private function getAdminClient()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/login');
        $form = $crawler->selectButton('_submit')->form(
            array(
                '_username' => 'admin',
                '_password' => '12345',
            )
        );
        $client->submit($form);

        return $client;
    }

    /**
     * Urls provider
     *
     * @return array
     */
    public function provideUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/somenergia/mail/aliases/list'),
            array('/admin/somenergia/mail/aliases/create'),
            array('/admin/somenergia/mail/aliases/1/edit'),
            array('/admin/somenergia/mail/aliases/1/show'),
            array('/admin/somenergia/mail/aliases/1/delete'),
            array('/admin/somenergia/mail/users/list'),
            array('/admin/somenergia/mail/users/create'),
            array('/admin/somenergia/mail/users/admin@somenergia.coop/edit'),
            array('/admin/somenergia/mail/users/admin@somenergia.coop/show'),
            array('/admin/somenergia/mail/users/admin@somenergia.coop/delete'),
            array('/admin/somenergia/socio/socio/list'),
            array('/admin/somenergia/socio/socio/1/edit'),
            array('/admin/somenergia/socio/socio/1/show'),
            array('/admin/somenergia/main/codigopostal/list'),
            array('/admin/somenergia/main/codigopostal/create'),
            array('/admin/somenergia/main/codigopostal/1/edit'),
            array('/admin/somenergia/main/codigopostal/1/show'),
            array('/admin/somenergia/grupolocal/grupolocal/list'),
            array('/admin/somenergia/grupolocal/grupolocal/create'),
            array('/admin/somenergia/grupolocal/grupolocal/1/edit'),
            array('/admin/somenergia/grupolocal/grupolocal/1/show'),
            array('/admin/sonata/user/user/list'),
            array('/admin/sonata/user/user/create'),
            array('/admin/sonata/user/user/1/edit'),
            array('/admin/sonata/user/user/1/show'),
            array('/admin/sonata/user/group/list'),
            array('/admin/sonata/user/group/create'),
            array('/admin/sonata/user/group/1/edit'),
            array('/admin/sonata/user/group/1/show'),
        );
    }
}
