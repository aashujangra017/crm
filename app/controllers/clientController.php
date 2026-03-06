<?php


require_once __DIR__ . "/../models/client.php";


class clientController{

public function clienthome() {
       require __DIR__ . "/../../public/views/clienthome.php";
    }


 
public function insertclient(){
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) 
        && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['pin'])) {

        $name    = $_POST['name'];
        $phone   = $_POST['phone'];
        $address = $_POST['address'];
        $state   = $_POST['state'];
        $city    = $_POST['city'];
        $pin     = $_POST['pin'];

        $object = new client();
        $result = $object->createclient($name,$phone,$address,$state,$city,$pin);

        if($result){
            echo "success";  
        }else{
            echo "failed";
        }

    } else {
        echo "POST data is missing";
    }
}

    

public function states(){

    $object = new client();
    $result = $object->getallstates();

    $options = "";

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            $options .= "<option value='".$row['id']."'>".$row['sname']."</option>";

        }

    }

    echo $options;
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

    if (isset($_POST['id'])) {

        $id = (int)$_POST['id'];  

        $object = new client();
        $userResult = $object->selectclient($id); 

        if ($userResult && $userResult->num_rows > 0) {
            $row = $userResult->fetch_assoc();

            echo "
            <form id='edit-user-form' >
                <input type='hidden' id='edit-id' value='{$row['id']}'>
                
                <div class='form-group'>
                    <label for='edit-name' class='fw-bold'>Name</label>
                    <input type='text' id='edit-name' class='form-control' value='{$row['name']}'>
                </div>

               
                <div class='form-group'>
                    <label for='edit-phone' class='fw-bold'>Phone</label>
                    <input type='text' id='edit-phone' class='form-control' value='{$row['phone']}'>
                </div>

                <div class='form-group'>
                    <label for='edit-address' class='fw-bold'>Address</label>
                    <input type='text' id='edit-address' class='form-control' value='{$row['address']}'>
                </div>
                
                <div class='form-group'>
                    <label for='edit-state' class='fw-bold'>State</label>
                    <input type='text' id='edit-state' class='form-control' value='{$row['state']}'>
                </div>
                
                <div class='form-group'>
                    <label for='edit-city' class='fw-bold' >City</label>
                    <input type='text' id='edit-city' class='form-control' value='{$row['city']}'>
                </div>
                 <div class='form-group'>
                    <label for='edit-pin' class='fw-bold'>Pin</label>
                    <input type='text' id='edit-pin' class='form-control' value='{$row['pincode']}'>
                </div>

                <div class='form-group mt-3'>
                    <button type='button' id='update-client' class='btn btn-success'>Save</button>
                </div>
            </form>
            ";
        } else {
            echo "<p>No Record Found</p>";
        }

    } else {
        echo "<p>User ID missing</p>";
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


    //serach controller from here


    public function search (){
        if(isset($_POST['search'])){
            $keyword = $_POST['search'];

            $object = new client();
           $users = $object->searchclient($keyword);

           require_once 'clienttablesearch.php';
        }
    }





}

?>