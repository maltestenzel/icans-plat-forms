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
     * @var KittyUser
     */
    protected $kittyUser;

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testUser()
    {
        $this->assertNull($this->kittyUser->getUser());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Api\UserInterface')->getMock();
        $returnedKittyUser = $this->kittyUser->setUser($userMock);
        $this->assertSame($this->kittyUser, $returnedKittyUser);
        $this->assertSame($userMock, $this->kittyUser->getUser());
    }

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testKitty()
    {
        $this->assertNull($this->kittyUser->getKitty());
        $kittyMock = $this->getMockBuilder('\Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface')->getMock();
        $returnedKittyUser = $this->kittyUser->setKitty($kittyMock);
        $this->assertSame($this->kittyUser, $returnedKittyUser);
        $this->assertSame($kittyMock, $this->kittyUser->getKitty());
    }

    /**
     * Tests the pending status which should be true as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPending()
    {
        $this->assertTrue($this->kittyUser->isPending());
        $returnedKittyUser = $this->kittyUser->setPending(false);
        $this->assertSame($this->kittyUser, $returnedKittyUser);
        $this->assertFalse($this->kittyUser->isPending());
    }

    /**
     * Tests the balance which should be 0.00 as default. After setting it false we expect it to be returned
     * again.
     */
    public function testBalance()
    {
        $this->assertInternalType('float', $this->kittyUser->getBalance());
        $this->assertEquals(0.00, $this->kittyUser->getBalance());
        $returnedKittyUser = $this->kittyUser->setBalance(13.37);
        $this->assertSame($this->kittyUser, $returnedKittyUser);
        $this->assertEquals(13.37, $this->kittyUser->getBalance());
    }

    /**
     * Set up the model for the test.
     */
    protected function setUp()
    {
        $this->kittyUser =  new KittyUser();
    }
}