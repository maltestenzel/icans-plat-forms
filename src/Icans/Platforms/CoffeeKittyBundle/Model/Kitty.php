<?php
/**
 * Declares the Kitty
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Model;

use Icans\Platforms\UserBundle\Document\User;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Implements a model representing our coffeekitty
 */
class Kitty
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var \MongoId
     */
    protected $id;

    /**
     * @MongoDB\String
     * @MongoDB\UniqueIndex(safe="true")
     *
     * @var string
     */
    protected $name;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Icans\Platforms\UserBundle\Document\User")
     * @var User
     */
    protected $owner;

    /**
     * @MongoDB\Float
     * @var float
     */
    protected $price;

    /**
     * Get id
     *
     * @return \MongoId $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Kitty
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set owner
     *
     * @param User $owner
     * @return Kitty
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return User $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Kitty
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }
}
