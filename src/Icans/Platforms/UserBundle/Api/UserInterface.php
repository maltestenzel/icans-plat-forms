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

namespace Icans\Platforms\UserBundle\Api;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document extending the default FOS User with the attributes needed for the CafMan Application.
 *
 * @codeCoverageIgnore Model class with getter and setters.
 * @MongoDB\Document
 */
interface UserInterface extends BaseUserInterface
{
    /**
     * Get the full name of the user.
     *
     * @return string|null
     */
    public function getFullName();

    /**
     * Sets the full name of the user.
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName);

    /**
     * Returns the users default kitty identifier.
     *
     * @return string|null
     */
    public function getDefaultKittyId();

    /**
     * Set the users default kitty identifier.
     *
     * @param string $defaultKittyId
     *
     * @return User
     */
    public function setDefaultKittyId($defaultKittyId);

    /**
     * Returns whether the statistic of the user is publically visible.
     *
     * @return boolean
     */
    public function isStatisticPublic();

    /**
     * Sets whether the statistic of the user is publically visible.
     *
     * @param boolean $isStatisticPublic
     *
     * @return User
     */
    public function setStatisticPublic($isStatisticPublic);
}
