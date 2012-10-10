<?php

/**
 * Declares UserPeakTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Document\Tests;

use Icans\Platforms\CoffeeKittyBundle\Document\UserPeak;

/**
 * Description of UserPeakTest
 */
class UserPeakTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserPeak;
     */
    protected $userPeak;

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testUser()
    {
        $this->assertNull($this->userPeak->getUser());
        $userMock = $this->getMockBuilder('\Icans\Platforms\UserBundle\Document\User')->getMock();
        $returnedUserPeak = $this->userPeak->setUser($userMock);
        $this->assertSame($this->userPeak, $returnedUserPeak);
        $this->assertSame($userMock, $this->userPeak->getUser());
    }

    /**
     * Tests the user which should be null first. After setting it to a mock we expect it to be returned again.
     */
    public function testTimestamp()
    {
        $this->assertNull($this->userPeak->getTimestamp());
        $dateTime = new \DateTime();
        $returnedUserPeak = $this->userPeak->setTimestamp($dateTime);
        $this->assertSame($this->userPeak, $returnedUserPeak);
        $this->assertSame($dateTime, $this->userPeak->getTimestamp());
    }

    /**
     * Tests the pending status which should be null as default. After setting it false we expect it to be returned
     * again.
     */
    public function testPeak()
    {
        $this->assertNull($this->userPeak->getPeak());
        $returnedUserPeak = $this->userPeak->setPeak(13.37);
        $this->assertSame($this->userPeak, $returnedUserPeak);
        $this->assertEquals(13.37, $this->userPeak->getPeak());
    }

    /**
     * Set up for the model to test.
     */
    protected function setUp()
    {
        $this->userPeak = new UserPeak();
    }
}