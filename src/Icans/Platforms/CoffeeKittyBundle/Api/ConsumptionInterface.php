<?php

/**
 * Declares Consumption
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Declares the interface of a coffee consumption by a user.
 */
interface ConsumptionInterface
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
     * @return ConsumptionInterface
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
     * @return ConsumptionInterface
     */
    public function setTimestamp(\DateTime $timestamp);

    /**
     * Get timestamp
     *
     * @return timestamp $timestamp
     */
    public function getTimestamp();
}