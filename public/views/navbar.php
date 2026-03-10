<head>
   

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css">
     
    <link rel="stylesheet" href="public/bootstrap/css/dashboard.css"  >

</head>
<body>
    <div>
<nav class="navbar navbar-expand-sm  " style="background-color: #1784bb">
    <div class="container-fluid d-flex align-items-center">

       
        <button class="btn btn-light me-3" id="toggleSidebar">☰</button>

      
      <a href="/cool/dashboard" class="navbar-brand">
    <img src="https://sansoftwares.com/wp-content/uploads/2025/12/sansoftwares-1-5.webp"
         alt="Logo image is not load"
         style="width: 200px; height: 40px;">
</a>

      
        <button class="btn btn-danger ms-auto" type="button" id="logout" onclick="logout()" value="logout">
            Logout
        </button>

    </div>
</nav>
</div>
</div>


</body>

    <script src="/cool/public/bootstrap/js/jquery.js"></script>


    <script>


$('#logout').on('click', function() {
    $.ajax({
        url: '/cool/logout',      
        type: 'POST',            
        success: function(response) {
            if(response.trim() === "logout") { 
               
                window.location.href = '/cool/login'; 
            } else {
                alert("Something went wrong: " + response); 
            }
        }
    });
});




       


</script>
    
    


</html>