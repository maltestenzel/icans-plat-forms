<?php

/**
 * Declares KittyUser
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document;
use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Implements a model representing the relation between a kitty and the user.
 * @MongoDB\Document
 */
class KittyUser implements KittyUserInterface
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var \MongoId
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Icans\Platforms\UserBundle\Document\User")
     * @var User
     */
    protected $user;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Icans\Platforms\CoffeeKittyBundle\Document\Kitty")
     * @var Kitty
     */
    protected $kitty;

    /**
     * @MongoDB\Float
     * @var float
     */
    protected $balance = 0.00;

    /**
     * @MongoDB\Boolean
     * @var boolean
     */
    protected $pending = true;

    /**
     * Returns the id of this document.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return KittyUser
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set kitty
     *
     * @param Kitty $kitty
     * @return KittyUser
     */
    public function setKitty(Kitty $kitty)
    {
        $this->kitty = $kitty;
        return $this;
    }

    /**
     * Get kitty
     *
     * @return Kitty $kitty
     */
    public function getKitty()
    {
        return $this->kitty;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * 
     * @return KittyUser
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * Get balance
     *
     * @return float $balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set pending
     *
     * @param boolean $isPending
     * 
     * @return KittyUser
     */
    public function setPending($isPending)
    {
        $this->pending = $isPending;
        
        return $this;
    }

    /**
     * Get pending
     *
     * @return boolean $pending
     */
    public function isPending()
    {
        return $this->pending;
    }
}
