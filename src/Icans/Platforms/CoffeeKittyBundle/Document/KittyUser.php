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
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

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
     * @var UserInterface
     */
    protected $user;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Icans\Platforms\CoffeeKittyBundle\Document\Kitty")
     * @var KittyInterface
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
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function setKitty(KittyInterface $kitty)
    {
        $this->kitty = $kitty;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getKitty()
    {
        return $this->kitty;
    }

    /**
     * {@inheritDoc}
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * {@inheritDoc}
     */
    public function setPending($isPending)
    {
        $this->pending = $isPending;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isPending()
    {
        return $this->pending;
    }
}
