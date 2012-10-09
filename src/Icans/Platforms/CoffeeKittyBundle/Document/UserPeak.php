<?php

/**
 * Declares UserPeak
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document;

use Icans\Platforms\CoffeeKittyBundle\Api\UserPeakInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;
use Icans\Platforms\UserBundle\Document\User;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document holding the comsumption timestamp of a user.
 *
 * @MongoDB\Document
 */
class UserPeak implements UserPeakInterface
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
     * @MongoDB\Timestamp
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @MongoDB\Float
     * @var float
     */
    protected $peak;

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

    /**
     * {@inheritDoc}
     */
    public function setPeak($peak)
    {
        $this->peak = $peak;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPeak()
    {
        return $this->peak;
    }
}