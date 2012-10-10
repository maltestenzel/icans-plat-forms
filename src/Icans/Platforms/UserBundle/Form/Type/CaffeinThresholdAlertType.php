<?php
/**
 * Declares CoffeinThresholdAlertType
 *
 * origin: M
 *
 * @author    Sascha Schulz
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Implements a form to set a coffeine level for email alerts
 */
class CaffeinThresholdAlertType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'caffeinThreshold',
            null,
            array('label' => 'form.caffeinThreshold.label')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_coffein_threshold_alert';
    }
}
