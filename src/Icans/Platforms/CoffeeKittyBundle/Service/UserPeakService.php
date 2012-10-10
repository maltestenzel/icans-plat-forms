<?php

/**
 * Declares UserPeakService
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Service;

use Icans\Platforms\CoffeeKittyBundle\Api\UserPeakServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\UserPeakInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Service providing the user peaks.
 */
class UserPeakService implements UserPeakServiceInterface
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
        return $this->documentManager->find('\Icans\Platforms\CoffeeKittyBundle\Document\UserPeak', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function create(UserPeakInterface $userPeak)
    {
        if (null !== $userPeak->getId()) {
            throw new AlreadyExistsException('The userPeak ' . $userPeak->getName() . ' already exists.');
        }
        $this->documentManager->persist($userPeak);
        try {
            $this->documentManager->flush();
        } catch (\Exception $exception) {
            throw new AlreadyExistsException(
                'Error persisting userPeak (' . $exception->getMessage . ').'
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function findAllForUserSince(UserInterface $user, \DateTime $since)
    {
        $queryBuilder = $this->documentManager->createQueryBuilder('\Icans\Platforms\CoffeeKittyBundle\Document\UserPeak')
            ->field('user')->equals($user->getId())
            ->field('timestamp')->gt($since)
            ->sort('timestamp');

       return $queryBuilder->getQuery()->execute()->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function findGreatestSince(\DateTime $since, $limit)
    {
        $queryBuilder = $this->documentManager->createQueryBuilder('\Icans\Platforms\CoffeeKittyBundle\Document\UserPeak')
            ->field('timestamp')->gt($since)
            ->map('function() { emit(this.user.$id, 1 }')
            ->reduce("function(obj,prev) {
                    if (prev.peak < obj.peak) {
                        prev.peak = obj.peak;
                    }
                    return prev.peak;
                }
            ")
            ->limit($limit)
            ->sort('peak');

       return $queryBuilder->getQuery()->execute()->toArray();
    }
}