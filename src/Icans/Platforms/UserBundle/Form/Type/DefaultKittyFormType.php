<?php
/**
 * Declares DefaultKittyFormType
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
class DefaultKittyFormType extends AbstractType
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
    protected $defaultKitty;

    /**
     * Constructor.
     *
     * @param string      $dataClass    class holding the user data
     * @param array       $userKitties  array of kities the user can choose his default from.
     * @param string|null $defaultKitty the id of the current default kitty
     */
    public function __construct($dataClass, array $userKitties, $defaultKitty)
    {
        $this->dataClass    = $dataClass;
        $this->userKitties  = $userKitties;
        $this->defaultKitty = $defaultKitty;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // we only display this form if the user has already kitties to choose from.
        if (count($this->userKitties) > 0) {
            $defaultKittyOptions = array(
                'choices' => $this->userKitties,
                'label' => 'form.selectkitty',
                'required' => false
            );
            if (null !== $this->defaultKitty) {
                $defaultKittyOptions['prefered_choices'] = array($this->defaultKitty);
            }
            $builder
                ->add(
                    'defaultKitty',
                    'choice',
                    $defaultKittyOptions
                );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_user_defaultkitty';
    }
}