<?php
/**
 * Declares SearchType
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Implements a search form for coffee kitties
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class KittySearchType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'name',
            null,
            array('attr' => array(
                'placeholder' => 'form.search.placeholder.kitty',
            ))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'icans_platforms_coffeesearch_search';
    }
}
