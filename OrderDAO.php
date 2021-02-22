<?php
namespace App\Services\Data;

//use App\Models\CustomerModel;
use Carbon\Exceptions\Exception;
//use App\Services\Data\Utility\DBConnect;

class OrderDAO
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
    
    public function addOrder(string $product, int $customerID)
    {
        try
        {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO 'order'
                              (Product, CustomerID)
                              VALUES
                              ('" . $product . "', " . $customerID . ")";
            
            // If the selected query returns a resultset
            //$result = mysqli_query($this->conn, $this->dbQuery);
            
            // If there are rows that are returned we have valid credentials
            //echo $this->dbQuery;
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
}