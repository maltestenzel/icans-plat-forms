<?php
/**
 * Declares KittyUserTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Tests;

use Icans\Platforms\CoffeeKittyBundle\Document\KittyUser;

/**
 * Tests for the Kitty to User relation.
 */
class KittyUserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testUser()
    {
        $kittyUser = $this->getKittyUser();
        $this->assertNull($kittyUser->getUser());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Api\UserInterface')->getMock();
        $returnedKittyUser = $kittyUser->setUser($userMock);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface', $returnedKittyUser);
        $this->assertSame($userMock, $kittyUser->getUser());
    }

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testKitty()
    {
        $kittyUser = $this->getKittyUser();
        $this->assertNull($kittyUser->getKitty());
        $kittyMock = $this->getMockBuilder('\Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface')->getMock();
        $returnedKittyUser = $kittyUser->setKitty($kittyMock);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface', $returnedKittyUser);
        $this->assertSame($kittyMock, $kittyUser->getKitty());
    }

    /**
     * Tests the pending status which should be true as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPending()
    {
        $kittyUser = $this->getKittyUser();
        $this->assertTrue($kittyUser->isPending());
        $returnedKittyUser = $kittyUser->setPending(false);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface', $returnedKittyUser);
        $this->assertFalse($kittyUser->isPending());
    }

    /**
     * Tests the balance which should be 0.00 as default. After setting it false we expect it to be returned
     * again.
     */
    public function testBalance()
    {
        $kittyUser = $this->getKittyUser();
        $this->assertInternalType('float', $kittyUser->getBalance());
        $this->assertEquals(0.00, $kittyUser->getBalance());
        $returnedKittyUser = $kittyUser->setBalance(13.37);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyUserInterface', $returnedKittyUser);
        $this->assertEquals(13.37, $kittyUser->getBalance());
    }

    /**
     * @return KittyUser
     */
    protected function getKittyUser()
    {
        return new KittyUser();
    }
}