<?php
/**
 * Declares KittyTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Tests;

use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;

/**
 * Tests for the kitty document.
 */
class KittyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testOwner()
    {
        $kitty = $this->getKitty();
        $this->assertNull($kitty->getOwner());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Document\User')->getMock();
        $returnedKitty = $kitty->setOwner($userMock);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface', $returnedKitty);
        $this->assertSame($userMock, $kitty->getOwner());
    }

    /**
     * Tests the pending status which should be null as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPrice()
    {
        $kitty = $this->getKitty();
        $this->assertNull($kitty->getPrice());
        $returnedKitty = $kitty->setPrice(13.37);
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface', $returnedKitty);
        $this->assertEquals(13.37, $kitty->getPrice());
    }

    /**
     * Tests the pending status which should be true as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPending()
    {
        $kitty = $this->getKitty();
        $this->assertNull($kitty->getName());
        $returnedKitty = $kitty->setName('Test Kitty');
        $this->assertInstanceOf('\Icans\Platforms\CoffeeKittyBundle\Api\KittyInterface', $returnedKitty);
        $this->assertEquals('Test Kitty', $kitty->getName());
    }

    /**
     * @return Kitty
     */
    protected function getKitty()
    {
        return new Kitty();
    }
}