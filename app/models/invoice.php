<?php

require_once __DIR__ . "/../config/database.php";

class invoice {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();

    }

   
public function selectClientByName($clientName){
        $sql = "select email, phone from user where name = ?";
        $stmt = $this->conn->prepare($sql);
        
        
        $stmt->bind_param("s", $clientName);
        
        $stmt->execute();
        
        
        $result = $stmt->get_result();
        
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    }


    public function selectitemByName($itemName){
        $sql = "select price from items where itemname = ?";
        $stmt = $this->conn->prepare($sql);
        
        
        $stmt->bind_param("s", $itemName);
        
        $stmt->execute();
        
        
        $result = $stmt->get_result();
        
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    }


  


}





?>