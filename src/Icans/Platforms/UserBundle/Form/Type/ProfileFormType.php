<?php
/**
 * Declares ProfileFormType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as FOSProfileFormType;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Extension of the FOS profile form with the full user profile and a reorder of the items.
 */
class ProfileFormType extends FOSProfileFormType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                'email',
                array('label' => 'form.email')
            )
            ->add(
                'plainPassword',
                'repeated',
                array(
                    'type' => 'password',
                    'first_options' => array('label' => 'form.newpassword'),
                    'second_options' => array('label' => 'form.newpassword_confirmation'),
                )
            )
            ->add(
                'username',
                null,
                array('label' => 'form.username')
            )
            ->add(
                'fullname',
                null,
                array(
                    'label' => 'form.fullname',
                )
            )
            ->add(
                'statisticPublic',
                'checkbox',
                array(
                    'label' => 'form.statisticpublic',
                    'required' => false,
                )
            )
            ->add(
                'current_password',
                'password',
                array(
                    'label' => 'form.oldpassword',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                )
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_user_profile';
    }
}