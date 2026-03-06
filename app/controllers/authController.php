<?php

require_once __DIR__ . "/../models/auth.php";

class authController {




    public function registeruser() {

   
        if (isset($_POST['name'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];

            $password = $_POST['password'];

            

            $userModel = new auth();
            $userModel->register($name, $email, $password);

        }else{
            echo "data in missing";
        }
    }




    // public function login(){


    // if(isset($_POST['email'] && isset($_POST['password']))){
          

    // $email = $_POST['email'];
    // $password = $_POST['password'];


    // $userLogin = new auth();
    // $userLogin->findemail($email,$password);




    // }
        


    // }






    public function login() {

        if (isset($_POST['email'], $_POST['password'])) {


              $email = $_POST['email'];
            $password = $_POST['password'];

               $userModel = new Auth();

       
              $user = $userModel->findemail($email);

          if ($user && password_verify($password, $user['password'])) {

                session_start();

                    $_SESSION['user_id'] = $user['id'];

                 $_SESSION['user_name'] = $user['name'];
                  $_SESSION['user_email'] = $user['email'];

                echo "success";

            } else {
                echo "invalid email and password";
         }

        } else {
            echo "data is missing";
    }
    }



    public function logoutuser() {
        session_start();
    $userModel = new auth();
    $userModel->logout();  
}

    






}

?>