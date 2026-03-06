<?php


class database{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "major";
    public $port = 4419;
    private $conn;



    public function __construct(){
        $this->conn = new mysqli ($this->servername , $this->username, $this->password,$this->database,$this->port);

         if($this->conn->connect_error){
        die("database is not connect" . $this->conn->connect_error);
            }
    }

    public function connection() {
        return $this->conn;
    }

}


?>