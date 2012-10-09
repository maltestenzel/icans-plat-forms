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

use Icans\Platforms\CoffeeKittyBundle\Model\Kitty as KittyModel;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Implements a mongo document representing our coffeekitty
 * @MongoDB\Document
 */
class Kitty extends KittyModel
{
}
