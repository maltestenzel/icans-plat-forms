<?php

/**
 * Declares ConsumptionServiceInterface
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Interface for the service to track a users coffee consumption.
 */
interface ConsumptionServiceInterface
{
    /**
     * Returns a consumption by id.
     *
     * @param \MongoId $id
     *
     * @return ConsumptionInterface
     */
    public function findById($id);

    /**
     * Stores a new consumption in the database and returns the created consumption on success.
     *
     * @param ConsumptionInterface $consumption
     *
     * @return ConsumptionInterface
     *
     * @throws AlreadyExistsException In case the consumption already exists.
     */
    public function create(ConsumptionInterface $consumption);

    /**
     * Find all consumptions for the given user since the given date.
     * 
     * @param UserInterface $user
     * @param \DateTime $since
     *
     * @return array
     */
    public function findAllForUserSince(UserInterface $user, \DateTime $since);
}
