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
use Icans\Platforms\UserBundle\Api\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document extending the default FOS User with the attributes needed for the CafMan Application.
 *
 * @codeCoverageIgnore Model class with getter and setters.
 * @MongoDB\Document
 */
class User extends BaseUser implements UserInterface
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
     * {@inheritDoc}
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultKittyId()
    {
        return $this->defaultKittyId;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultKittyId($defaultKittyId)
    {
        $this->defaultKittyId = $defaultKittyId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isStatisticPublic()
    {
        return $this->statisticPublic;
    }

    /**
     * {@inheritDoc}
     */
    public function setStatisticPublic($isStatisticPublic)
    {
        $this->statisticPublic = $isStatisticPublic;

        return $this;
    }
}
