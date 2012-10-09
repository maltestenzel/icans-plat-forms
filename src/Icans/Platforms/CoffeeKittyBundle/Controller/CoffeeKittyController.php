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
use Icans\Platforms\CoffeeKittyBundle\Api\Exception\CoffeeKittyExceptionInterface;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittyType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/search/{partialName}/", name="coffeekitty_search")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function searchAction($partialName = "")
    {
        /* @var $kittyService CoffeeKittyServiceInterface */
        $kittyService = $this->get('icans.platforms.coffee_kitty.service');

        return array('kitties' => $kittyService->findByPartialName($partialName, 0, 10));
    }

    /**
     * @Route("/create/", name="coffeekitty_create")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function createAction(Request $request)
    {
        // just setup a fresh kitty
        $kitty = new Kitty();

        $form = $this->createForm(new KittyType(), $kitty);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // user successfully submitted
                /* @var $kitty Kitty */
                $kitty = $form->getData();
                /* @var $kittyService CoffeeKittyServiceInterface */
                $kittyService = $this->get('icans.platforms.coffee_kitty.service');
                try {
                    /* @var $user User */
                    $user = $this->getUser();
                    $kitty->setOwner($user);
                    $kittyService->create($form->getData());
                } catch (CoffeeKittyExceptionInterface $exception) {
                    // @todo mast: wrong redirect, validator etc
                    $this->redirect($this->generateUrl('coffeekitty_create'));
                }

                return $this->redirect(
                    $this->generateUrl('coffeekitty_administrate', array('id' => $kitty->getId()))
                );
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/administrate/{id}/", name="coffeekitty_administrate")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function administrateAction($id)
    {
        /* @var $kittyService CoffeeKittyServiceInterface */
        $kittyService = $this->get('icans.platforms.coffee_kitty.service');
        // @todo exception handling!
        return array('kitty' => $kittyService->findById($id));
    }

    /**
     * @Route("/overview/", name="coffeekitty_overview")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function overviewAction()
    {
        return array();
    }
}
