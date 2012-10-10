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
            // @todo: this is not the correct behaviour, implement different home pages
            return $this->forward('IcansPlatformsCafManBundle:Home:home');
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
     * @Route("/Home", name="cafman_home_display")
     * @Secure(roles="ROLE_USER")
     *
     */
    public function homeAction()
    {
        // @todo mast: this forward is incorrect behaviour
        return $this->forward('IcansPlatformsCoffeeKittyBundle:CoffeeKitty:manage');
    }
}
