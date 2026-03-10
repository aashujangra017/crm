<?php


require_once __DIR__ . "/../config/database.php";

class client {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();
    }



    // public function createclient($name,$phone,$address,$state,$city,$pincode){

    // $sql = "insert into clientinsert (name,phone,address,state,city,pincode) values(?,?,?,?,?,?)";

    // $cool = $this->conn->prepare($sql);

    // $cool->bind_param("ssssss", $name,$phone,$address,$state,$city,$pincode);

    // if($cool->execute()){
    //     echo "success";

    // }else{
    //     echo "error";
    // }

    // }

    public function createclient($name,$phone,$address,$state,$city,$pincode){

$sql = "INSERT INTO clientinsert (name,phone,address,state_id,city,pincode)
        VALUES (?,?,?,?,?,?)";

$stmt = $this->conn->prepare($sql);

$stmt->bind_param("sssiss",$name,$phone,$address,$state,$city,$pincode);

return $stmt->execute();

}



    public function getallstates(){

        $sql = "select id, sname from states";

        $cool = $this->conn->prepare($sql);

        $cool->execute();

        $result = $cool->get_result();

        return $result;
    }



public function fetchallclient(){

$sql = "select c.id, c.name, c.phone, c.address, s.sname AS state, c.city, c.pincode 
        from clientinsert AS c 
        join states AS s ON c.state_id = s.id";

    $cool = $this->conn->prepare($sql);

    if(!$cool){
        die("Prepare failed: " . $this->conn->error);
    }

    $cool->execute();

    $result = $cool->get_result();

    if(!$result){
        die("Get result failed: " . $this->conn->error);
    }

    return $result;
}
    


//delete model start from here 



public function deleteclient($id) {

    $sql = "delete from clientinsert where id = ?";

    $cool = $this->conn->prepare($sql);

    $cool->bind_param("i", $id);

    $cool->execute();
 
}



//update client master first select the client data

public function selectclient($id){
    $sql = "SELECT c.id, c.name, c.phone, c.address, s.sname AS state, c.city, c.pincode
            FROM clientinsert AS c
            JOIN states AS s
            ON c.state_id = s.id
            WHERE c.id = ?";

    $cool = $this->conn->prepare($sql);
    $cool->bind_param("i", $id);
    $cool->execute();
    return $cool->get_result();
} 


//udpate start from here
 public function updateclient($id, $name, $phone, $address, $state, $city, $pincode) {
   
        $sql = "update clientinsert 
                SET name = ?, phone = ?, address = ?, state_id = (SELECT id FROM states WHERE sname = ?), city = ?, pincode = ? 
                WHERE id = ?";

       
        $cool = $this->conn->prepare($sql);

      
        $cool->bind_param("ssssssi", $name, $phone, $address, $state, $city, $pincode, $id);

   
        $cool->execute();
       
    }


    //search for client 


 public function searchclient($keyword){

    $sql = "select c.id, c.name, c.phone, c.address, s.sname, c.city, c.pincode 
            FROM clientinsert AS c 
            JOIN states AS s ON c.state_id = s.id
            WHERE c.name LIKE ?
            OR c.phone LIKE ?
            OR c.city LIKE ?
            OR s.sname LIKE ?
            OR c.pincode LIKE ?";

    $cool = $this->conn->prepare($sql);

    $search = "%".$keyword."%";

    $cool->bind_param("sssss",$search,$search,$search,$search,$search);

    $cool->execute();

    return $cool->get_result();
}





//pagination start form here 


public function getclientbypage($limit, $offset) {
   
    $sql = "SELECT c.id, c.name, c.phone, c.address, s.sname, c.city, c.pincode 
            FROM clientinsert AS c join states AS s ON c.state_id = s.id 
            LIMIT ? OFFSET ?";

    
    $cool = $this->conn->prepare($sql);

   
    // if ($cool === false) {
    //     die('MySQL prepare error: ' . $this->conn->error);
    // }
   
    $cool->bind_param("ii", $limit, $offset);

    $cool->execute();

    return $cool->get_result();
}

public function clientcount(){
    $sql = "select count(*) as total from clientinsert";

    $cool = $this->conn->prepare($sql);

    $cool->execute();
    $result = $cool->get_result();

    $row = $result->fetch_assoc();

    return $row['total'];
}
        
 


public function orderclient($column, $order){
   
      $allowedColumns = ['id', 'name', 'phone'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($column, $allowedColumns)) {
        $column = 'id';
    }

    if (!in_array($order, $allowedOrder)) {
        $order = 'ASC';
    }

    $sql = "select c.id, c.name, c.phone, c.address, s.sname, c.city, c.pincode from clientinsert AS c join states AS s ON c.state_id = s.id order by $column $order";

    $cool = $this->conn->prepare($sql);
    $cool->execute();

    return $cool->get_result();
}






}








?>