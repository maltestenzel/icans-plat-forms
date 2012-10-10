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

use Icans\Platforms\CoffeeKittyBundle\Api\KittyServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\Exception\CoffeeKittyExceptionInterface;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittyType;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittyPriceType;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
     * Shows the main manage kitty page
     *
     * @Route("/manage/", name="coffeekitty_manage")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function manageAction()
    {
        return array();
    }

    /**
     * Shows the search box and search results
     *
     * @Route("/search/{partialName}/", name="coffeekitty_search")
     * @Route("/search/", name="coffeekitty_search_empty")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function searchAction($partialName = "")
    {
        /* @var $kittyService KittyServiceInterface */
        $kittyService = $this->get('icans.platforms.kitty.service');

        return array('kitties' => $kittyService->findByPartialName($partialName, 10, 0));
    }

    /**
     * Shows the start new kitty form
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
                /* @var $kittyService KittyServiceInterface */
                $kittyService = $this->get('icans.platforms.kitty.service');
                try {
                    /* @var $user User */
                    $user = $this->getUser();
                    $kitty->setOwner($user);
                    $kittyService->create($form->getData());
                    // now sign up automatically to ones own coffee kitty
                    /* @var $kittyUserService \Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface */
                    $kittyUserService = $this->get('icans.platforms.kittyuser.service');
                    $kittyUserService->requestMembership($kitty, $user);
                    $kittyUserService->acknowledgeMembership($kitty, $user);
                } catch (CoffeeKittyExceptionInterface $exception) {
                    // @todo mast: write validator instead on form -> present different error message
                    $form->addError(new \Symfony\Component\Form\FormError('Coffee kitty already exists. [Database error occured]'));
                    return array('form' => $form->createView());
                }

                return $this->redirect(
                    $this->generateUrl('coffeekitty_administrate', array('kittyId' => $kitty->getId()))
                );
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * Shows the start new kitty form.
     *
     * @param Request $request
     * @param string  $kittyId
     *
     * @return array
     *
     * @Route("/editprice/{kittyId}/", name="coffeekitty_editprice")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function editPriceAction(Request $request, $kittyId)
    {
        /* @var $kittyService KittyServiceInterface */
        $kittyService = $this->get('icans.platforms.kitty.service');
        try {
            $kitty = $kittyService->findById($kittyId);
        } catch (CoffeeKittyExceptionInterface $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        if ($kitty->getOwner()->getId() != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('You are not owner of this coffee kitty.');
        }

        $form = $this->createForm(new KittyPriceType(), $kitty);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            $kitty->setPrice($form->getData()->getPrice());
            if ($form->isValid()) {
                $kittyService->updateKitty($kitty);
            }
        }

        return array(
            'form' => $form->createView(),
            'kittyId' => $kittyId,
        );
    }

    /**
     * Shows the administrate kitty page
     *
     * @param Request $request
     * @param string  $kittyId
     *
     * @return array
     *
     * @Route("/administrate/{kittyId}/", name="coffeekitty_administrate")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function administrateAction($kittyId)
    {
        /* @var $kittyService KittyServiceInterface */
        $kittyService = $this->get('icans.platforms.kitty.service');
        try {
            $kitty = $kittyService->findById($kittyId);
        } catch (CoffeeKittyExceptionInterface $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
        // @todo exception handling!
        return array('kitty' => $kitty);
    }

    /**
     * Lists all kitties the user is related with
     *
     * @Route("/overview/", name="coffeekitty_overview")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function overviewAction(){
        // @TODO implementation required
        return array();
    }

    /**
     * Accept a user request to join a coffee kitty
     *
     * @Route("/acceptKittyJoinRequestByUser/{kittyId}/{userId}/", name="coffeekitty_accept_join")
     *
     * @Secure(roles="ROLE_USER")
     */
    public function acceptKittyJoinRequestByUserAction($kittyId, $userId)
    {
        // @TODO implementation
        return $this->redirect($this->getReqest()->headers->get('referer'));
    }

    /**
     * Decline a user request to join a coffee kitty
     *
     * @Route("/declineKittyJoinRequestByUser/{kittyId}/{userId}/", name="coffeekitty_decline_join")
     *
     * @Secure(roles="ROLE_USER")
     */
    public function declineKittyJoinRequestByUserAction($kittyId, $userId)
    {
        // @TODO implementation
        return $this->redirect($this->getReqest()->headers->get('referer'));
    }
}
