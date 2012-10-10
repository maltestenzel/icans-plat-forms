<?php
/**
 * Declares KittyTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document\Tests;

use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;

/**
 * Tests for the kitty document.
 */
class KittyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Kitty
     */
    protected $kitty;

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testOwner()
    {
        $this->assertNull($this->kitty->getOwner());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Document\User')->getMock();
        $returnedKitty = $this->kitty->setOwner($userMock);
        $this->assertSame($this->kitty, $returnedKitty);
        $this->assertSame($userMock, $this->kitty->getOwner());
    }

    /**
     * Tests the pending status which should be null as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPrice()
    {
        $this->assertNull($this->kitty->getPrice());
        $returnedKitty = $this->kitty->setPrice(13.37);
        $this->assertSame($this->kitty, $returnedKitty);
        $this->assertEquals(13.37, $this->kitty->getPrice());
    }

    /**
     * Tests the pending status which should be true as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPending()
    {
        $this->assertNull($this->kitty->getName());
        $returnedKitty = $this->kitty->setName('Test Kitty');
        $this->assertSame($this->kitty, $returnedKitty);
        $this->assertEquals('Test Kitty', $this->kitty->getName());
    }

    /**
     * Set up for the model to test.
     */
    protected function setUp()
    {
        $this->kitty = new Kitty();
    }
}