<?php

/**
 * Declares UserPeakInterface
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Declares a known Peak for a User.
 */
interface UserPeakInterface
{
    /**
     * Get id
     *
     * @return \MongoId $id
     */
    public function getId();

    /**
     * Set user
     *
     * @param UserInterface $user
     * 
     * @return UserPeakInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get user
     *
     * @return UserInterface $user
     */
    public function getUser();

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return UserPeakInterface
     */
    public function setTimestamp(\DateTime $timestamp);

    /**
     * Get timestamp
     *
     * @return timestamp $timestamp
     */
    public function getTimestamp();

    /**
     * Set the peak.
     *
     * @param float $peak
     *
     * @return UserPeakInterface
     */
    public function setPeak($peak);

    /**
     * Get the peak.
     *
     * @return float
     */
    public function getPeak();
}
