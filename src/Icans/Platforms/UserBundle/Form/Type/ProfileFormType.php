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

/**
* Extension of the FOS profile form with the added option to publish statistics.
 */
class ProfileFormType extends FOSProfileFormType
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
        return 'icansplatforms_user_profile';
    }
}