<?php
/**
 * Declares KittyType
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * Implements the KittyType
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class KittyType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'icans_platforms_coffeekitty_kitty';
    }
}
