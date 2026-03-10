<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: /cool/login"); 
    exit();
}

require 'navbar.php';
require 'dashhome.php';


?>