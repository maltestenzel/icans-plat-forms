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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Implements a controller containing admin functionality, i.e. reset the application
 */
class AdminController extends Controller
{
    /**
     * Display form to reset the application to factory defaults
     *
     * @Route("/admin/reset", name="cafman_admin_reset")
     * @Secure(roles="ROLE_SUPER_ADMIN")
     *
     * @Template()
     */
    public function resetAction(Request $request)
    {
        return array();
    }

    /**
     * Reset the application to factory defaults
     *
     * @Route("/admin/reset/execute", name="cafman_admin_reset_execute")
     * @Secure(roles="ROLE_SUPER_ADMIN")
     *
     * @Template()
     */
    public function resetExecuteAction()
    {
        // Reset the application
        /* @var $kernel KernelInterface */
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        // Drop dbs
        $options = array('command' => 'doctrine:mongodb:schema:drop');
        $application->run(new ArrayInput($options));
        $options = array('command' => 'doctrine:mongodb:schema:create');
        $application->run(new ArrayInput($options));

        // Create admin user
        $options = array('command' => 'fos:user:create', 'username' => 'admin', 'email' => 'organizers@plat-forms.org', 'password' => 'admin');
        $application->run(new ArrayInput($options));
        $options = array('command' => 'fos:user:promote', 'username' => 'admin', '--super' => true);
        $application->run(new ArrayInput($options));

        return new RedirectResponse($this->generateUrl('fos_user_security_logout'));
    }
}
