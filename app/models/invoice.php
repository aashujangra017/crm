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







// select form udapte start from here 

public function selectinvoice($id){
     $sql = "SELECT i.id AS invoice_id, i.invoice_codes, i.client_name, i.email, i.phone, i.total, i.created_at,
                   ii.id AS item_id, ii.item_name, ii.price, ii.quantity
            FROM invoices i
            LEFT JOIN invoice_items ii ON i.id = ii.invoice_id
            WHERE i.id = ?";

     $cool = $this->conn->prepare($sql);


     $cool->bind_param("i", $id);

     $cool->execute();
        $result = $cool->get_result();

        $data = [];

        while ($row = $result->fetch_assoc()) {
       
            if (!isset($data['invoice'])) {
                $data['invoice'] = [
                    'invoice_id'   => $row['invoice_id'],
                    'invoice_codes'=> $row['invoice_codes'],
                    'client_name'  => $row['client_name'],
                    'email'        => $row['email'],
                    'phone'        => $row['phone'],
                    'total'        => $row['total'],
                    'created_at'   => $row['created_at']
                ];
            }

          
            if ($row['item_id']) {
                $data['items'][] = [
                    'item_id'   => $row['item_id'],
                    'item_name' => $row['item_name'],
                    'price'     => $row['price'],
                    'quantity'  => $row['quantity']
                ];
            }
        }

        return $data;
    }



    ///update start form here 
public function updateInvoiceItem($item_id, $item_name, $price, $quantity) {
    // Update item in invoice_items
    $sql = "UPDATE invoice_items SET item_name = ?, price = ?, quantity = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        return ['error' => 'Prepare failed: ' . $this->conn->error];
    }
    $stmt->bind_param("sdii", $item_name, $price, $quantity, $item_id);

    if ($stmt->execute()) {
        // After updating, recalculate the total of the invoice
        $invoice_id = $this->getInvoiceIdByItemId($item_id);
        $new_total = $this->recalculateInvoiceTotal($invoice_id);

        // Update the total in the invoices table
        return $this->updateInvoiceTotal($invoice_id, $new_total);
    } else {
        return ['error' => 'Update failed: ' . $stmt->error];
    }
}

    // Helper function to get the invoice_id for a given item
    private function getInvoiceIdByItemId($item_id) {
        $sql = "SELECT invoice_id FROM invoice_items WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['invoice_id'] ?? null;
    }

    // Function to recalculate the total of an invoice
    private function recalculateInvoiceTotal($invoice_id) {
    $sql = "SELECT SUM(price * quantity) AS total FROM invoice_items WHERE invoice_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $invoice_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'] ?? 0.00;
}

    
    public function updateInvoiceTotal($invoice_id, $new_total) {
    $sql = "UPDATE invoices SET total = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        return ['error' => 'Prepare failed: ' . $this->conn->error];
    }
    $stmt->bind_param("di", $new_total, $invoice_id);

    if ($stmt->execute()) {
        return ['success' => 'Invoice item and total updated successfully'];
    } else {
        return ['error' => 'Failed to update invoice total: ' . $stmt->error];
    }
}






// to generate phh modle 


public function getinvoicedatabyid($invoiceId){
    $sql = "select * from invoices where id = ?";

    $cool = $this->conn->prepare($sql);
    $cool->bind_param('i',$invoiceId);

    $cool->execute();

    $result = $cool->get_result();

    return $result->fetch_assoc();
}


public function getInvoiceItemsById($invoiceId) {
        $sql = "SELECT * FROM invoice_items WHERE invoice_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $invoiceId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }




}


?>