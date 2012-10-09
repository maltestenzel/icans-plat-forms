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
 * Extension of the FOS Registration form with the added option to publish statistics.
 */
class RegistrationFormType extends FOSRegistrationFormType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm();
        $builder
            ->add(
                'statisticPublic',
                'checkbox',
                array(
                    'label' => 'form.statisticpublic',
                    'required' => false,
                )
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icansplatforms_user_registration';
    }
}