<?php
/**
 * Declares AlreadyExistsException.php
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Exception;

use Icans\Platforms\CoffeeKittyBundle\Api\Exception\CoffeeKittyExceptionInterface;

/**
 * Implements the AlreadyExistsException
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class AlreadyExistsException extends \RuntimeException implements CoffeeKittyExceptionInterface
{

}
