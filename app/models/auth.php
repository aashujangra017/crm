<?php

require_once __DIR__ . "/../config/database.php";

class auth {

    private $conn;

    function __construct() {
        $db = new database();
        $this->conn = $db->connection();
    }

    public function register($name, $email, $password) {
        
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "insert into register (name, email, password) values (?, ?, ?)";

        $cool = $this->conn->prepare($sql);
        
         $cool->bind_param("sss", $name, $email, $hashPassword);
         
            if ($cool->execute()) {
                echo "success";
            } else {
                echo "Error: " . $cool->error;
            }
    }



    
    public function findemail($email) {

        $sql = "select * from register where email = ?";


        $cool = $this->conn->prepare($sql);

        $cool->bind_param("s", $email);


        $cool->execute();

        $result = $cool->get_result();
        return $result->fetch_assoc();
    }



public function islogin(){

return isset($_SESSION['user_id']);

}



// public function logout(){
//     session_unset();
// session_destroy();

// echo "logout";

// }

public function logout() {


    $_SESSION = [];

    
    session_destroy();

   
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    echo "logout";
}
}





?>