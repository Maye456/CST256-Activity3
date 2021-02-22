<?php
namespace App\Services\Data;

use App\Models\CustomerModel;
use Carbon\Exceptions\Exception;
use App\Services\Data\Utility\DBConnect;

class CustomerDAO
{
    // Define the connection string
    private $connObject;
    private $dbname = "activity3";
    private $dbQuery;
    private $connection;
    private $dbObj;
    
    // Constructor that creates a connection w/ the database
    public function __construct($dbObj)
    {
        $this->dbObj = $dbObj;
    }
    
    public function addCustomer(CustomerModel $customerData)
    {
        try
        {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO customer
                              (FirstName, LastName)
                              VALUES
                              ('{$customerData->getFirstName()}', '{$customerData->getLastName()}')";
            
            // If the selected query returns a resultset
            //$result = mysqli_query($this->conn, $this->dbQuery);
            
            // If there are rows that are returned we have valid credentials
            if ($this->dbObj->query($this->dbQuery))
            {
                //$this->connObject->closeDbConnect();
                return true;
            }
            else
            {
                //$this->connObject->closeDbConnect();
                return false;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    // ACID
    // Get the next ID for the PK to put in the FK
    public function getNextID()
    {
        try 
        {
            // Define the query to get the next ID
            $this->dbQuery = "SELECT CustomerID 
                              FROM customer
                              ORDER BY CustomerID DESC LIMIT 0,1";
            $result = $this->dbObj->query($this->dbQuery);
            while ($row = mysqli_fetch_array($result))
            {
                return $row['CustomerID'] + 1;
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
}