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






   


        
 











}








?>