<?php
namespace App\Models;

class CustomerModel
{
    private $firstName;
    private $lastName;
    
    // Class Constructor
    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    
    /**
     *
     * Getter Method -> firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     *
     * Getter Method -> lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}