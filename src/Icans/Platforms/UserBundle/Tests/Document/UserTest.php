<?php

/**
 * Declares UserTest
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 9, 2012 ICANS GmbH
 */
namespace Icans\Platforms\UserBundle\Tests\Document;

use Icans\Platforms\UserBundle\Document\User;

use FOS\UserBundle\Tests\Model\UserTest as BaseUserTest;

/**
 * Extends the existing Test from the FOS UserBundle with the ones needed for the new fields
 */
class UserTest extends BaseUserTest
{
    /**
     * Tests the defaultKitty value. It has to be null at initialisation of the object. After setting it to "someId"
     * the value is expected to be returned.
     */
    public function testDefaultKitty()
    {
        $user = $this->getUser();
        $this->assertNull($user->getDefaultKittyId());
        $userReturned = $user->setDefaultKittyId('someId');
        $this->assertSame($userReturned, $user);
        $this->assertEquals('someId', $user->getDefaultKittyId());
    }

    /**
     * Tests the full name value. It has to be null at initialisation of the object. After setting it to "Name"
     * the value is expected to be returned.
     */
    public function testFullName()
    {
        $user = $this->getUser();
        $this->assertNull($user->getFullName());
        $userReturned = $user->setFullName('Name');
        $this->assertSame($userReturned, $user);
        $this->assertEquals('Name', $user->getFullName());
    }

    /**
     * Tests the statisticPublic value. It has to be fals at initialisation of the object. After setting it to true we
     * expect it to be returned through "isStatisticPublic"
     */
    public function testStatisticPublic()
    {
        $user = $this->getUser();
        $this->assertFalse($user->isStatisticPublic());
        $userReturned = $user->setStatisticPublic(true);
        $this->assertSame($userReturned, $user);
        $this->assertTrue($user->isStatisticPublic());
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        return new User();
    }

}