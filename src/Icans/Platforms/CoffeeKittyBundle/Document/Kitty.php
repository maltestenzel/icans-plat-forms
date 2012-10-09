<?php
/**
 * Declares the Kitty
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document;

use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\UserBundle\Document\User;
use Icans\Platforms\UserBundle\Api\UserInterface;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Implements a model representing our coffeekitty
 * @MongoDB\Document
 */
class Kitty implements KittyInterface
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
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {
        return $this->price;
    }
}
