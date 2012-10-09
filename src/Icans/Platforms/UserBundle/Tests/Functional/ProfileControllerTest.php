<?php

/**
 * Declares ProfileControllerTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests for the user profile available through the ProfileController.
 * @group Functional
 */
class ProfileControllerTest extends WebTestCase
{
    /**
     * Tests the display of the profile and looks for the username in the html.
     */
    public function testDisplayAction()
    {
        $client = static::createClient();

        $container = $client->getContainer();
        $router = $container->get('router');
        /* @var $router \Symfony\Component\Routing\RouterInterface */
        $route = $router->generate('user_profile_display', array('username' => 'stepo'));
        $crawler = $client->request('GET', $route);

        $this->assertTrue($crawler->filter('html:contains("stepo")')->count() > 0);
    }
}