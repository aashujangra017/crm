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

//     public function createclient($name,$phone,$address,$state,$city,$pincode){

// $sql = "INSERT INTO clientinsert (name,phone,address,state_id,city,pincode)
//         VALUES (?,?,?,?,?,?)";

// $stmt = $this->conn->prepare($sql);

// $stmt->bind_param("sssiss",$name,$phone,$address,$state,$city,$pincode);

// return $stmt->execute();

// }



//     public function getallstates(){

//         $sql = "select id, sname from states";

//         $cool = $this->conn->prepare($sql);

//         $cool->execute();

//         $result = $cool->get_result();

//         return $result;
//     }



// insert start form here 



public function createclient($name, $phone, $address, $state, $city, $pincode) {
    $sql = "INSERT INTO clientinsert (name, phone, address, state_id, city, pincode)
            VALUES (?, ?, ?, ?, ?, ?)";
    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sssiss", $name, $phone, $address, $state, $city, $pincode);
    return $cool->execute();
}

public function getallstates() {
    


    $sql = "select id, sname from states";
    $cool = $this->conn->prepare($sql);
    $cool->execute();
    $result = $cool->get_result();
    return $result;
}


public function getcitiesbystate($state_id) {
    $sql = "SELECT id, cname FROM cities WHERE state_id = ?";
    $cool = $this->conn->prepare($sql);
    $cool->bind_param("i", $state_id);
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
        LEFT JOIN states AS s ON c.state_id = s.id
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
public function getclientfiltered($limit, $offset, $search = '', $orderCol = 'c.id', $orderDir = 'ASC') {
    $allowed_columns = ['c.id', 'c.name', 'c.phone', ];
    $allowed_dirs = ['ASC', 'DESC'];

    $orderCol = in_array($orderCol, $allowed_columns) ? $orderCol : 'c.id';
    $orderDir = in_array($orderDir, $allowed_dirs) ? $orderDir : 'ASC';

    $search_param = "%$search%";

    $sql = "select c.id, c.name, c.phone, c.address, s.sname, c.city, c.pincode
            FROM clientinsert AS c
            JOIN states AS s ON c.state_id = s.id
            WHERE (c.name LIKE ? OR c.phone LIKE ? OR c.city LIKE ?)
            ORDER BY $orderCol $orderDir
            LIMIT ? OFFSET ?";

    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sssii", $search_param, $search_param, $search_param, $limit, $offset);
    $cool->execute();
    return $cool->get_result();
}

public function clientcountfiltered($search = '') {
    $search_param = "%$search%";

    $sql = "select COUNT(*) AS total
            FROM clientinsert AS c
            JOIN states AS s ON c.state_id = s.id
            WHERE (c.name LIKE ? OR c.phone LIKE ? OR c.city LIKE ?)";

    $cool = $this->conn->prepare($sql);
    $cool->bind_param("sss", $search_param, $search_param, $search_param);
    $cool->execute();
    $result = $cool->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}
























}

?>