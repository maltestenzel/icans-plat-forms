<?php
/**
 * Declares the HomeController
 *
 * origin: GM
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Controller;

use Icans\Platforms\CafManBundle\Api\MultiFormServiceInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Implements a controller to show the home page
 */
class HomeController extends Controller
{
    /**
     * Main entry point of the application, shows login/registration form
     *
     * @Route("/", name="cafman_home_display_visitor")
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /* @var $multiFormService MultiFormServiceInterface */
        $multiFormService = $this->get('icans.platforms.caf_man.multi_form.service');

        // Redirect already logged in users
        $user = $this->getUser();
        if(!empty($user)) {
            if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
                return $this->forward('IcansPlatformsCafManBundle:Admin:reset');
            } else {
                /* @var $kittyService KittyUserServiceInterface */
                $kittyUserService = $this->get('icans.platforms.kittyuser.service');
                $userKittiesFromDb = $kittyUserService->findAllForUser($this->getUser());
                if (count($userKittiesFromDb)) {
                    return $this->forward('IcansPlatformsCafManBundle:Home:authedWithKitty');
                } else {
                    return $this->forward('IcansPlatformsCafManBundle:Home:authedNoKitty');
                }
            }
        }

        // Create sub forms, will forward the post if neccessary
        $subForms = array(
            'login_form' => $multiFormService->renderSubForm('FOSUserBundle:Security:login'),
            'register_form' => $multiFormService->renderSubForm('FOSUserBundle:Registration:register'),
        );

        // If one of the sub forms contains a redirect (=> success), we want to execute the redirect
        if(null !== ($redirect = $multiFormService->extractRedirectFromResponses(array_values($subForms)))) {
            return $redirect;
        }

        return $subForms;
    }

    /**
     * @Route("/", name="cafman_authedwithkitty")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function authedWithKittyAction()
    {
        /* @var $multiFormService MultiFormServiceInterface */
        $multiFormService = $this->get('icans.platforms.caf_man.multi_form.service');

        $subForms = array(
           'consume_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:Consume:consume'),
        );
        // If one of the sub forms contains a redirect (=> success), we want to execute the redirect
        if(null !== ($redirect = $multiFormService->extractRedirectFromResponses(array_values($subForms)))) {
            return $redirect;
        }

        return $subForms;
    }

    /**
     * @Route("/", name="cafman_authednokitty")
     * @Secure(roles="ROLE_USER")
     * @Template()
     */
    public function authedNoKittyAction()
    {
        /* @var $multiFormService MultiFormServiceInterface */
        $multiFormService = $this->get('icans.platforms.caf_man.multi_form.service');

        // Create sub forms, will forward the post if neccessary
         $subForms = array(
             'search_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:search'),
             'create_form' => $multiFormService->renderSubForm('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:create'),
         );

        // If one of the sub forms contains a redirect (=> success), we want to execute the redirect
        if(null !== ($redirect = $multiFormService->extractRedirectFromResponses(array_values($subForms)))) {
            return $redirect;
        }

        return $subForms;
    }
}
