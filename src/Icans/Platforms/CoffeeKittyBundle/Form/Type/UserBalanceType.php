<?php

/**
 * Declares UserBalanceType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Implements a form to hold a payment for a user.
 */
class UserBalanceType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'payment',
                null,
                array()
            )
            ->add(
                'username',
                'hidden',
                array()
            )
            ->add(
                'balance',
                null,
                array()
            )
            ->add(
                'description',
                null,
                array()
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_coffeekitty_userbalance';
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Icans\Platforms\CoffeeKittyBundle\Entity\UserBalance',
        );
    }
}