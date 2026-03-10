<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: /cool/login"); 
    exit();
}


include "navbar.php";
include "usermaster.php";


?>