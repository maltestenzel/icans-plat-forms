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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Implements a controller to show the home page
 */
class HomeController extends Controller
{
    /**
     * Main entry point of the application, shows login/registration form
     *
     * @Route("/", name="cafman_home_display")
     * @Template()
     */
    public function indexAction()
    {
        // Redirect already logged in users
        $user = $this->getUser();
        if(!empty($user)) {
            // @todo: this is not the correct behaviour, implement different home pages
            return $this->redirect($this->generateUrl('coffeekitty_manage', array()));
        }

        return array();
    }

    /**
     * Renders the menu
     *
     * @Route("/", name="cafman_menu_display")
     * @Template()
     */
    public function menuAction()
    {
        $menuEntries = array();
        $user = $this->getUser();
        $isSignedIn = !empty($user);
        // @todo mast: use translation
        // @todo mast: this implementation does not live up to our standards
        $menuEntries['Home'] = $this->generateUrl('cafman_home_display');
        if ($isSignedIn) {
            $menuEntries['Caffeine Statistics'] = '#';
        }
        $menuEntries['Highscores'] = '#';
        if ($isSignedIn) {
            $menuEntries['Coffee Kitty'] = $this->generateUrl('coffeekitty_manage');
            $menuEntries['Caffeine Statistics'] = '#';
        }

        return array(
            'isSignedIn' => $isSignedIn,
            'menuEntries' => $menuEntries,
        );
    }
}
