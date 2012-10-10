<?php
/**
 * Declares the KittySearch
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Implements a model used only for our search form
 */
class KittySearch
{
    protected $name;

    /**
     * Getter for name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
