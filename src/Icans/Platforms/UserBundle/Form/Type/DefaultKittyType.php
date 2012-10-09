<?php
/**
 * Declares DefaultKittyType
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
 * Description of DefaultKittyType
 */
class DefaultKittyType extends AbstractType
{
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
     * @param array  $userKitties  array of kities the user can choose his default from.
     * @param string|null $defaultKitty the id of the current default kitty
     */
    public function __construct(array $userKitties, $defaultKitty)
    {
        $this->userKitties = $userKitties;
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