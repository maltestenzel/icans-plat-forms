<?php
/**
 * Declares the MultiFormServiceInterface
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Declares the MultiFormServiceInterface used to render multiple forms on a single page
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
interface MultiFormServiceInterface
{
    /**
     * Render sub form for given controller as sub request while pertaining POST
     *
     * @param string $controller
     * @return Response
     */
    public function renderSubForm($controller);

    /**
     * Tries to extract the first redirect response found in an array of response. Will return null if no
     * redirect response is found.
     *
     * @param array $responses Array of Response objects
     * @return RedirectResponse|null
     */
    public function extractRedirectFromResponses(array $responses);
}
