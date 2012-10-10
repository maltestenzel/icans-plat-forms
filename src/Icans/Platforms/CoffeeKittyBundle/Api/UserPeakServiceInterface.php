<?php

/**
 * Declares UserPeakServiceInterface
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\CoffeeKittyBundle\Api\UserPeakInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Interface for the service to track a users coffee consumption.
 */
interface UserPeakServiceInterface
{
    /**
     * Returns a userPeak by id.
     *
     * @param \MongoId $id
     *
     * @return UserPeakInterface
     */
    public function findById($id);

    /**
     * Stores a new userPeak in the database and returns the created userPeak on success.
     *
     * @param UserPeakInterface $userPeak
     *
     * @return UserPeakInterface
     *
     * @throws AlreadyExistsException In case the userPeak already exists.
     */
    public function create(UserPeakInterface $userPeak);

    /**
     * Find all userPeaks for the given user since the given date.
     *
     * @param UserInterface $user
     * @param \DateTime $since
     *
     * @return array
     */
    public function findAllForUserSince(UserInterface $user, \DateTime $since);

    /**
     * Find the greates userPeaks since the given date.
     *
     * @param \DateTime $since
     * @param integer   $limit
     *
     * @return array
     */
    public function findGreatestSince(\DateTime $since, $limit);
}
