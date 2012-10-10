<?php
/**
 * Declares ConsumeCoffeeType
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form to edit the default kitty for a user.
 */
class ConsumeCoffeeType extends AbstractType
{
    /**
     * @var array
     */
    protected $userKitties;

    /**
     * @var string|null
     */
    protected $coffeeKittyId;

    /**
     * Constructor.
     *
     * @param array       $userKitties    array of kities the user can choose his default from.
     * @param string|null $defaultKittyId the id of the current default kitty
     */
    public function __construct(array $userKitties, $defaultKittyId)
    {
        $this->userKitties  = $userKitties;
        $this->coffeeKittyId = $defaultKittyId;
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
            'required' => false,
            'data' =>  $this->coffeeKittyId,
        );
        $builder
            ->add(
                'coffeeKittyId',
                'choice',
                $defaultKittyOptions
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_coffeekitty_consumecoffee';
    }
}