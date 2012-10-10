<?php
/**
 * Declares the MultiFormService
 *
 * origin: M
 *
 * @author    Malte Stenzel
 * @copyright 2007 - 2012 ICANS GmbH
 */
namespace Icans\Platforms\CafManBundle\Service;

use Icans\Platforms\CafManBundle\Api\MultiFormServiceInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Implements the MultiFormService used to render multiple forms on a single page
 *
 * @author    Malte Stenzel (malte.stenzel@icans-gmbh.com)
 */
class MultiFormService implements MultiFormServiceInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Default constructor
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function renderSubForm($controller, array $options = array())
    {
        /* @var $kernel HttpKernel */
        $kernel = $this->container->get('http_kernel');
        /* @var $request Request */
        $request = $this->container->get('request');

        try {
            $response = $kernel->handle(
                $this->cloneRequestWithPost($request, $controller, $options),
                HttpKernelInterface::SUB_REQUEST
            );

        } catch (\Symfony\Component\Form\Exception\AlreadyBoundException $boundException) {
            // ignore already bound exception, in that case just render the form
        }

        // If the user submits a page with multiple forms, right now we try to post to all subform controllers -
        // and those that were not submitted will cause a CSRF error that we use right now.
        // With more time, a nice solution can be added here - i.e. hidden field indicating which form to post,
        // or looking at the submitted formType
        if (empty($response) || stripos($response->getContent(), ' csrf ') !== false) {
            $response = new Response($kernel->render($controller, $options));
        }

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function extractRedirectFromResponses(array $responses)
    {
        foreach ($responses as $response) {
            if ($response instanceof RedirectResponse) {
                return $response;
            }
        }

        return null;
    }

    /**
     * Creates a clone for the given request while preserving POST parameters and method.
     *
     * @param Request $request
     * @param string $targetController
     * @param array $options
     * @return Request
     */
    private function cloneRequestWithPost(Request $request, $targetController, array $options)
    {
        $attributes = $request->attributes->all();
        $attributes['_controller'] = $targetController;
        $attributes = array_merge($attributes, $options);
        // Need to unset template so that the correct one is extracted for the sub request
        unset($attributes['_template']);
        /* @var $subRequest Request */
        $subRequest = $request->duplicate($request->query->all(), $request->request->all(), $attributes);
        $subRequest->setMethod($request->getMethod());

        return $subRequest;
    }
}
