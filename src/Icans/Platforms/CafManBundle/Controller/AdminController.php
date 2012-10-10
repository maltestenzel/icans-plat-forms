<?php
/**
 * Declares the AdminController
 *
 * origin: GM
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Controller;

use Icans\Platforms\CafManBundle\Api\MultiFormServiceInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Implements a controller containing admin functionality, i.e. reset the application
 */
class AdminController extends Controller
{
    /**
     * Reset the application to factory defaults
     *
     * @Route("/admin/reset", name="cafman_admin_reset")
     * @Secure(roles="ROLE_SUPER_ADMIN")
     *
     * @Template()
     */
    public function resetAction()
    {
        return array();
    }
}
