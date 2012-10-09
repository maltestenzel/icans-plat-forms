<?php
/**
 * Declares RegistrationFormType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as FOSRegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Extension of the FOS Registration form with the added fullname and the option to publish statistics. Also
 */
class RegistrationFormType extends FOSRegistrationFormType
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
                    'label' => 'form.email.label'
                )
            )
            ->add(
                'plainPassword',
                'repeated',
                array(
                    'type' => 'password',
                    'first_options' => array(
                        'label' => 'form.password.label',
                    ),
                    'second_options' => array(
                        'label' => 'form.password_confirmation.label',
                    ),
                )
            )
            ->add(
                'username',
                null,
                array(
                    'label' => 'form.username.label',
                )
            )
            ->add(
                'fullName',
                null,
                array(
                    'label' => 'form.fullname.label',
                )
            )
            ->add(
                'statisticPublic',
                'checkbox',
                array(
                    'label' => 'form.statisticpublic.label',
                    'required' => false,
                )
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_user_registration';
    }
}