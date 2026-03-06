<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>



    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/login.css">




</head>
<body>
    <div class="container start" style="background-color: #9bafcc;" id="hello">
        <div class="left">
            <img src="image.png" alt="image not loading" class="img-fluid" />
        </div>
        <div class="right">
        <div class="login-form">
                <h2>Welcome Register </h2>
                <p>Enter your email and password to access your account.</p>




            <!-- form start form here      -->


          <form id="registerform">
            <div class="form-group">
                <label for="name" class="fw-bold">Name</label>
                 <input type="text" class="form-control" id="name" placeholder="Enter Your Name " required >
         </div>
             <div class="form-group">
                 <label for="email" class="fw-bold">Email address</label>
                 <input type="email" class="form-control" id="email" placeholder="Enter Your Email" required >
      </div>
         <div class="form-group">
                  <label for="password" class="fw-bold">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Your Password" required >
         </div>
                    
          <button type="button" class="btn btn-primary btn-block" id="submit" onclick="registerbtn()">Register</button>
                    
        </form>
     </div>
    </div>

    </div>

    <script>

       

        function registerbtn() {


    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
        url: "/cool/auth",
        type: "POST",
        data: {
            name: name,
            email: email,
            password: password
        },
        success: function(response) {
            
            if (response.trim() === 'success') {
                // alert("Registration successful!");
                $("#registerform")[0].reset();
                 window.location.href="/cool/login";
            } else {
                alert("Error: " + response);
            }
        },
        
    });
}

        

        </script>


<script src="/cool/public/bootstrap/js/jquery.js"></script>

 <!-- <script src="/cool/public/js/api.js"></script>  -->
 
</body>
</html>