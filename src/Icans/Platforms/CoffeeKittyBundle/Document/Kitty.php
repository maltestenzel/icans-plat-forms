<?php
/**
 * Declares the Kitty
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Implements a mongo document representing our coffeekitty
 * @MongoDB\Document
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
     * @var string
     */
    protected $name;

    /**
     * @ReferenceOne(targetDocument="User")
     * @var \MongoId
     */
    protected $ownerId;

    /**
     * @MongoDB\Float
     * @var float
     */
    protected $price;
}
