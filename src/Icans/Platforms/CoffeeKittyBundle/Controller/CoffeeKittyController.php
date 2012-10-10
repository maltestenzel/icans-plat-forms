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
use Icans\Platforms\CoffeeKittyBundle\Document\KittySearch;
use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittyType;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittySearchType;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\KittyPriceType;
use Icans\Platforms\CafManBundle\Api\MultiFormServiceInterface;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;
use Icans\Platforms\CoffeeKittyBundle\Entity\UserBalance;
use Icans\Platforms\CoffeeKittyBundle\Entity\UserBalancesForKitty;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\UserBalancesForKittyType;

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
        /* @var $multiFormService MultiFormServiceInterface */
        $multiFormService = $this->get('icans.platforms.caf_man.multi_form.service');

        // Create sub forms, will forward the post if neccessary
        $subForms = array(
            'overview_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:overview'),
            'create_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:create'),
            'search_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:search'),
        );

        // If one of the sub forms contains a redirect (=> success), we want to execute the redirect
        if(null !== ($redirect = $multiFormService->extractRedirectFromResponses(array_values($subForms)))) {
            return $redirect;
        }

        return $subForms;
    }

    /**
     * Shows the search box and search results
     *
     * @Route("/search/{partialName}/", name="coffeekitty_search")
     * @Route("/search/", name="coffeekitty_search_empty")
     * @Route("/search/", name="coffeekitty_search_submit")
     *
     * @Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function searchAction(Request $request, $partialName = "")
    {
        /* @var $kittyService KittyServiceInterface */
        $kittyService = $this->get('icans.platforms.kitty.service');
        $kitty = new KittySearch();
        $form = $this->createForm(new KittySearchType(), $kitty);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            $partialName = $kitty->getName();
        }

        return array(
            'form' => $form->createView(),
            'kitties' => $kittyService->findByPartialName($partialName, 10, 0),
        );
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
                    $userKittiesFromDb = $kittyUserService->findAllForUser($this->getUser());
                    if (count($userKittiesFromDb) === 0) {
                        $user = $this->getUser();
                        $user->setDefaultKittyId($kitty->getId());
                        $userManager = $this->container->get('fos_user.user_manager');
                        $userManager->updateUser($user);
                    }

                    $kittyUserService->requestMembership($kitty, $user);
                    $kittyUserService->acknowledgeMembership($kitty, $user);
                } catch (CoffeeKittyExceptionInterface $exception) {
                    // @todo mast: write validator instead on form -> present different error message
                    $form->addError(new \Symfony\Component\Form\FormError('Coffee kitty already exists.'));
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
            if ($form->isValid()) {
                $kitty->setPrice($form->getData()->getPrice());
                $kittyService->updateKitty($kitty);
            }
        }

        return array(
            'form' => $form->createView(),
            'kittyId' => $kittyId,
        );
    }

    /**
     * Shows the start new kitty form.
     *
     * @param Request $request
     * @param string  $kittyId
     *
     * @return array
     *
     * @Route("/editpayments/{kittyId}/", name="coffeekitty_editpayments")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function editPaymentsAction(Request $request, $kittyId)
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

        /* @var $kittyService KittyUserServiceInterface */
        $kittyUserService = $this->get('icans.platforms.kittyuser.service');
        $userKittiesFromDb = $kittyUserService->findAllForKitty($kitty);

        $userBalances = new ArrayCollection();
        foreach($userKittiesFromDb as $userKitty)
        {
            $userBalance = new UserBalance();
            $userBalance->setUserName($userKitty->getUser()->getUsername());
            $description = $userKitty->getUser()->getFullName()
                . ' (' . $userKitty->getUser()->getUsername() . ')';
            if ($userKitty->getUser()->getId() == $this->getUser()->getId()) {
                $description .= ' (You)';
            }
            $userBalance->setDescription($description);
            $userBalance->setBalance($userKitty->getBalance());
            $userBalances->add($userBalance);
        }
        $userBalancesForKitty = new UserBalancesForKitty();
        $userBalancesForKitty->setCoffeeKittyId($kittyId);
        $userBalancesForKitty->setUserBalances($userBalances);

        $form = $this->createForm(new UserBalancesForKittyType(), $userBalancesForKitty);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('fos_user.user_manager');

                $userBalancesForKitty = $form->getData();
                foreach($userBalancesForKitty->getUserBalances() as $userBalance) {
                    $user = $userManager->findUserByUsername($userBalance->getUsername());
                    $kittyUserService->addBalance($kitty, $user, $userBalance->getPayment());
                }
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

        /* @var $multiFormService MultiFormServiceInterface */
        $multiFormService = $this->get('icans.platforms.caf_man.multi_form.service');

        $options = array('kittyId' => $kitty->getId());
        // Create sub forms, will forward the post if neccessary
        $subForms = array(
            'price_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:editPrice', $options),
            'editPayments_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:editPayments', $options),
        );

        // If one of the sub forms contains a redirect (=> success), we want to execute the redirect
        if(null !== ($redirect = $multiFormService->extractRedirectFromResponses(array_values($subForms)))) {
            return $redirect;
        }

        return array_merge($subForms, array('kitty' => $kitty));
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
        return $this->redirect($this->getRequest()->headers->get('referer'));
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
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
