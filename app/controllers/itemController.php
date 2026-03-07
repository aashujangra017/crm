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
        $object->deleteitem($id); 


        echo "success";
    } else {
        echo "item id missing";
    }
}





    //search controller start form here 


    public function search(){
      if(isset($_POST['search'])){
         $keyword = $_POST['search'];

         $object = new item();

         $items = $object->searchitem($keyword);

         require_once 'itemtable.php';

      }
    }

    





}

?>