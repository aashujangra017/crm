<?php


require_once __DIR__ . "/../models/invoice.php";
require_once __DIR__ . '/../../fpdf/fpdf.php';


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
                     <ul class='nav nav-tabs' id='myTab' role='tablist'>
                        <li class='nav-item' role='presentation'>
                            <button class=' btn btn-primary update-invoice'
                                    id='addclient'
                                    data-bs-toggle='tab'
                                    data-bs-target='#home-tab-pane'
                                    type='button'
                                    role='tab'
                                    data-eid='{$row['id']}'>
                               update
                            </button>
                        </li>
                    </ul>
                </td>
                <td>
               <button class='btn btn-success generate-pdf'  data-id='{$row['id']}'> PDF</button>
               </td>
               <td><button class='btn btn-warning'>Mail</button></td>
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








    // select controller for uddate 

public function selectinvoiceid() {
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];

        $object = new invoice();
        $userResult = $object->selectinvoice($id);

        if (!empty($userResult)) {
            echo json_encode($userResult); 
        } else {
            echo json_encode(['error' => 'No record found']);
        }
    } else {
        echo json_encode(['error' => 'User ID missing']);
    }
}
   


    // Function to handle invoice item update
    public function updateInvoiceItemAction() {
    if (isset($_POST['items']) && !empty($_POST['items'])) {
        $items = json_decode($_POST['items'], true);

        if (!$items) {
            echo json_encode(['error' => 'Invalid items data']);
            return;
        }

        $results = [];
        $failed_updates = [];

        foreach ($items as $item) {
            $item_id   = (int) $item['item_id'];
            $item_name = $item['item_name'];
            $price     = (float) $item['price'];
            $quantity  = (int) $item['quantity'];

           $object = new invoice();
$update_result = $object->updateInvoiceItem($item_id, $item_name, $price, $quantity);

            if (isset($update_result['error'])) {
                $failed_updates[] = [
                    'item_id' => $item_id,
                    'error'   => $update_result['error']
                ];
            } else {
                $results[] = [
                    'item_id' => $item_id,
                    'status'  => 'success'
                ];
            }
        }

        
        if (!empty($failed_updates)) {
            echo json_encode([
                'status' => 'failure',
                'failed_updates' => $failed_updates
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'updated_items' => $results
            ]);
        }
    } else {
        echo json_encode(['error' => 'No items to update']);
    }
}






//pdf controller start from here
public function generatepdf() {
    if (isset($_GET['id'])) {
        $invoiceId = $_GET['id']; 
        $object = new invoice();
        
        $invoiceData = $object->getinvoicedatabyid($invoiceId);
        $itemsData = $object->getInvoiceItemsById($invoiceId);
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        
        $pdf->Cell(0, 10, 'Invoice: ' . $invoiceData['invoice_codes'], 0, 1, 'C');
        $pdf->Cell(0, 10, 'Client Name: ' . $invoiceData['client_name'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $invoiceData['email'], 0, 1);
        $pdf->Cell(0, 10, 'Total: ' . number_format($invoiceData['total'], 2), 0, 1);
        $pdf->Cell(0, 10, 'Created At: ' . $invoiceData['created_at'], 0, 1);
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, 'Item', 1);
        $pdf->Cell(30, 10, 'Description', 1);
        $pdf->Cell(30, 10, 'Quantity', 1);
        $pdf->Cell(30, 10, 'Price', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();
        
        foreach ($itemsData as $item) {
            $pdf->Cell(30, 10, $item['item_name'], 1);
            $pdf->Cell(30, 10, $item['description'], 1);
            $pdf->Cell(30, 10, $item['quantity'], 1);
            $pdf->Cell(30, 10, number_format($item['price'], 2), 1);
            $pdf->Cell(30, 10, number_format($item['total'], 2), 1);
            $pdf->Ln();
        }
        
        // Send PDF as a response
        ob_end_clean();
        
        $pdf->Output('I', 'Invoice_' . $invoiceData['invoice_codes'] . '.pdf');
        exit();
    }
}

}









?>
