<?php

/**
 * Declares Consumption
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document;

use Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;
use Icans\Platforms\UserBundle\Document\User;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document holding the comsumption timestamp of a user.
 * 
 * @MongoDB\Document
 */
class Consumption implements ConsumptionInterface
{
    /**
     * @MongoDB\ReferenceOne(targetDocument="Icans\Platforms\UserBundle\Document\User")
     * @var User
     */
    protected $user;

    /**
     * @MongoDB\Timestamp
     * @var \DateTime
     */
    protected $timestamp;

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
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
