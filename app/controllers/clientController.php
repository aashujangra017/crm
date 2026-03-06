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






}

?>