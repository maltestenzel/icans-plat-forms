<?php

/**
 * Declares UserBalancesForKittyType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\UserBalanceType;

/**
 * Description of UserBalancesForKittyType
 */
class UserBalancesForKittyType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userbalances', 'collection', array('type' => new UserBalanceType()))
            ->add('coffeeKittyId', 'hidden', array());
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_coffeekitty_userbalancesforkitty';
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Icans\Platforms\CoffeeKittyBundle\Entity\UserBalancesForKitty',
        );
    }
}