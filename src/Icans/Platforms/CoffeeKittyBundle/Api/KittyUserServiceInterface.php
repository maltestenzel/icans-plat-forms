<?php
/**
 * Declares the KittyUserServiceInterface
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\CoffeeKittyBundle\Exception\AlreadyExistsException;
use Icans\Platforms\CoffeeKittyBundle\Exception\NotFoundException;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

/**
 * Implements the KittyUserService interface
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
interface KittyUserServiceInterface
{
    /**
     * Declines the membership for the user with the given kitty.
     *
     * @param KittyInterface $kitty
     * @param UserInterface $user
     *
     * @throws NotFoundException In case the kitty to user relation document cannot be found.
     */
    public function declineMembership(KittyInterface $kitty, UserInterface $user);

    /**
     * Accpets the membership for the user with the given kitty.
     *
     * @param KittyInterface $kitty
     * @param UserInterface $user
     *
     * @throws NotFoundException In case the kitty to user relation document cannot be found.
     */
    public function acknowledgeMembership(KittyInterface $kitty, UserInterface $user);

    /**
     * Requests the membership for the user with the given kitty.
     *
     * @param KittyInterface $kitty
     * @param UserInterface $user
     *
     * @throws AlreadyExistsException
     */
    public function requestMembership(KittyInterface $kitty, UserInterface $user);

    /**
     * Adds the given balance to the given kitty for the given user.
     *
     * @param KittyInterface $kitty
     * @param UserInterface $user
     *
     * @throws NotFoundException In case the kitty to user relation document cannot be found.
     */
    public function addBalance(KittyInterface $kitty, UserInterface $user, $balance);


    /**
     * Find all KittyUser relations for the given user.
     *
     * @param UserInterface $user
     *
     * @return array
     */
    public function findAllForUser(UserInterface $user);
}
