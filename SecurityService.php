<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\CustomerDAO;
use App\Services\Data\OrderDAO;
use App\Services\Data\Utility\DBConnect;

class SecurityService
{
    // Define the properties
    private $verifyCred;
    
    // Method that will pass credentials to the DA layer
    public function login(UserModel $credentials)
    {
        // Instantiate the Data Access Layer
        $this->verifyCred = new SecurityDAO();
        
        // Return true or false by passing the credentials to the object
        return $this->verifyCred->findByUser($credentials);
    }
    
    // Method to manage the customer data in the Business Layer
    public function addCustomer(CustomerModel $customerData)
    {
        // Instantiate the Data Access Layer
        $this->addNewCustomer = new CustomerDAO();
        
        // Return true or false by passing customer data to the object
        return $this->addNewCustomer->addCustomer($customerData);
    }
    
    // Method to manage the order data in the Business Layer
    public function addOrder(string $product, int $customerID)
    {
        // Instantiate the Data Access Layer
        $this->addNewOrder = new OrderDAO();
        
        // Return true or false by passing customer data to the object
        return $this->addNewOrder->addOrder($product, $customerID);
    }
    
    // Manage ACID Transactions
    public function addAllInformation(string $product, int $customerID, CustomerModel $customerData)
    {
        // Create a connection to the database
        // Create an instance of the class
        $conn = new DBConnect("activity3");
        
        // Call the method to create the connection
        $dbObj = $conn->getDbConnect();
        
        // First turn off autocommit
        $conn->setDbAutocommitFalse();
        
        // Begin a transaction
        $conn->beginTransaction();
        
        // Instantiate the Data Access Layer
        $this->addNewCustomer = new CustomerDAO($dbObj);
        
        // Next CustomerID
        $customerID = $this->addNewCustomer->getNextID();
        
        // Add the customer data
        $isSuccessful = $this->addNewCustomer->addCustomer($customerData);
        
        // Instantiate the Data Access Layer 
        $this->addNewOrder = new OrderDAO($dbObj);
        
        // Add product order data
        $isSuccessfulOrder = $this->addNewOrder->addOrder($product, $customerID);
        
        if ($isSuccessful && $isSuccessfulOrder)
        {
            $conn->commitTransaction();
            return true;
        }
        else 
        {
            $conn->rollbackTransaction();
            return false;
        }
    }
}