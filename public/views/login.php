<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="/cool/public/bootstrap/css/login.css">
    <!-- <script src="/cool/public/bootstrap/js/jquery.js"></script> -->


</head>
<body>
    <div class="container " style="background-color: #9bafcc;" id="hello">
        <div class="left">

            <img src="image.png" alt="image not loading" 
            
            class="img-fluid" />
        </div>
        <div class="right">

      <div class="login-form">

                <h2>Login Your Account</h2>
                <p>Enter your email and password to access your account.</p>
                <form id="loginForm">
                <div class="form-group">
                 <label for="email" class="fw-bold">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                 </div>
                <div class="form-group">
                <label for="password" class="fw-bold">Password</label>
                 <input type="password" class="form-control" id="password" placeholder="Enter Your Password" required >
                 </div>
             <button type="button" class="btn btn-primary btn-block" onclick="loginbtn()" >Log In</button>
                    
         </form>

         
    </div>
    </div>
    </div>

    <script src="/cool/public/bootstrap/js/jquery.js"></script>

    <script>




function loginbtn() {

    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
        url: "/cool/userlogin",

        type: "POST",

        data: { 
            email: email, 
            password: password 
        },
        success: function(response) {

            if (response.trim() === "success") {

              
                window.location.href = "/cool/userhome";

            } else {

                alert("Invalid email or password");
            }
        }
    });

}


</script>


</body>
</html>