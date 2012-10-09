<?php
/**
 * Declares NotFoundException
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Exception;

use Icans\Platforms\CoffeeKittyBundle\Api\Exception\CoffeeKittyExceptionInterface;

/**
 * Implements the NotFoundException
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class NotFoundException extends \RuntimeException implements CoffeeKittyExceptionInterface
{

}
