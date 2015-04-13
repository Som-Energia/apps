<?php

namespace SomEnergia\MailBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class DefaultControllerTest
 *
 * @category Test
 * @package  SomEnergia\MainBundle\Tests\Controller
 * @author   Eric Garcia <eric@webyo.es>
 */
class UsersAdminControllerTest extends WebTestCase {

    private $client = null;
    private $email = "testeando@somenergia.coop";
    private $wrongEmail = "testeando@webyo.es";

    public function setUp() {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/admin/login');
        $form = $crawler->selectButton('_submit')->form(
                array(
                    '_username' => 'admin',
                    '_password' => '1234',
                )
        );
        $this->client->submit($form);
    }

    /**
     * Test page is successful
     *
     * @dataProvider provideUrls
     *
     * @param string $url
     */
    public function testPagesAreSuccessful($url) {
        $this->client->request('GET', $url);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testCreate() {
        $crawler = $this->client->request('GET', '/admin/somenergia/mail/users/create?uniqid=test123');
        $form = $crawler->selectButton('btn_create_and_edit')->form(
                array(
                    'test123[id]' => 'testeando@somenergia.coop',
                    'test123[clear]' => 'test',
                )
        );
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertContains('Elemento creado satisfactoriamente', $this->client->getResponse()->getContent());
    }

    public function testIdExists() {
        $crawler = $this->client->request('GET', '/admin/somenergia/mail/users/create?uniqid=test123');
        $form = $crawler->selectButton('btn_create_and_edit')->form(
                array(
                    'test123[id]' => $this->email,
                    'test123[clear]' => 'test',
                )
        );
        $this->client->submit($form);
        $this->assertContains('El email introducido ya existe', $this->client->getResponse()->getContent());
    }

    public function testWrongEmail() {
        $crawler = $this->client->request('GET', '/admin/somenergia/mail/users/create?uniqid=test123');
        $form = $crawler->selectButton('btn_create_and_edit')->form(
                array(
                    'test123[id]' => $this->wrongEmail,
                    'test123[clear]' => 'test',
                )
        );
        $this->client->submit($form);
        $this->assertContains('Introduce una dirección de email válida', $this->client->getResponse()->getContent());
    }

    public function testDelete() {
        $crawler = $this->client->request('GET', '/admin/somenergia/mail/users/' . $this->email . '/delete');
        $form = $crawler->selectButton('Sí, borrar')->form(
                array(
                    '_method' => 'DELETE',
                )
        );
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertContains('Elemento eliminado satisfactoriamente', $this->client->getResponse()->getContent());
    }

    /**
     * Urls provider
     *
     * @return array
     */
    public function provideUrls() {
        return array(
            array('/admin/somenergia/mail/users/list'),
        );
    }

}
