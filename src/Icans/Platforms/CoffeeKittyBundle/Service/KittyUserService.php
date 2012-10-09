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

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
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
}
