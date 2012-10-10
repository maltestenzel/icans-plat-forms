<?php

/**
 * Declares UserBalancesForKitty
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form containing subforms for the user balances.
 */
class UserBalancesForKitty
{
    /**
     * @var ArrayCollection
     */
    protected $userBalances;

    /**
     * @var string
     */
    protected $coffeeKittyId;

    /**
     * Initialize the arraycollection.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * Get the balances for this kitty.
     * 
     * @return ArrayCollection
     */
    public function getUserBalances()
    {
        return $this->userBalances;
    }

    /**
     * Set the user balances for this kitty.
     * 
     * @param ArrayCollection $userBalances
     */
    public function setUserBalances(ArrayCollection $userBalances)
    {
        $this->userBalances = $userBalances;
    }

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