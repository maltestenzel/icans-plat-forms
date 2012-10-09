<?php
/**
 * Declares the CoffeeKittyServiceInterface
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Api;

use Icans\Platforms\CoffeeKittyBundle\Exception\AlreadyExistsException;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;

/**
 * Implements the CoffeeKittyService interface
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
interface CoffeeKittyServiceInterface
{
    /**
     * Returns array of kitties beginning with $partialName
     *
     * @param string $partialName
     * @param int $limit The limit for the query
     * @param int $offset The offset for the query
     *
     * @return array
     */
    public function findByPartialName($partialName, $limit, $offset);

    /**
     * Stores a new kitty in the database and returns the created kitty on success
     *
     * @throws AlreadyExistsException In case the kitty already exists (unique name)
     *
     * @param Kitty $kitty
     *
     * @return Kitty
     */
    public function create(Kitty $kitty);
}
