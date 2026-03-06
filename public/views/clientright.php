<!DOCTYPE html>
<html lang="en">
<head>

      <link rel="stylesheet" href="/cool/public/bootstrap/css/client.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/js/bootstrap.js">
    
  
</head>
<body>
  


<div class="right  container" id="rightPanel">

<div class="container ">

<h3 class="mb-3">Welcome To Client Master Home Page</h3>

<ul class="nav nav-tabs" id="myTab" role="tablist">

<li class="nav-item" role="presentation">
<button class="nav-link active"
id="addclient"
data-bs-toggle="tab"
data-bs-target="#home-tab-pane"
type="button"
role="tab">
Add Client
</button>
</li>

<li class="nav-item" role="presentation">
<button class="nav-link"
id="showclient"
data-bs-toggle="tab"
data-bs-target="#profile-tab-pane"
type="button"
role="tab">
Show Client
</button>
</li>

</ul>

<!-- Tab content -->
<div class="tab-content border border-top-0 p-3" id="myTabContent">

<!-- Add Client Tab -->
<div class="tab-pane fade show active"
id="home-tab-pane"
role="tabpanel">

<div class="form-container">

<h4>Add Client</h4>

<div class="form-wrapper" id="setup">

<form  id="clientForm">

<div class="form-group">
<label for="name" class="fw-bold">Name</label>
<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here" required>
</div>

<div class="form-group">
<label for="phone" class="fw-bold">Phone Number:</label>
<input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
</div>

<div class="form-group">
<label for="address" class="fw-bold">Address</label>
<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
</div>

<!-- <div class="form-group ">
<label for="state" class="fw-bold">State</label>
<input type="text" class="form-control" id="state" name="state" placeholder="Enter your state" required>
</div> -->

<div class="stat">
    <label for="state " class="fw-bold">State:</label>
  <select class="form-select" id="states" name="states" required>
    <option value="">Select state</option>

</select>
</div>



<div class="form-group">
<label for="city" class="fw-bold">City</label>
<input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
</div>


<div class="form-group">
<label for="pin" class="fw-bold" >Pin</label>
<input type="text" class="form-control" id="pin" name="pin" placeholder="Enter your pin" required>
</div>

<button type="button" name="submit" id="submit" class="btn btn-danger mt-3 ">Submit</button>
<button type="reset" name="reset" id="reset" class="btn btn-success mt-3">Reset</button>

</form>

</div>
</div>
</div>

<!-- Show Client Tab -->
<div class="tab-pane fade"
id="profile-tab-pane"
role="tabpanel">

<h4>Show client</h4>

<div>
<div class="first bg-body-secondary co-12">


                <label for="searchname" class="fw-bold">Name:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <button class="btn btn-primary">Search</button>
                

</div>

<div class="second bg-body-secondary col-12">
<label class="fw-bold ">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
</select>
</div>
<div class="third bg-body-secondary col-12">
<table class="table table-hover">

        <thead>
            
            <tr class="table-dark">
                <th> ID
        <span class="sort" data-column="id" data-order="ASC" style="cursor:pointer">↑</span>
 <span class="sort" data-column="id" data-order="DESC" style="cursor:pointer">↓</span>
         </th>
        <th>  Name
         <span class="sort" data-column="name" data-order="ASC" style="cursor:pointer">↑</span>
     <span class="sort" data-column="name" data-order="DESC" style="cursor:pointer">↓</span>
                </th>
        <th> Phone
         <span class="sort" data-column="email" data-order="ASC" style="cursor:pointer">↑</span>
         <span class="sort" data-column="email" data-order="DESC" style="cursor:pointer">↓</span>
        </th>
         <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>pincode</th>
                <th>delete</th>
                <th>update</th>
       </tr>
    </thead>


  <tbody id="bodydata"></tbody>


</table>
</div>

<div id="model">
    <div id="model-form">
        <h2>Edit Form</h2>
        <div id="close-btn">X</div>

        <div id="edit-form"></div>
    </div>
</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>




$(document).on("click",".update-btn", function(){
    $("#model").show();
});



$(document).on("click","#close-btn",function(){
    $("#model").hide();
});







    //delete button api start from here 
$(document).on("click", ".clientbtn", function() {
    var clientid = $(this).data("id"); 
    var element = this; 

    
    $.ajax({
        url: "/cool/delete-client", 
        type: "POST",            
        data: { 
            id: clientid 
        },     
        success: function(response) {
            if (response.trim() === "success") {
                $(element).closest("tr").fadeOut(); 
            } else {
               console.log(response) 
            }
        }
    });
});




    //reset form 
$("#reset").click(function(){
    $("#clientForm")[0].reset();
});



  loadclients();


     
    $("#showuser").click(function(e){
        e.preventDefault();
        loadclients();
    });

    function loadclients() {
        $.ajax({
            url: "/cool/fetch-client",   
            type: "GET",
            success: function(data) {
                $("#bodydata").html(data); 
            }
        });
    }





//load state in the form

function loadStates(){
    $.ajax({
        url:"/cool/states",
        type:"POST",
        success:function(data){
            $("#states").append(data);
        }
    });
}

loadStates();




    


// });
$(document).on("click","#submit",function(){

    var name    = $("#name").val();
    var phone   = $("#phone").val();
    var address = $("#address").val();
    var state   = $("#states").val();  
    var city    = $("#city").val();
    var pin     = $("#pin").val();

    if(name=="" || phone=="" || address=="" || state=="" || city=="" || pin==""){
        alert("Please fill all fields");
        return;
    }

    $.ajax({
        url: "/cool/insert-client",
        type: "POST",
        data:{
            name:name,
            phone:phone,
            address:address,
            state:state,  
            city:city,
            pin:pin
        },
        success:function(response){
            if(response=="success"){
                alert("Client Added Successfully");
                $("#clientForm")[0].reset();
            }else{
                 $("#clientForm")[0].reset();
                
            }
        }
    });
});



</script>
    
</body>
</html>