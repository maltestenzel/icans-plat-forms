<?php

/**
 * Declares UserBalance
 *
 * origin: M
 *
 * @author    Thorsten 'stepo' Hallwas
 * @copyright Oct 10, 2012 ICANS GmbH
 */
namespace Icans\Platforms\CoffeeKittyBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity holding the payment or a user.
 */
class UserBalance
{
    /**
     * @var string
     */
    protected $username;
    
    /**
     * @Assert\Type(type="float", message="Must be a float.")
     * @var float
     */
    protected $payment;

    /**
     * @var float
     */
    protected $balance;

    /**
     * @var string
     */
    protected $description;

    /**
     * Get the userid.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the userid.
     * 
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the payment.
     * 
     * @return float
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the payment.
     *
     * @param float $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the balance.
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the balance.
     *
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the description.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}