<?php
/**
 * Declares User
 *
 * origin: GM
 *
 * @author    Thorsten 'stepo' Hallwas
 * @author    Malte Stenzel
 * @copyright ${date} ICANS GmbH
 */

namespace Icans\Platforms\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document extending the default FOS User with the attributes needed for the CafMan Application.
 *
 * @codeCoverageIgnore Model class with getter and setters.
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     * @var string|null
     */
    protected $defaultKittyId = null;

    /**
     * @MongoDB\Boolean
     * @var boolean
     */
    protected $statisticPublic = false;

    /**
     * @MongoDB\String
     * @var string|null
     */
    protected $fullName = null;

    /**
     * Get the full name of the user.
     *
     * @return string|null
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Sets the full name of the user.
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Returns the users default kitty identifier.
     *
     * @return string|null
     */
    public function getDefaultKittyId()
    {
        return $this->defaultKittyId;
    }

    /**
     * Set the users default kitty identifier.
     *
     * @param string $defaultKittyId
     *
     * @return User
     */
    public function setDefaultKittyId($defaultKittyId)
    {
        $this->defaultKittyId = $defaultKittyId;

        return $this;
    }

    /**
     * Returns whether the statistic of the user is publically visible.
     *
     * @return boolean
     */
    public function isStatisticPublic()
    {
        return $this->statisticPublic;
    }

    /**
     * Sets whether the statistic of the user is publically visible.
     *
     * @param boolean $isStatisticPublic
     *
     * @return User
     */
    public function setStatisticPublic($isStatisticPublic)
    {
        $this->statisticPublic = $isStatisticPublic;

        return $this;
    }
}
