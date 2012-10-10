<?php

/**
 * Declares ConsumptionService
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Service;

use Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Service to track a users coffee consumption.
 */
class ConsumptionService implements ConsumptionServiceInterface
{
    /**
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * Constructor.
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * {@inheritDoc}
     */
    public function findById($id)
    {
        return $this->documentManager->find('\Icans\Platforms\CoffeeKittyBundle\Document\Consumption', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function create(ConsumptionInterface $consumption)
    {
        if (null !== $consumption->getId()) {
            throw new AlreadyExistsException('The consumption ' . $consumption->getName() . ' already exists.');
        }
        $this->documentManager->persist($consumption);
        try {
            $this->documentManager->flush();
        } catch (\Exception $exception) {
            throw new AlreadyExistsException(
                'Error persisting consumption (' . $exception->getMessage . ').'
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function findAllForUserSince(UserInterface $user, \DateTime $since)
    {
        $queryBuilder = $this->documentManager->createQueryBuilder('\Icans\Platforms\CoffeeKittyBundle\Document\Consumption')
            ->field('user')->equals($user->getId())
            ->field('timestamp')->gt($since)
            ->sort('timestamp');

       return $queryBuilder->getQuery()->execute()->toArray();
    }
}