<?php
/**
 * Declares the MenuController
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
 * Implements a controller to show the menu
 */
class MenuController extends Controller
{
    /**
     * Renders the menu
     *
     * @Route("/", name="cafman_menu_display")
     * @Template()
     */
    public function menuAction()
    {
        $menuEntries = array();
        $userEntries = array();

        $user = $this->getUser();
        $isSignedIn = !empty($user);
        // @todo mast: use translation
        // @todo mast: this implementation does not live up to our standards
        $menuEntries[] = $this->generateMenuEntry('Home', 'cafman_home_display_visitor', 'home-link');

        if ($isSignedIn) {
            $menuEntries[] = $this->generateMenuEntry('Caffeine Statistics', null, 'caffeine-link');
        }
        $menuEntries[] = $this->generateMenuEntry('Highscores', 'cafman_highscore', 'highscores-link');
        if ($isSignedIn) {
            $menuEntries[] = $this->generateMenuEntry('Coffee Kitty', 'coffeekitty_manage', 'kitty-link');
        }

        // Create user entries (link to profile, signout)
        if ($isSignedIn) {
            $userEntries[] = array(
                'linktext' => $user->getUsername() . ' (' . $user->getEmail() . ')',
                'url' => $this->generateUrl('fos_user_profile_edit', array('username' => $user->getUsername())),
                'id' => 'profile-link'
            );
            $userEntries[] = $this->generateMenuEntry('Sign out', 'fos_user_security_logout', 'logout');
        }

        return array(
            'menuEntries' => $menuEntries,
            'userEntries' => $userEntries,
        );
    }

    /**
     * Return a menu entry (currently as array)
     * @todo MenuEntry would make for a really nice object
     *
     * @param string $name
     * @param string $route
     * @param string|null $id
     *
     * @return array
     */
    private function generateMenuEntry($name, $route = null, $id = null)
    {
        return array(
            'linktext' => $name,
            'url' => (!empty($route)) ? $this->generateUrl($route) : '#',
            'id' => $id
        );
    }
}
