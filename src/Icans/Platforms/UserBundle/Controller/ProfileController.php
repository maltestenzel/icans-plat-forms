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

use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\UserBundle\Form\Type\DefaultKittyFormType;
use Icans\Platforms\UserBundle\Form\Type\CaffeinThresholdAlertType;
use Icans\Platforms\UserBundle\Api\UserInterface;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller handling the profile display and editing functionality for users.
 */
class ProfileController extends BaseController
{
    /**
     * Displays the user profile.
     * @Route("/profile/{username}/", name="user_profile_display")
     * @Template()
     */
    public function showUserAction($username)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($username);
        if (null === $user) {
            throw new NotFoundHttpException("No User with the name '{$username}' could be found");
        }

        return array(
            'user' => $user,
        );
    }

    /**
     * Edit the user, added security check for his own profile after moving to new route.
     *
     * @Route("/profile/{username}/edit/", name="fos_user_profile_edit")
     * @Template("FOSUserBundle:Profile:edit.html.twig")
     */
    public function editSelfAction($username)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface || $user->getUserName() != $username) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->container->get('fos_user.profile.form');
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->getRedirectionUrl($user));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Displays the form to edit the defaultkitty.
     *
     * @Route("/profile/{username}/defaultkitty/", name="user_profile_defaultkitty")
     * @Template()
     */
    public function defaultkittyAction()
    {
        // reenable to secure
        /*$user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }*/

        // @todo replace with service
        $kitties = array();
        $defaultKitty = null;


        $defaultKittyType = new DefaultKittyFormType(
            'Icans\Platforms\UserBundle\Document\User',
            $kitties,
            $defaultKitty
        );

        $profile = new User();
        $formFactory = $this->container->get('form.factory');

        $defaultkittyForm = $formFactory->create(
            $defaultKittyType,
            $profile,
            array()
        );

        return array(
            'form' => $defaultkittyForm->createView(),
        );
    }

    /**
     * Dialogue to set a coffein threashold that shall trigger an email alert.
     *
     * @Route("/profile/caffeinThresholdAlert/", name="user_profile_caffein_threshold")
     * @Template()
     */
    public function caffeinThresholdAlertAction()
    {
        $formFactory = $this->container->get('form.factory');
        $caffeinThreasholdAlertForm = $formFactory->create(new CaffeinThresholdAlertType());

        return array(
            'form' => $caffeinThreasholdAlertForm->createView(),
        );
    }
}
