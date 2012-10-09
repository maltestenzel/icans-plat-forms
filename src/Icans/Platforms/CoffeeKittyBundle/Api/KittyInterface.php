<?php
/**
 * Declares the KittyInterface
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\UserBundle\Document\User;

/**
 * Declares the interface for our coffee kitty
 */
interface KittyInterface
{
    /**
     * Get id
     *
     * @return \MongoId $id
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     * @return KittyInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName();

    /**
     * Set owner
     *
     * @param User $owner
     * @return KittyInterface
     */
    public function setOwner(User $owner);

    /**
     * Get owner
     *
     * @return User $owner
     */
    public function getOwner();

    /**
     * Set price
     *
     * @param float $price
     * @return KittyInterface
     */
    public function setPrice($price);

    /**
     * Get price
     *
     * @return float $price
     */
    public function getPrice();
}
