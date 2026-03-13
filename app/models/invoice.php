<?php

require_once __DIR__ . "/../config/database.php";

class invoice {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();

    }
    
// clients form here in user table 

public function getClients($search = '') {

    $sql = "SELECT id, name FROM user WHERE name LIKE ?"; 


    $cool = $this->conn->prepare($sql);
    
    $searchTerm = "%$search%"; 
    
    $cool->bind_param('s', $searchTerm); 
    $cool->execute();   
    
    $result = $cool->get_result();   

    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row; 
    }

    return $clients;  
}


public function getitems($search = '') {


    $sql = "SELECT id, itemname FROM items WHERE itemname LIKE ?";
    
  
    $cool = $this->conn->prepare($sql);
    $searchTerm = "%$search%";

   
    $cool->bind_param('s', $searchTerm);

    $cool->execute();

    $result = $cool->get_result();

    $clients = [];

    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
    return $clients;
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












// insert invoice start from here model 





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



// search limit and order by start form here 


public function getinvoice($limit, $offset, $search = '', $orderColumn = 'id', $orderDir = 'ASC') {
    $allowed_columns = ['id','invoice_codes', 'name', 'total,'];
    $allowed_dirs    = ['ASC', 'DESC'];

  
    $orderColumn = in_array($orderColumn, $allowed_columns) ? $orderColumn : 'id';
    $orderDir    = in_array($orderDir, $allowed_dirs)    ? $orderDir    : 'ASC';

    $search_param = "%$search%";

$sql = "SELECT id, invoice_codes, client_name, email, total, created_at
        FROM invoices
        WHERE (invoice_codes LIKE ? OR client_name LIKE ? OR email LIKE ?)
        ORDER BY $orderColumn $orderDir LIMIT ? OFFSET ?";

$cool = $this->conn->prepare($sql);

$cool->bind_param("sssii", $search_param, $search_param,$search_param,$limit, $offset);

    $cool->execute();
    return $cool->get_result();


}



public function countinvoice($search = ''){
   
$search_param = "%$search%";

    $sql = "select count(*) as total from invoices where ( invoice_codes like ? or client_name like ? or email like ? )";
    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sss", $search_param, $search_param,$search_param);
    $cool->execute();
    $result = $cool->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}


















}


?>