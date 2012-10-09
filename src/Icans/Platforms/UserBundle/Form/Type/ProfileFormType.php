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
                array(
                    'label' => 'form.email.label',
                    'attr' => array('id' => 'update-email'),
                )
            )
            ->add(
                'plainPassword',
                'repeated',
                array(
                    'type' => 'password',
                    'first_options' => array(
                        'label' => 'form.newpassword.label',
                        'attr' => array('id' => 'update-password'),
                    ),
                    'second_options' => array(
                        'label' => 'form.newpassword_confirmation.label',
                        'attr' => array('id' => 'update-repeat-password'),
                    ),
                )
            )
            ->add(
                'username',
                null,
                array(
                    'label' => 'form.username.label',
                    'attr' => array('id' => 'update-displayname'),
                )
            )
            ->add(
                'fullname',
                null,
                array(
                    'label' => 'form.fullname.label',
                    'attr' => array('id' => 'update-fullname'),
                )
            )
            ->add(
                'statisticPublic',
                'checkbox',
                array(
                    'label' => 'form.statisticpublic.label',
                    'required' => false,
                    'attr' => array('id' => 'update-publish'),
                )
            )
            ->add(
                'current_password',
                'password',
                array(
                    'label' => 'form.oldpassword.label',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                    'attr' => array(
                        'id' => 'update-old-password',
                        'explanation' => 'form.oldpassword.explanation'
                    ),

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