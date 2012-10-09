<?php
/**
 * Declares CoffeeKittyService
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Service;

use Icans\Platforms\CoffeeKittyBundle\Api\CoffeeKittyServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Exception\AlreadyExistsException;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Implements a service used to abstract the application logic from the database
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class CoffeeKittyService implements CoffeeKittyServiceInterface
{
    /**
     * @var DocumentManager
     */
    protected $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * {@inheritDoc}
     */
    public function findById($id)
    {
        return $this->documentManager->find('Icans\Platforms\CoffeeKittyBundle\Document\Kitty', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function findByPartialName($partialName, $limit, $offset)
    {
        // Find kitties that begin with $partialName (case insensitive)
        $queryBuilder = $this->documentManager->createQueryBuilder('Icans\Platforms\CoffeeKittyBundle\Document\Kitty')
            ->field('name')->equals(new \MongoRegex('/^' . $partialName . '.*/i'))
            ->limit($limit)
            ->offset($offset);

        return $queryBuilder->getQuery()->execute()->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function create(KittyInterface $kitty)
    {
        if (null !== $kitty->getId()) {
            throw new AlreadyExistsException('The kitty ' . $kitty->getName() . ' already exists.');
        }
        $this->documentManager->persist($kitty);
        try {
            $this->documentManager->flush();
        } catch (\Exception $exception) {
            throw new AlreadyExistsException('The kitty ' . $kitty->getName() . ' already exists.');
        }

    }
}
