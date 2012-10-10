<?php
/**
 * Declares the HighscoreController
 *
 * origin: GM
 *
 * @author    Sascha Schulz
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Implements a controller to show the menu
 */
class HighscoreController extends Controller
{
    /**
     * Renders the menu
     *
     * @Route("/highscore/", name="cafman_highscore")
     * @Template()
     */
    public function highscoreAction()
    {
        return array(
            'highscores' => array(
                'overall' => array(
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test 1',
                            'url' => '#'
                        ),
                        'level' => 1000
                    ),
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test n',
                            'url' => '#'
                        ),
                        'level' => 999
                    ),
                ),
                'weekly' => array(
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test 1',
                            'url' => '#'
                        ),
                        'level' => 1000
                    ),
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test n',
                            'url' => '#'
                        ),
                        'level' => 999
                    ),
                ),
                'daily' => array(
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test 1',
                            'url' => '#'
                        ),
                        'level' => 1000
                    ),
                    array(
                        'user' => array(
                            'publicStatistic' => true,
                            'displayname' => 'Test n',
                            'url' => '#'
                        ),
                        'level' => 999
                    ),
                ),
            ),
        );
    }
}
