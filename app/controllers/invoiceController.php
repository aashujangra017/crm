<?php


require_once __DIR__ . "/../models/invoice.php";


class invoiceController{

public function clienthome() {
       require __DIR__ . "/../../public/views/clienthome.php";
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
    

}

?>