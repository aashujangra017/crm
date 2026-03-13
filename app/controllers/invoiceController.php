<?php


require_once __DIR__ . "/../models/invoice.php";


class invoiceController{

public function clienthome() {
       require __DIR__ . "/../../public/views/clienthome.php";
    }


public function getclient() {
    $search = isset($_GET['query']) ? $_GET['query'] : '';

    $object = new invoice();
    $clients = $object->getClients($search);

    if ($clients) {
        echo json_encode(['clients' => $clients]);
    } else {
        echo json_encode(['clients' => []]);
    }
}









public function getitem() {
    $search = isset($_GET['query']) ? $_GET['query'] : '';

    $object = new Invoice();
    $items = $object->getitems($search);  

    if ($items) {
        echo json_encode(['items' => $items]); 
    } else {
        echo json_encode(['items' => []]); 
    }
}

















public function getclientfetchDetails() {
    $clientName = isset($_POST['name']) ? trim($_POST['name']) : '';
    
    if (!empty($clientName)) {
        $object = new invoice();
        $clientDetails = $object->selectClientByName($clientName);

        if ($clientDetails) {
            echo json_encode($clientDetails);
        } else {
            echo json_encode(['message' => 'Client not found']);
        }
    } else {
        echo json_encode(['message' => 'Client name is required']);
    }
}


public function getitemfetchDetails() {
    $itemName = isset($_POST['name']) ? trim($_POST['name']) : '';
    
    if (!empty($itemName)) {
        $object = new invoice();
        // Change selectClientByName to selectitemByName as you're fetching item details.
        $itemDetails = $object->selectitemByName($itemName);

        if ($itemDetails) {
            echo json_encode($itemDetails);
        } else {
            echo json_encode(['message' => 'Item not found']);
        }
    } else {
        echo json_encode(['message' => 'Item name is required']);
    }
}












 public function saveInvoice() {
        $data = json_decode(file_get_contents("php://input"), true);

      if (isset($data['invoiceid'],$data['clientname'], $data['invoiceemail'], $data['invoicephone'], $data['total'], $data['items'])) {

    $object = new invoice();

    $invoice_id = $object->insertInvoice(
        $data['invoiceid'],
        $data['clientname'],
        $data['invoiceemail'],
        $data['invoicephone'],
        $data['total'],
        $data['items']
    );

      echo json_encode(['status' => 'success', 'invoice_id' => $invoice_id]);
    } else {
       echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        }
    }
    




  public function fetchinvoice(){

    $object = new invoice();

    $users = $object->fetchallinvoice();

    require_once 'invoicetable.php';

}





//invoice search limit and order by controller start form here



public function invoicepagination(){

header('Content-Type: application/json');

  $page    = isset($_POST['page'])    ? (int)$_POST['page']       : 1;
    $limit   = isset($_POST['limit'])   ? (int)$_POST['limit']      : 5;
    $search  = isset($_POST['search'])  ? trim($_POST['search'])     : '';
    $orderCol = isset($_POST['orderCol']) ? $_POST['orderCol']       : 'id';
    $orderDir = isset($_POST['orderDir']) ? $_POST['orderDir']       : 'ASC';

    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $object = new invoice();

   $users = $object->getinvoice($limit,$offset,$search,$orderCol,$orderDir);

     $totalUsers = $object->countinvoice($search);

    $totalPages = ceil($totalUsers / $limit);


   $table = "";

   if ($users->num_rows > 0) {
        while ($row = $users->fetch_assoc()) {
            
            $table .="<tr>
                <td>{$row['id']}</td>
                <td>{$row['invoice_codes']}</td>
                <td>{$row['client_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['total']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <button class='btn btn-primary update-btn'
                            data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
              </tr>";
        }
    } else {
        $table = "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
    }

    echo json_encode([
        "table"      => $table,
        "page"       => $page,
        "totalPages" => $totalPages,
        "totalUsers" => $totalUsers,
    ]);

   








}





}

?>
