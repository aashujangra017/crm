<?php


require_once __DIR__ . "/../models/item.php";


class itemController{

public function itemhome() {
       require __DIR__ . "/../../public/views/itemhome.php";
    }

    
public function itemstart() {
       require __DIR__ . "/../../public/views/itemhome.php";
    }


    //insert controller start form here 
public function iteminsert(){
    if (isset($_POST['submit']) && isset($_POST['itemname']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image'])) {
        $itemname = $_POST['itemname'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $file = $_FILES['image']; 

        $object = new item();

        $result = $object->insertitem($itemname, $price, $description, $file);

        if($result) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "POST data is missing";
    }
}



//fetch controller start form here
public function fetchitem(){
   $object = new item();
   $items = $object->fetchallitem();

   require_once 'itemtable.php';



}



// delete start from here 

public function delete() {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $object = new item();
        if ($object->deleteitem($id)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "item id missing";
    }
}

//select for udpate controller start from here 
public function itemselect() {
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];

        $object = new item(); 
        $itemresult = $object->selectitem($id);
    if ($itemresult && $itemresult->num_rows > 0) {
            $row = $itemresult->fetch_assoc();
          
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No record found']);
        }
    } else {
        echo json_encode(['error' => 'ID missing']);
    }
}



//update start from here 

public function itemupdate() {
    if (isset($_POST['id'], $_POST['itemname'], $_POST['price'], $_POST['description'])) {
        $id = (int)$_POST['id'];
        $itemname = $_POST['itemname'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $object = new item();

        if (isset($_FILES['image']) ) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileTmp  = $file['tmp_name'];
            $fileSize = $file['size'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

            if (!in_array($ext, $allowed)) {
                echo "Invalid file type.";
                return;
            }

            if ($fileSize > 2 * 1024 * 1024) {
                echo "File too large. Max size is 2MB.";
                return;
            }

            $newName = time() . "_" . $fileName;
            $destination = "uploads/" . $newName;

            if (move_uploaded_file($fileTmp, $destination)) {
                $image = $newName;
            } else {
                echo "Failed to move uploaded file.";
                return;
            }
        } else {
            $selectResult = $object->selectitem($id);
            if ($selectResult && $selectResult->num_rows > 0) {
                $row = $selectResult->fetch_assoc();
                $image = $row['image'];
            } else {
                echo "Item not found.";
                return;
            }
        }

        $object->updateitem($itemname, $price, $description, $image, $id);
    } else {
        echo "POST data is missing";
    }
}







//     //search controller start form here 


//     public function search(){
//       if(isset($_POST['search'])){
//          $keyword = $_POST['search'];

//          $object = new item();

//          $items = $object->searchitem($keyword);

//          require_once 'itemtable.php';

//       }
//     }

    
// // pagination for the item start from here 
// public function itempagination(){

// header('Content-Type: application/json');
// $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;

// $limit = isset($_POST['limit']) ? (int) $_POST['limit'] : 5;


// if($page < 1){
//     $page = 1;
// }


// $offset = ($page - 1) * $limit;

// $object = new item();

// $users = $object->getitempage($limit,$offset); 

// $totalitems = $object->countitem();

// $totalPages = ceil($totalitems / $limit);

// $table = "";

// if($users->num_rows > 0){

//     while($row = $users->fetch_assoc()){

    //     $table .= "<tr>
    //         <td>{$row['id']}</td>
    //         <td>{$row['itemname']}</td>
    //         <td>{$row['price']}</td>
    //         <td>{$row['description']}</td>
    //         <td><img src='uploads/{$row['image']}' width='100'></td>
    //         <td>
    //             <button class='deletebutton btn btn-danger' data-id='{$row['id']}'>Delete</button>
    //         </td>
    //         <td>
    //     <ul class='nav nav-tabs' id='myTab' role='tablist'>
    //         <li class='' role='presentation'>
    //             <button class='btn btn-primary update-btn'
    //                     id='addclient'
    //                     data-bs-toggle='tab'
    //                     data-bs-target='#home-tab-pane'
    //                     type='button'
    //                     role='tab'
    //                     data-eid='{$row['id']}'>
    //               Update
    //             </button>
    //         </li>
    //     </ul>
    // </td>
    //     </tr>";
//     }

// }

// $response = [
//     "table" => $table,
//     "page" => $page,
//     "totalPages" => $totalPages
// ];

// echo json_encode($response);

// }





// // item order by controller start form here 
// public function orderitems(){

//     $column = $_POST['column'];
//     $order = $_POST['order'];

//     if($column != 'id' && $column != 'itemname' && $column != 'price'){
//         $column = 'id';
//     }

//     if($order != 'ASC' && $order != 'DESC'){
//         $order = 'ASC';
//     }

//     $object = new item();
//     $items = $object->orderitem($column,$order);

//     require_once "itemtable.php";
// }




public function itempagination() {
    header('Content-Type: application/json');

    $page    = isset($_POST['page'])    ? (int)$_POST['page']       : 1;
    $limit   = isset($_POST['limit'])   ? (int)$_POST['limit']      : 5;
    $search  = isset($_POST['search'])  ? trim($_POST['search'])     : '';
    $orderCol = isset($_POST['orderCol']) ? $_POST['orderCol']       : 'id';
    $orderDir = isset($_POST['orderDir']) ? $_POST['orderDir']       : 'ASC';

    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $object     = new item();
    $users      = $object->getUsersFiltered($limit, $offset, $search, $orderCol, $orderDir);
    $totalUsers = $object->countUsersFiltered($search);
    $totalPages = ceil($totalUsers / $limit);

    $table = "";
    if ($users->num_rows > 0) {
        while ($row = $users->fetch_assoc()) {
            
            $table .="<tr>
            <td>{$row['id']}</td>
            <td>{$row['itemname']}</td>
            <td>{$row['price']}</td>
            <td>{$row['description']}</td>
            <td><img src='uploads/{$row['image']}' width='100'></td>
            <td>
                <button class='deletebutton btn btn-danger' data-id='{$row['id']}'>Delete</button>
            </td>
            <td>
        <ul class='nav nav-tabs' id='myTab' role='tablist'>
            <li class='' role='presentation'>
                <button class='btn btn-primary update-btn'
                        id='addclient'
                        data-bs-toggle='tab'
                        data-bs-target='#home-tab-pane'
                        type='button'
                        role='tab'
                        data-eid='{$row['id']}'>
                  Update
                </button>
            </li>
        </ul>
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