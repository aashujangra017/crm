<?php

require_once __DIR__ . "/../config/database.php";

class invoice {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();

    }

   // select clientname 
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

 // select itemname 
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




    public function insertInvoice($invoiceCode, $clientName, $email, $phone, $total, $items) {

    $stmt = $this->conn->prepare(
        "INSERT INTO invoices (invoice_codes, client_name, email, phone, total) 
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("ssssd", $invoiceCode, $clientName, $email, $phone, $total);
    $stmt->execute();

    $invoice_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $this->conn->prepare(
        "INSERT INTO invoice_items (invoice_id, item_name, price, quantity) 
         VALUES (?, ?, ?, ?)"
    );

    foreach ($items as $item) {
        $stmt->bind_param("isdi", $invoice_id, $item['itemname'], $item['price'], $item['quantity']);
        $stmt->execute();
    }

    $stmt->close();

    return $invoice_id;
}





// // fetch start from here 
public function fetchallinvoice(){

    $sql = "SELECT id, invoice_codes, client_name, email, total, created_at FROM invoices";

    $stmt = $this->conn->prepare($sql);

    if(!$stmt){
        die("SQL Error: " . $this->conn->error);
    }

    $stmt->execute();

    return $stmt->get_result();
}






}





?>