<?php


require_once __DIR__ . "/../models/client.php";


class clientController{

public function clienthome() {
       require __DIR__ . "/../../public/views/clienthome.php";
    }


 
// public function insertclient(){
//     if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) 
//         && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['pin'])) {

//         $name    = $_POST['name'];
//         $phone   = $_POST['phone'];
//         $address = $_POST['address'];
//         $state   = $_POST['state'];
//         $city    = $_POST['city'];
//         $pin     = $_POST['pin'];

//         $object = new client();
//         $result = $object->createclient($name,$phone,$address,$state,$city,$pin);

//         if($result){
//             echo "success";  
//         }else{
//             echo "failed";
//         }

//     } else {
//         echo "POST data is missing";
//     }
// }

    

// public function states(){

//     $object = new client();
//     $result = $object->getallstates();

//     $options = "";

//     if($result->num_rows > 0){

//         while($row = $result->fetch_assoc()){

//             $options .= "<option value='".$row['id']."'>".$row['sname']."</option>";

//         }

//     }

//     echo $options;
// }


// inserrt controller start 



public function insertclient() {
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address'])
        && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['pin'])) {

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];

        $object = new client();
        $result = $object->createclient($name, $phone, $address, $state, $city, $pin);

        if ($result) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "POST data is missing";
    }
}



public function states() {
    $object = new client();
    $result = $object->getallstates();
    $options = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['id'] . "'>" . $row['sname'] . "</option>";
        }
    }
    echo $options;
}



public function cities() {
    if (isset($_POST['state_id']) && $_POST['state_id'] !== '') {
        $state_id = intval($_POST['state_id']); 

        $object = new client();

        $result = $object->getcitiesbystate($state_id);
        
        $options = "";

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $options .= "<option value='" . htmlspecialchars($row['cname']) . "'>" 
                          . htmlspecialchars($row['cname']) . "</option>";
            }
        }
        echo $options;
    } else {
        echo ""; 
    }
}


// fetch controller start from here 
public function fetchclient(){

$object = new client();
$users = $object->fetchallclient();

require_once 'clienttable.php';

    }






//delete controlller start form here




public function delete() {


    if (isset($_POST['id'])) {


        $id = $_POST['id'];

        $object = new client();
        $object->deleteclient($id); 


        echo "success";
    } else {
        echo "client ID missing";
    }
}





//select start form here for the update 

public function selectclientform() {
     header('Content-Type: application/json');

    if (isset($_POST['id'])) {

        $id = (int)$_POST['id'];  

        $object = new client();
        $userResult = $object->selectclient($id); 

        if ($userResult && $userResult->num_rows > 0) {
            $row = $userResult->fetch_assoc();
          
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No record found']);
        }
    } else {
        echo json_encode(['error' => 'ID missing']);
    }
}


//udpate controller start form here


public function update() {
      
        if (isset($_POST['id'], $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['state'], $_POST['city'], $_POST['pincode'])) {

            
            $id = $_POST['id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $pincode = $_POST['pincode'];

           $object = new client();
             $result = $object->updateclient($id, $name, $phone, $address, $state, $city, $pincode);

            
       if($result){
            echo "success";
           }else{
            echo "error";
           }


    }else{
        echo "Post data is missing";
    }

    }


//     //serach controller from here


//     public function search (){
//         if(isset($_POST['search'])){
//             $keyword = $_POST['search'];

//             $object = new client();
//            $users = $object->searchclient($keyword);

//            require_once 'clienttablesearch.php';
//         }
//     }



//     //pagination controller start form here 


//    public function clientpagination(){
//     header('Content-Type: application/json');

//     $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
//     $limit = isset($_POST['limit']) ? (int) $_POST['limit'] : 5;

//     if($page < 1) {
//         $page = 1;
//     }

//     $offset = ($page - 1) * $limit;

//     $object = new client();
//     $users = $object->getclientbypage($limit, $offset);

//     $totalusers = $object->clientcount();

//     $totalPages = ceil($totalusers / $limit);

//     $table = "";

//     if($users->num_rows > 0) {
//         while($row = $users->fetch_assoc()) {
//             $table .= "<tr>
//                         <td>{$row['id']}</td>
//                         <td>{$row['name']}</td>
//                         <td>{$row['phone']}</td>
//                         <td>{$row['address']}</td>
//                         <td>{$row['sname']}</td>
//                         <td>{$row['city']}</td>
//                         <td>{$row['pincode']}</td>
//                         <td>
//                             <button class='clientbtn btn btn-danger' data-id='{$row['id']}'>Delete</button>
//                         </td>
//                                  <td>
//         <ul class='nav nav-tabs' id='myTab' role='tablist'>
//             <li class='' role='presentation'>
//                 <button class='btn btn-primary update-btn'
//                         id='addclient'
//                         data-bs-toggle='tab'
//                         data-bs-target='#home-tab-pane'
//                         type='button'
//                         role='tab'
//                         data-eid='{$row['id']}'>
//                   Update
//                 </button>
//             </li>
//         </ul>
//     </td>
//                     </tr>";
//         }
//     }

//     $response = [
//         "table" => $table,
//         "page" => $page,
//         "totalPages" => $totalPages
//     ];

//     echo json_encode($response);
// }




// //order by start form here



// public function clientorder(){

//   $column = $_POST['column'];
//     $order = $_POST['order'];

//     if($column != 'id' && $column != 'itemname' && $column != 'price'){
//         $column = 'id';
//     }

//     if($order != 'ASC' && $order != 'DESC'){
//         $order = 'ASC';
//     }

//     $object = new client();

//     $users = $object->orderclient($column,$order);

//     require_once "clienttablesearch.php";

// }




public function clientpagination() {
    header('Content-Type: application/json');

    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $orderCol = isset($_POST['orderCol']) ? trim($_POST['orderCol']) : 'c.id';
    $orderDir = isset($_POST['orderDir']) ? trim($_POST['orderDir']) : 'ASC';

    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $object = new client();
    $clients = $object->getclientfiltered($limit, $offset, $search, $orderCol, $orderDir);
    $totalusers = $object->clientcountfiltered($search);

    $totalPages = ceil($totalusers / $limit);

    $table = "";

    if ($clients->num_rows > 0) {
        while ($row = $clients->fetch_assoc()) {
            $table .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['address']}</td>
                <td>{$row['sname']}</td>
                <td>{$row['city']}</td>
                <td>{$row['pincode']}</td>
                <td>
                    <button class='clientbtn btn btn-danger' data-id='{$row['id']}'>Delete</button>
                </td>
                <td>
                    <button class='btn btn-primary update-btn'
                            data-bs-toggle='tab'
                            data-bs-target='#home-tab-pane'
                            type='button'
                            data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
            </tr>";
        }
    } else {
        $table = "<tr><td colspan='9' class='text-center text-muted py-3'>No clients found</td></tr>";
    }

    echo json_encode([
        "table" => $table,
        "page" => $page,
        "totalPages" => $totalPages,
        "totalUsers" => $totalusers,
    ]);
} 



}

?>