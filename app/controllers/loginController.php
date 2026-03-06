


<?php

require_once __DIR__ . "/../models/auth.php";

class loginController {


    public function loginmethod() {

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



    






}

?>