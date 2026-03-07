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


//select for udpate controller start from here 
public function itemselect() {
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];

        $object = new item(); 
        $itemresult = $object->selectitem($id);

        if ($itemresult && $itemresult->num_rows > 0) {
            $row = $itemresult->fetch_assoc();

            echo "
            <form id='edit-item-form' enctype='multipart/form-data'>
                <input type='hidden' id='edit-id' value='{$row['id']}'>
                
                <div class='form-group'>
                    <label for='edit-itemname' class='fw-bold'>Item Name</label>
                    <input type='text' id='edit-itemname' class='form-control' value='{$row['itemname']}'>
                </div>

                <div class='form-group'>
                    <label for='edit-price' class='fw-bold'>Price</label>
                    <input type='text' id='edit-price' class='form-control' value='{$row['price']}'>
                </div>

                <div class='form-group'>
                    <label for='edit-description' class='fw-bold'>Description</label>
                    <textarea id='edit-description' class='form-control'>{$row['description']}</textarea>
                </div>

                <div class='form-group'>
                    <label for='edit-image' class='fw-bold'>Image</label>
                    <input type='file' id='edit-image' class='form-control'>
                    <img src='uploads/{$row['image']}' alt='Item Image' width='100' class='mt-2'>
                </div>

                <div class='form-group mt-3'>
                    <button type='button' id='update-item' class='btn btn-success'>Save</button>
                </div>
            </form>
            ";
        } else {
            echo "<p>No Record Found</p>";
        }
    } else {
        echo "<p>Item ID missing</p>";
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