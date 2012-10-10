<?php
/**
 * Declares ConsumeCoffeeType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form to edit the default kitty for a user.
 */
class ConsumeCoffeeType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass;

    /**
     * @var array
     */
    protected $userKitties;

    /**
     * @var string|null
     */
    protected $defaultKittyId;

    /**
     * Constructor.
     *
     * @param string      $dataClass      class holding the user data
     * @param array       $userKitties    array of kities the user can choose his default from.
     * @param string|null $defaultKittyId the id of the current default kitty
     */
    public function __construct($dataClass, array $userKitties, $defaultKittyId)
    {
        $this->dataClass    = $dataClass;
        $this->userKitties  = $userKitties;
        $this->defaultKittyId = $defaultKittyId;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $kitties = array();
        if (count($this->userKitties) > 0) {
            $kitties = $this->userKitties;
        }
        $defaultKittyOptions = array(
            'choices' => $kitties,
            'label' => 'form.selectkitty.label',
            'required' => false
        );
        if (null !== $this->defaultKittyId) {
            $defaultKittyOptions['prefered_choices'] = array($this->defaultKittyId);
        }
        $builder
            ->add(
                'coffeeKitty',
                'choice',
                $defaultKittyOptions
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_user_defaultkitty';
    }
}