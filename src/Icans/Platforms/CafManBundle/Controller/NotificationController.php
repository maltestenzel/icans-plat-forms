<?php
/**
 * Declares the MenuController
 *
 * origin: GM
 *
 * @author    Sascha Schulz
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Implements a controller to show the menu
 */
class NotificationController extends Controller
{
    /**
     * Renders the menu
     *
     * @Route("/", name="cafman_notification_display")
     * @Template()
     */
    public function notificationAction()
    {
        // this is just a stub, needs to be implemented
        $notifications = array(
            array(
                'user' => array( // user object ?
                    'id' => '11',
                    'fullname' => 'John Smith',
                    'displayname' => 'CoffeePapa',
                ),
                'kitty' => array( // kitty object ?
                    'id' => '1',
                    'name' => 'The Addicts',
                ),
            ),
            array(
                'user' => array( // user object ?
                    'id' => '12',
                    'fullname' => 'Old Bushmills',
                    'displayname' => 'Irish Coffee',
                ),
                'kitty' => array( // kitty object ?
                    'id' => '1',
                    'name' => 'The Addicts',
                ),
            ),
        );

        return array(
            'notifications' => $notifications,
        );
    }
}
