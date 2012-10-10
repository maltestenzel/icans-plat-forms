<?php

/**
 * Declares ConsumeKitty
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Entity;

/**
 * Transport Object for the coffee kitty that is consumed from.
 */
class ConsumeKitty
{
    /**
     * @var string
     */
    protected $coffeeKittyId;

    /**
     * Get the CoffeeKitty id.
     * 
     * @return string
     */
    public function getCoffeeKittyId()
    {
        return $this->coffeeKittyId;
    }

    /**
     * Set the id of the Coffeekitty.
     * 
     * @var string $coffeeKittyId
     */
    public function setCoffeeKittyId($coffeeKittyId)
    {
        $this->coffeeKittyId = $coffeeKittyId;
    }
}