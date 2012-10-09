<?php
/**
 * Declares the CoffeeKittyController
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Controller;

use Icans\Platforms\CoffeeKittyBundle\Api\CoffeeKittyServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\UserBundle\Document\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Implements the CoffeeKittyController
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class CoffeeKittyController extends Controller
{
    /**
     * @Route("/list/{partialName}", name="coffeekitty_list")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function listAction($partialName = "")
    {
        /* @var $kittyService CoffeeKittyServiceInterface */
        $kittyService = $this->get('icans.platforms.coffee_kitty.service');

        return array('kitties' => $kittyService->findByPartialName($partialName, 0, 10));
    }

    /**
     * @Route("/create/{name}", name="coffeekitty_create")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function createAction($name)
    {
        /* @var $kittyService CoffeeKittyServiceInterface */
        $kittyService = $this->get('icans.platforms.coffee_kitty.service');

        /* @var $user User */
        $user = $this->getUser();

        $kitty = new Kitty();
        $kitty->setPrice(1.0);
        $kitty->setName($name);
        $kitty->setOwner($user);

        $kittyService->create($kitty);

        return array();
    }
}
