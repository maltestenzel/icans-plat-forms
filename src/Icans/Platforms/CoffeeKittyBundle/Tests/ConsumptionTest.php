<?php

/**
 * Declares ConsumptionTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Tests;

use Icans\Platforms\CoffeeKittyBundle\Document\Consumption;

/**
 * Tests for the consumption document.
 */
class ConsumptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Consumption;
     */
    protected $consumption;

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testUser()
    {
        $this->assertNull($this->consumption->getUser());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Document\User')->getMock();
        $returnedConsumption = $this->consumption->setUser($userMock);
        $this->assertInstanceOf('Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionInterface', $returnedConsumption);
        $this->assertSame($userMock, $this->consumption->getUser());
    }

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testTimestamp()
    {
        $this->assertNull($this->consumption->getTimestamp());
        $dateTime = new \DateTime();
        $returnedConsumption = $this->consumption->setTimestamp($dateTime);
        $this->assertInstanceOf('Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionInterface', $returnedConsumption);
        $this->assertSame($dateTime, $this->consumption->getTimestamp());
    }

    /**
     * Set up for the model to test.
     */
    protected function setUp()
    {
        $this->consumption = new Consumption();
    }

}