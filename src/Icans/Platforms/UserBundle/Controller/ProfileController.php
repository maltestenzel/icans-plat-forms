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

use Icans\Platforms\UserBundle\Model\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller handling the profile display and editing functionality for users.
 */
class ProfileController extends Controller
{
    /**
     * Displays the user profile.
     * @Route("/profile/{username}/", name="user_profile_display")
     * @Template()
     */
    public function displayAction($username)
    {

        return array(
            'username' => $username
        );
    }

    /**
     * Displays the form to edit the userprofile.
     * 
     * @Route("/profile/{username}/edit/", name="user_profile_edit")
     * @Template()
     */
    public function editAction($username)
    {
        // reenable to secure
        /*$user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface || $user->getUserName() != $username) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }*/

        $profileType = $this->container->get('icans.platform.form.type.profileform');
        $profile = new User();
        $formFactory = $this->container->get('form.factory');

        $profileForm = $formFactory->create(
            $profileType,
            $profile,
            array()
        );

        return array(
            'username' => $username,
            'form' => $profileForm->createView(),
        );
    }
}