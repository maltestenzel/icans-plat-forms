<?php
/**
 * Declares the NotificationController
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
use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Implements a controller to show the menu
 */
class NotificationController extends Controller
{
    /**
     * Renders the notifications.
     *
     * @Route("/notifications/", name="cafman_notification_display")
     * @Template()
     */
    public function notificationAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            return array(
                'notifications' => array(),
            );
        }

        /* @var $kittyUserService \Icans\Platforms\CoffeeKittyBundle\Api\KittyServiceInterface */
        $kittyUserService = $this->get('icans.platforms.kitty.service');
        $kittiesFromDb = $kittyUserService->findAllForUserAsOwner($this->getUser());

        /* @var $kittyUserService \Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface */
        $kittyUserService = $this->get('icans.platforms.kitty_user.service');

        $notifications = array();
        foreach($kittiesFromDb as $kitty) {
            $userKittiesFromDb = $kittyUserService->findAllForKitty($kitty, true);

            foreach($userKittiesFromDb as $userKitty) {
                $notifications[] = array(
                    'user' => array(
                        'fullname' => $userKitty->getUser()->getFullName(),
                        'displayname' => $userKitty->getUser()->getUsername(),
                    ),
                    'kitty' => array( // kitty object ?
                        'id' => $userKitty->getKitty()->getId(),
                        'name' => $userKitty->getKitty()->getName(),
                    )
                );

            }
        }

        return array(
            'notifications' => $notifications,
        );
    }
}
