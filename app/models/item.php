<?php


require_once __DIR__ . "/../config/database.php";

class item {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();
    }


    public function insertitem($itemname, $price, $description, $file) {
        $fileName = $file['name'];
        $fileTmp  = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileErr  = $file['error'];

        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];



        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {

            return "Invalid file type.";
        }

        if ($fileErr !== 0) {

            return "Upload Error.";
        }

        if ($fileSize > 2 * 1024 * 1024) {

            return "File too large. Max size is 2MB.";
        }

        $newName = time() . "_" . $fileName;

        $destination = "uploads/" . $newName;

        if (move_uploaded_file($fileTmp, $destination)) {
            $sql = "insert into items (itemname, price, description, image) VALUES (?, ?, ?, ?)";
            $cool = $this->conn->prepare($sql);

            $cool->bind_param("sdss", $itemname, $price, $description, $newName);

            if ($cool->execute()) {
                return "item upload successfully!";
            } else {
                return "db error: " . $cool->error;
            }
        } else {
            return "Failed to move uploaded file.";
        }
    }





// fetch model start form here 

    public function fetchallitem(){
        $sql = "select * from items";

        $cool = $this->conn->prepare($sql);


        $cool->execute();
        $result = $cool->get_result();

        if(!$result){
        die("Get result failed: " . $this->conn->error);
    }

    return $result;
    }


    //delete model start form here


    public function deleteitem($id){
        $sql = "select * from items where id = ?";
         $cool = $this->conn->prepare($sql);

         $cool->bind_param("i",$id);

         $cool->execute();
         

    }



    //search model start form here


public function searchitem($keyword){
    $sql = "SELECT id, itemname, price, description , image FROM items WHERE itemname LIKE ? OR price LIKE ? OR description LIKE ?";
    $cool = $this->conn->prepare($sql);

       $search = "%".$keyword."%";

       $cool->bind_param("sss", $search, $search, $search);

       $cool->execute();

       return $cool->get_result();
}



   


        
 











}








?>