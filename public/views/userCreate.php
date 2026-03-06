



<?php
 include __DIR__ . "/navbar.php"; 
 ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/form.css">
</head>
<body>

<div class="main">
<div class="form-wrapper">
<form id="myForm">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email here" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
    </div>
    <div class="form-group">
                 <label for="status" class="fw-bold">status</label>
  <select id="status" name="status" class="form-select"  required>
    <option value="" disabled selected  >Select state

</option>
</select>
    </div>
    <button type="submit" name="submit" id="submit" class="btn btn-danger">Submit</button>
</form>
</div>
</div>

<script src="/cool/public/bootstrap/js/jquery.js"></script>
<script src="/cool/public/js/api.js"></script>

<script>

    $(document).ready(function(){
        
    //loadstatus
     function loadStatus(){
            $.ajax({
                url:"/cool/status",
                type:"POST",
                success:function (data){
                    $("#status").append(data)
                }
            })
        }

        loadStatus()

    })


</script>


</body>
</html>