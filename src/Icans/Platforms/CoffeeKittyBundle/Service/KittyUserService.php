<?php
/**
 * Declares the KittyUserService
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Service;

use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Exception\AlreadyExistsException;
use Icans\Platforms\CoffeeKittyBundle\Exception\NotFoundException;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface;
use Icans\Platforms\UserBundle\Api\UserInterface;
use Icans\Platforms\CoffeeKittyBundle\Document\KittyUser;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Implements a service used to obtain, create and modify the relation between users and kitties, i.e. get all kitties
 * of a user
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class KittyUserService implements KittyUserServiceInterface
{
    /**
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * Constructor.
     * @param \Doctrine\ODM\MongoDB\DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * {@inheritDoc}
     */
    public function acknowledgeMembership(KittyInterface $kitty, UserInterface $user)
    {
        $kittyUser = $this->getKittyUser($kitty, $user);
        $kittyUser->setPending(false);
        $this->documentManager->persist($kittyUser);
        $this->documentManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function declineMembership(KittyInterface $kitty, UserInterface $user)
    {
        $kittyUser = $this->getKittyUser($kitty, $user);
        $this->documentManager->remove($kittyUser);
        $this->documentManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function requestMembership(KittyInterface $kitty, UserInterface $user)
    {
        $kittyUser = new KittyUser();
        $kittyUser->setKitty($kitty)
            ->setUser($user)
            ->setPending(true)
            ->setBalance(0.0);

        $this->documentManager->persist($kittyUser);
        try {
            $this->documentManager->flush();
        } catch (\Exception $exception) {
            throw new AlreadyExistsException(
                'The kitty->user ' . $kittyUser->getKitty()->getName() . ' -> ' . $kittyUser->getUser()->getUsername() . ' already exists.'
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addBalance(KittyInterface $kitty, UserInterface $user, $balance)
    {
        $kittyUser = $this->getKittyUser($kitty, $user);
        $newBalance = $kittyUser->getBalance() + $balance;
        $kittyUser->setBalance($newBalance);
        $this->documentManager->persist($kittyUser);
        $this->documentManager->flush();
    }

    /**
     * Loads the Kitty User from the database.
     *
     * @param KittyInterface $kitty
     * @param UserInterface $user
     *
     * @return KittyUserInterface
     *
     * @throws NotFoundException In case the kitty to user relation document cannot be found.
     */
    protected function getKittyUser(KittyInterface $kitty, UserInterface $user, $balance)
    {
        $queryBuilder = $this->documentManager->createQueryBuilder('Icans\Platforms\CoffeeKittyBundle\Document\Kitty')
            ->field('kitty')->equals($kitty->getId())
            ->field('user')->equals($user->getId())
            ->find();

        /* @var $kittyUser KittyUserInterface */
        $kittyUser = current($queryBuilder->getQuery()->execute()->toArray());

        if (empty($kittyUser)) {
            throw new NotFoundException(
                'The kitty->user ' . $kittyUser->getKitty()->getName() . ' -> ' . $kittyUser->getUser()->getUsername() . ' was not found.'
            );
        }

        return $kittyUser;
    }
}
