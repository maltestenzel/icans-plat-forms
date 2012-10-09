<?php

/**
 * Declares KittyUser
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;

/**
 * Description of KittyUser
 */
interface KittyUserInterface
{
   /**
     * Returns the id of this document.
     */
    public function getId();

    /**
     * Set user
     *
     * @param User $user
     * @return KittyUserInterface
     */
    public function setUser(User $user);

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser();

    /**
     * Set kitty
     *
     * @param Kitty $kitty
     * @return KittyUserInterface
     */
    public function setKitty(Kitty $kitty);

    /**
     * Get kitty
     *
     * @return Kitty $kitty
     */
    public function getKitty();

    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return KittyUserInterface
     */
    public function setBalance($balance);
    /**
     * Get balance
     *
     * @return float $balance
     */
    public function getBalance();

    /**
     * Set pending
     *
     * @param boolean $isPending
     *
     * @return KittyUserInterface
     */
    public function setPending($isPending);

    /**
     * Get pending
     *
     * @return boolean $pending
     */
    public function isPending();
}
