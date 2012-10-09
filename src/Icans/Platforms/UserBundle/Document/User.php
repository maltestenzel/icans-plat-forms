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

use Icans\Platforms\UserBundle\Model\User as UserModel;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class to be used as a MongoDB document.
 *
 * @MongoDB\Document
 */
class User extends UserModel
{
}