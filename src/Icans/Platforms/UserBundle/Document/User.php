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
 * @MongoDB\Document
 *
 * @codeCoverageIgnore Document class with getter and setters.
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDb\String
     * @var string|null
     */
    protected $defaultKittyId = null;

    /**
     * @MongoDb\Boolean
     * @var boolean
     */
    protected $statisticPublic = false;

    /**
     * Returns the id of the user.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the users default kitty identifier.
     *
     * @return string
     */
    public function getDefaultKittyId()
    {
        return $this->defaultKittyId;
    }

    /**
     * Set the users default kitty identifier.
     *
     * @param string $defaultKittyId
     */
    public function setDefaultKittyId($defaultKittyId)
    {
        $this->defaultKittyId = $defaultKittyId;
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
     */
    public function setStatisticPublic($isStatisticPublic)
    {
        $this->statisticPublic = $isStatisticPublic;
    }

}
