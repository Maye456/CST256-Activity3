<?php
namespace  App\Services\Data\Utility;

use mysqli;

class DBConnect
{
    // Define the connection string
    private $conn;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    // Constructor that creates a connection w/ the database
    public function __construct(string $dbname)
    {
        // Initialize
        $this->dbname = $dbname;
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";       
    }
    
    /*
     * Create a db connection
     */
    public function getDbConnect()
    {
        // OOP Style
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Create a connection to the database
        // Procedural
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        // Make sure to always test the connection and see if there are any errors
        
        //$this->conn = mysqli::connect($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error)
        {
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            exit();
        }
        return($this->conn);
    }
    
    /*
     * Turn ON Autocommit
     */
    public function setDbAutocommitTrue()
    {
        $this->conn->autocommit(TRUE);
    }
    
    /*
     * Turn OFF Autocommit
     */
    public function setDbAutocommitFalse()
    {
        $this->conn->autocommit(FALSE);
    }
    
    /*
     * Close the connection
     */
    public function closeDbConnect()
    {
        // Procedural 
        //mysqli_close($this->conn);
        // OOP
        $this->conn->close();
        //mysqli::close($this->conn);
    }
    
    /*
     * Begin a Transaction
     */
    public function beginTransaction()
    {
        $this->conn->begin_transaction();
    }
    
    /*
     * Commit a Transaction
     */
    public function commitTransaction()
    {
        $this->conn->commit();
    }
    
    /*
     * Rollback a Transaction
     */
    public function rollbackTransaction()
    {
        $this->conn->rollback();
    }
}
?>