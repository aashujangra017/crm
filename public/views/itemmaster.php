<!-- <?php
require "navbar.php";


?> -->



<head>
        <link rel="stylesheet" href="/cool/public/bootstrap/css/client.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/js/bootstrap.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  



   



</head>
<body>

<!-- //left bar start form here  -->

<!-- left bar start -->
<div class="main">

<div class="left " style="background-color: #1784bb">
  

    <div class="nav flex-column mt-3" id="sidebarMenu">

         <button onclick="location.href='/cool/dashboard'"  class="nav-link text-dark " id="userMaster">
          <i class="fa-solid fa-book"></i><span class="link-text text-dark">Dash home</span>
        </button>
       
        <button onclick="location.href='/cool/userhome'"  class="nav-link text-dark " id="userMaster">
          <i class="fa-solid fa-user"></i> <span class="link-text text-dark">User Master</span>
        </button>
        <button onclick="location.href='/cool/client'"   class="nav-link text-dark " id="clientMaster">
            <i class="bi bi-person-lines-fill"></i> <span class="link-text text-dark">Client Master</span>
        </button>
        <button  onclick="location.href='/cool/home'"  class="nav-link text-dark" id="itemMaster">
            <i class="bi bi-box-seam"></i> <span class="link-text">Item Master</span>
        </button>
         <button  onclick="location.href='/cool/home'"  class="nav-link text-dark" id="itemMaster">
            <i class="fa-solid fa-file-invoice"></i> <span class="link-text">Invoice</span>
        </button>
        
        <!-- <button class="nav-link text-dark" id="logout" onclick="location.href='/cool/login'" value="logout">
           <i class="fa fa-sign-out" aria-hidden="true"></i> <span class="link-text">logout Session</span>
        </button> -->
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- right bar start -->

<div class="right  container" id="rightPanel">

<div class="container ">

<h3 class="mb-3 text-center">Welcome To Item Master Home Page</h3>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="addclient"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab">
            Add items
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="showclient"
                data-bs-toggle="tab"
                data-bs-target="#profile-tab-pane"
                type="button"
                role="tab">
            Show items
        </button>
    </li>

</ul>

<!-- Tab content -->
<div class="tab-content border border-top-0 p-3" id="myTabContent">

<!-- Add Client Tab -->
<div class="tab-pane fade "
id="home-tab-pane"
role="tabpanel">

<div class="form-container " style="background-color: #cadcecb6">

<h4>Add items</h4>

<div class="form-wrapper" id="setup">

<form  id="clientForm">
<div class="form-group">
  <label for="itemname"  class="fw-bold mt-2">Itemname</label>
  <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Enter your itemname here" required>
  <small id="itemnameerror" class="text-danger"></small>
</div>

<div class="form-group">
  <label for="price"  class="fw-bold mt-2">Price:</label>
  <input type="number" class="form-control" id="price" name="price" placeholder="Enter the price" required>
  <small id="priceerror" class="text-danger"></small>
</div>

<div class="form-group">
  <label for="description" class="fw-bold mt-2">Description:</label>
  <textarea class="form-control" id="description" name="description" placeholder="Enter item description" rows="5" required></textarea>
  <small id="descriptionerror" class="text-danger"></span>
</div>

<div class="form-group">
  <label for="image" class="fw-bold mt-2 text-black">Image:</label>
  <input type="file" class="form-control" id="image" name="image"  required>
  <small id="imageerror" class="text-danger"></small>
</div>

<button type="submit" name="submit" id="submit" class="btn btn-danger mt-3 mx-3">Submit</button>
<button type="reset" name="reset" id="reset" class="btn btn-success mt-3">Reset</button>
</form>

</div>
</div>
</div>

<!-- Show Client Tab -->
<div class="tab-pane fade show active"
id="profile-tab-pane"
role="tabpanel">

<h4 class="text-black">Show items</h4>

<div>
<div class="first border co-12"  style="background-color: #cadcecb6">


                <label for="searchname" class="fw-bold mx-3 text-black">Search Item:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <button id="serach" class="btn btn-primary">Search</button>
                

</div>

<div class="second border  col-12 d-flex justify-content-between"  style="background-color: #cadcecb6">
    <div>
        <label class="fw-bold mx-3 text-black">Limit</label>

<select id="limit" class="form-select w-auto d-inline-block">
    <option value="5" selected>5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
      <option value="25">25</option>
</select>
</div>


<div class="paging mx-3 text-black">


</div>
</div>
</div> 
<div class="third border col-12"  style="background-color: #cadcecb6">
<table class="table table-hover ">

     
<thead>
<tr class="table-dark">

<th>
ID 
<span class="sort" data-column="id" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>
Item Name
<span class="sort" data-column="itemname" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>
Price
<span class="sort" data-column="price" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>Description</th>
<th>Image</th>
<th>Delete</th>
<th>Update</th>

</tr>
</thead>


  <tbody id="bodydata"></tbody>


</table>
</div>

<div id="model">
    <div id="model-form">
        <h2>Edit Form</h2>
        <div id="close-btn">X</div>

        <div id="update-form"></div>
    </div>
</div>

</div>

</div>

</div>

</div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="/cool/public/bootstrap/js/jquery.js"></script>
<script src="/cool/js/itemapi.js"></script>


<script>
//   $(document).ready(function(){

// // $("#itemMaster").click(function(){

// // $("#rightPanel").load("/cool/public/views/itemright.php");

// // });


// //reset form 
// $("#reset").click(function(){
//     $("#clientForm")[0].reset();
// });



// //toggle side bar
// $("#toggleSidebar").click(function(){
//         $(".left").toggleClass("collapsed"); 
//         // $(".right").toggleClass("expanded");   
//     });

//   });

//   $(".nav-link").click(function(){
//         $(".nav-link").removeClass("active"); 
//         $(this).addClass("active");

// })


// //update select and update api start from her 

// $(document).on("click",".update-btn", function(){
//     $("#model").show();
// });



// $(document).on("click","#close-btn",function(){
//     $("#model").hide();
// });


//  $(document).on("click", ".update-btn", function() {
//     $("#model").show();

//     var id = $(this).data("eid");

//     $.ajax({
//         url: "/cool/itemid",
//         type: "POST",
//         data: { 
//             id: id
//         },
//         success: function(response){
//             $("#update-form").html(response);
//         } 
//     });
// });

// $(document).on('click', '#update-item', function() { 
//         var formData = new FormData();
//         var id = $('#edit-id').val();
//         var itemname = $('#edit-itemname').val();
//         var price = $('#edit-price').val();
//         var description = $('#edit-description').val();
//         var fileInput = $('#edit-image')[0].files[0];

//         formData.append('id', id);
//         formData.append('itemname', itemname);
//         formData.append('price', price);
//         formData.append('description', description);

//         if (fileInput) {
//             formData.append('image', fileInput);
//         }

//         $.ajax({
//             url: '/cool/item-update', 
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,
//           success: function(response) {
//         if (response.trim() === 'success') {
           
//             $("#model").hide(); 
//             loaditems();
//         } else {
//             $("#model").hide(); 
//             loaditems();
//         }
//     }
//         });
//     });









// //search api start form here

// $(document).on("click","#serach",function(){

//     var searchvalue = $("#searchname").val();

//     $.ajax({
//         url:"/cool/item-search",
//         type:"POST",
//         data:{
//             search:searchvalue
//         },
//         success:function(response){

//             $("#bodydata").html(response);

//         }
//     });

// });

// //delete api start form here 



// $(document).on("click", ".deletebutton", function() {
//     var itemid = $(this).data("id");
//     var element = this;


//     var isConfirmed = confirm("Are you sure you want to delete this item?");

   
//     if (isConfirmed) {
//         $.ajax({
//             url: "/cool/item-delete",
//             type: "POST",
//             data: {
//                 id: itemid
//             },
//             success: function(response) {
//                 if (response.trim() === "success") {
//                     $(element).closest("tr").fadeOut();
//                 } else {
//                     console.log(response);
//                 }
//             }
//         });
//     } else{
//         console.log("error in deleting")
//     }
// });








// //fetch item start form here



//   loaditems();

//     function loaditems() {
//         $.ajax({
//             url: "/cool/item-fetch",   
//             type: "GET",
//             success: function(data) {
//                 $("#bodydata").html(data); 
//             }
//         });
//     }





//   //insert item start form here
// $(document).on("click", "#submit", function(e) {
//     e.preventDefault();

//     var itemname    = $("#itemname").val();
//     var price       = $("#price").val();
//     var description = $("#description").val();
//     var image       = $("#image")[0].files[0];

//     if (itemname == "" || price == "" || description == "" || !image) {
//         alert("Please fill all fields and upload an image.");
//         return;
//     }


//     var formData = new FormData();
//     formData.append("itemname", itemname);
//     formData.append("price", price);
//     formData.append("description", description);
//     formData.append("image", image);
//     formData.append("submit", "1"); 

//     $.ajax({
//         url: "/cool/item-insert",
//         type: "POST",
//         data: formData,                 
//         contentType: false,              
//         processData: false,          
//         success: function(response) {
//             if (response == "success") {
//                 alert("Item added successfully!");
//                 $("#clientForm")[0].reset(); 
//             } else {
              
//             }
//         }
//     });
// });







</script>


</body>
</html>