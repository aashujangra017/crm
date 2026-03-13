<?php


require_once __DIR__ . "/../config/database.php";

class item {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();
    }

  //insert for the clinet start form here

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


  public function deleteitem($id) {
    $sql = "DELETE FROM items WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


    //update for select the user for ther id update start from here 


 public function selectitem($id) {
    $sql = "SELECT * FROM items WHERE id = ?";
    $cool = $this->conn->prepare($sql);
   
    $cool->bind_param("i", $id);
    $cool->execute();
    $result = $cool->get_result();
  
    return $result;
}

  public function updateitem($itemname,$price,$description,$image,$id){
    $sql = "update items set itemname = ?, price = ? , description = ?, image = ? where id = ? ";

    $cool = $this->conn->prepare($sql);
     
    $cool->bind_param("sdssi", $itemname, $price, $description, $image, $id);
     if ($cool->execute()) {
        echo "success";
    } else {
        echo "error";
    }
      }






    
 



public function getUsersFiltered($limit, $offset, $search = '', $orderColumn = 'id', $orderDir = 'ASC') {
    $allowed_columns = ['id', 'itemname', 'price'];
    $allowed_dirs    = ['ASC', 'DESC'];

    $orderColumn = in_array($orderColumn, $allowed_columns) ? $orderColumn : 'id';
    $orderDir    = in_array($orderDir, $allowed_dirs)    ? $orderDir    : 'ASC';

    $search_param = "%$search%";

    $sql = "SELECT id, itemname, price, description , image from items
            WHERE (itemname LIKE ? OR price LIKE ?)
            ORDER BY $orderColumn $orderDir
            LIMIT ? OFFSET ?";

    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sdii", $search_param, $search_param, $limit, $offset);
    $cool->execute();
    return $cool->get_result();
}




public function countUsersFiltered($search = '') {
    $search_param = "%$search%";
    $sql = "SELECT COUNT(*) AS total FROM items WHERE (itemname LIKE ? OR price LIKE ?)";
    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sd", $search_param, $search_param);
    $cool->execute();
    $result = $cool->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}













}








?>