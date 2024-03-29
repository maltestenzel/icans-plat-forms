<?php
/**
 * Declares KittyService
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Service;

use Icans\Platforms\CoffeeKittyBundle\Api\KittyServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Exception\AlreadyExistsException;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Implements a service used to obtain, create and modify kitties
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class KittyService implements KittyServiceInterface
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
            ->skip($offset)
            ->sort('id');

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
            throw new AlreadyExistsException(
                'The kitty ' . $kitty->getName() . ' already exists. (' . $exception->getMessage() . ')'
            );
        }

        return $kitty;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllForUserAsOwner(UserInterface $user)
    {
        $queryBuilder = $this->documentManager->createQueryBuilder('Icans\Platforms\CoffeeKittyBundle\Document\Kitty')
            ->field('owner.$id')->equals(new \MongoId($user->getId()));

       return $queryBuilder->getQuery()->execute()->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function updateKitty(KittyInterface $kitty)
    {
        $this->documentManager->persist($kitty);
        $this->documentManager->flush();

        return $kitty;
    }
}
