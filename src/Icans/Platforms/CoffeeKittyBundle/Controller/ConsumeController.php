<?php

/**
 * Declares ConsumeController
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Controller;

use Icans\Platforms\CoffeeKittyBundle\Document\Consumption;
use Icans\Platforms\CoffeeKittyBundle\Document\Kitty;
use Icans\Platforms\CoffeeKittyBundle\Form\Type\ConsumeCoffeeType;
use Icans\Platforms\CoffeeKittyBundle\Entity\ConsumeKitty;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface;
use Icans\Platforms\CoffeeKittyBundle\Api\ConsumptionServiceInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Description of ConsumeController
 */
class ConsumeController extends Controller
{
    /**
     * Shows the form to consume in a kitty.
     * 
     * @Route("/consume/", name="coffeekitty_consume")
     *
     * @ Secure(roles="ROLE_USER")
     *
     * @Template()
     */
    public function consumeAction(Request $request)
    {
        /* @var $kittyUserService \Icans\Platforms\CoffeeKittyBundle\Api\KittyUserServiceInterface */
        $kittyUserService = $this->get('icans.platforms.kitty_user.service');

        $userKittiesFromDb = $kittyUserService->findAllForUser($this->getUser());

        $userKitties = array();
        foreach($userKittiesFromDb as $userKitty)
        {
            $userKitties[$userKitty->getKitty()->getId()] = $userKitty->getKitty()->getName();
        }

        $consumeCoffee = new ConsumeCoffeeType(
            $userKitties,
            $this->getUser()->getDefaultKittyId()
        );
        $consumeKitty = new ConsumeKitty();
        $form = $this->createForm($consumeCoffee, $consumeKitty);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            /* @var $consumeKitty ConsumeKitty */
            $consumeKitty = $form->getData();
            /* @var $kittyUserService KittyUserServiceInterface */
            $kittyUserService = $this->get('icans.platforms.kitty_user.service');
            $coffeeKittyId = $consumeKitty->getCoffeeKittyId();
            /* @var $kittyService KittyServiceInterface */
            $kittyService = $this->get('icans.platforms.kitty.service');
            $kitty = $kittyService->findById($coffeeKittyId);
            /* @var $consumptionService ConsumptionServiceInterface */
            $consumptionService = $this->get('icans.platforms.consumption.service');
            $consumptionService->createForUserNow($this->getUser());

            // we stubstract his balance
            $kittyUserService->addBalance($kitty, $this->getUser(), -1 * $kitty->getPrice());

            // @todo create peak entries
        }


        return array(
            'form' => $form->createView(),
        );

    }

}