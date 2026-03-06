<!-- <?php
require "navbar.php";


?> -->



<head>
        <link rel="stylesheet" href="/cool/public/bootstrap/css/client.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/js/bootstrap.js">
  



   



</head>
<body>

<!-- //left bar start form here  -->

<!-- left bar start -->
<div class="main">

<div class="left bg-dark-subtle">
  

    <div class="nav flex-column mt-3" id="sidebarMenu">
       <button onclick="window.location.href='/cool/home';"  class="nav-link" id="userMaster">
            <i class="bi bi-people-fill"></i> <span class="link-text">User Master</span>
        </button>
        <button onclick="window.location.href='/cool/client';" class="nav-link" id="clientMaster">
            <i class="bi bi-person-lines-fill"></i> <span class="link-text">Client Master</span>
        </button>
        <button onclick="window.location.href='/cool/item';" class="nav-link" id="itemMaster">
            <i class="bi bi-box-seam"></i> <span class="link-text">Item Master</span>
        </button>
        <button  class="nav-link" id="logout">
            <span class="link-text">logout</span>
        </button>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- right bar start -->
<div class="right " id="rightPanel">

<div class="container mt-4">

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
<div class="tab-content p-3" id="myTabContent">

<!-- Add Client Tab -->
<div class="tab-pane fade show active"
id="home-tab-pane"
role="tabpanel">

<div class="form-container bg-dark-subtle">

<h4>Add Client</h4>

<div class="form-wrapper" id="setup">

<form id="clientForm">

<div class="form-group">
  <label for="itemname" class="fw-bold">Itemname</label>
  <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Enter your itemname here" required>
</div>

<div class="form-group">
  <label for="price" class="fw-bold">Price:</label>
  <input type="number" class="form-control" id="price" name="price" placeholder="Enter the price" required>
</div>

<div class="form-group">
  <label for="description" class="fw-bold">Description:</label>
  <textarea class="form-control" id="description" name="description" placeholder="Enter item description" rows="4" required></textarea>
</div>

<div class="form-group">
  <label for="image" class="fw-bold">Image:</label>
  <input type="file" class="form-control" id="image" name="image"  required>
</div>

<button type="submit" name="submit" id="submit" class="btn btn-danger mt-3 mx-3">Submit</button>
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
<div class="first bg-body-tertiary co-12">


                <label for="searchname" class="fw-bold">Search Something:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <button class="btn btn-primary" id="search">Search</button>
                

</div>
</div>

<div class="second col-12">
<label class="fw-bold my-2 ">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
</select>
</div>
<div class="third col-12">
<table class="table table-hover">

        <thead class="col-12">
            
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
</div>

</div>

</div>

</div>

</div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="/cool/public/bootstrap/js/jquery.js"></script>

<script>
  $(document).ready(function(){

$("#clientMaster").click(function(){

$("#rightPanel").load("/cool/public/views/clientright.php");

});


//reset form 
$("#reset").click(function(){
    $("#clientForm")[0].reset();
});



//toggle side bar
$("#toggleSidebar").click(function(){
        $(".left").toggleClass("collapsed"); 
        // $(".right").toggleClass("expanded");   
    });

  });

  $(".nav-link").click(function(){
        $(".nav-link").removeClass("active"); 
        $(this).addClass("active");

})



</script>


</body>
</html>