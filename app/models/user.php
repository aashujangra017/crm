<?php


require_once __DIR__ . "/../config/database.php";

class user {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();
    }

    public function create($name, $email, $phone, $status) {
        $sql = "insert into user (name, email, phone, status) values (?, ?, ?, ?)";

        $cool = $this->conn->prepare($sql);

        $cool->bind_param("ssss", $name, $email, $phone, $status);

        if ($cool->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    }




 // delete user model

public function deleteusers($id) {
   
    $sql = "delete from user where id = ?";
     
    $cool = $this->conn->prepare($sql);
    $cool->bind_param("i", $id);
    return $cool->execute();  
}















// fetch user in the table 


   public function fetchusers() {
        $sql = "select id, name, email, phone, status from user";
        $cool = $this->conn->prepare($sql);
        $cool->execute();
        $result = $cool->get_result();
        
        if (!$result) {
            die("Error in fetching: " . $this->conn->error);
        }

       
        return $result;
    }







    public function searchuser($name,$email,$phone,$status){


        $searchname = "%{$name}%";
        $searchemail = "%{$email}%";
        $searchphone = "%{$phone}%";
        $searchstatus = "%{$status}%";
       



       $sql = "select * FROM user 
                where (name LIKE ? OR ? = '') 
            
                and (email LIKE ? OR ? = '') 
                and (phone LIKE ? OR ? = '') 
                     and (status LIKE ? OR ? = '')
                order by id ASC";


      $cool = $this->conn->prepare($sql);
       $cool->bind_param(
            "ssssssss",
      
            $searchname, $name,
            $searchemail, $email,
            $searchphone, $phone,
             $searchstatus, $status
        );

        $cool->execute();

        return $cool->get_result();
        


    }



    //limit start from here


    public function limituser($limit){
        $sql = "select * from user limit ?";
        $cool = $this->conn->prepare($sql);
        
        $cool->bind_param("i",$limit);

        $cool->execute();

         return $cool->get_result();
        
        
        
        }


        //order asc and desc start form here


        public function orderuser ($order , $column){

        $sql = "select id, name, email,phone,status from user order by $column $order";

        $cool = $this->conn->prepare($sql);

      $cool->execute();

        return $cool->get_result();

        }


        



public function selectuser ($id){
     $sql = "select * from user where id = ?";
        $cool = $this->conn->prepare($sql);


        $cool->bind_param("i", $id);

        $cool->execute();
        return $cool->get_result();

    
}


 public function updateuser($id, $name, $email, $phone, $status) {

        $sql = "update user set name = ?, email = ?, phone = ?, status = ? where id = ?";

        $cool = $this->conn->prepare($sql);

        $cool->bind_param("ssssi", $name, $email, $phone, $status, $id);

        return $cool->execute();
    }


public function getallstatus(){

        $sql = "select id, sname from status";

        $cool = $this->conn->prepare($sql);

        $cool->execute();

        $result = $cool->get_result();

        return $result;
    }




    // search start from here 

    public function searchusers($keyword){
       $sql = "select * from user 
            where name like ? OR email like ? OR phone like ? OR status like ?";

    $cool = $this->conn->prepare($sql);

    $search = "%".$keyword."%";

    // bind 4 parameters
    $cool->bind_param("ssss", $search, $search, $search, $search);

    $cool->execute();

    return $cool->get_result();
}




//pagination start form here 


public function getuserbypage($limit,$offset){
    $sql = "select id,name,email,phone,status from user LIMIT ? OFFSET ?";

    $cool = $this->conn->prepare($sql);

    $cool->bind_param("ii",$limit,$offset);

    $cool->execute();

    return $cool->get_result();
}



//now count the user 


public function countuser(){
    $sql = "select count(*) as total from user ";
    
     $cool = $this->conn->prepare($sql);

     $cool->execute();

     $result = $cool->get_result();

     $row = $result->fetch_assoc();

     return $row['total'];

}
    


}








?>