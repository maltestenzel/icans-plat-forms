<?php

/**
 * Declares ProfileController
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller handling the profile display and editing functionality for users.
 */
class ProfileController
{
    /**
     * Displays the user profile.
     * @Route("/profile/{username}", name="user_profile_display")
     * @Template()
     */
    public function displayAction($username)
    {

        return array(
            'username' => $username
        );
    }

}