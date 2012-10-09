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

use Icans\Platforms\UserBundle\Api\UserInterface;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;

/**
 * Description of KittyUser
 */
interface KittyUserInterface
{
   /**
     * Returns the id of this document.
     * @return \MongoId
     */
    public function getId();

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return KittyUserInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get user
     *
     * @return UserInterface $user
     */
    public function getUser();

    /**
     * Set kitty
     *
     * @param KittyInterface $kitty
     * @return KittyUserInterface
     */
    public function setKitty(KittyInterface $kitty);

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
