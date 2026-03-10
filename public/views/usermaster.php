<!-- <?php
require "navbar.php";


?> -->



<head>
        <link rel="stylesheet" href="/cool/public/bootstrap/css/client.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/cool/public/bootstrap/js/bootstrap.js">
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  



   



</head>
<body>

<!-- //left bar start form here  -->

<!-- left bar start -->
<div class="main">

<div class="left  " style="background-color: #1784bb">
  

    <div class="nav flex-column mt-3 " id="sidebarMenu">
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
<div class="right  container"   id="rightPanel" >

<div class="container  ">

<h3 class="mb-3 text-center container  p-3  border rounded" style="background-color: #cadcecb6">Welcome To User Master Home Page</h3>



<ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="addclient"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab">
            Add User
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="showclient"
                data-bs-toggle="tab"
                data-bs-target="#profile-tab-pane"
                type="button"
                role="tab">
            Show User
        </button>
    </li>

</ul>

<!-- Tab content -->
<div class="tab-content border border-top-0 p-3" id="myTabContent">

<!-- Add Client Tab -->
<div class="tab-pane fade "
id="home-tab-pane"
role="tabpanel">

<div class="form-container " style="background-color: #cadcecb6" >

<h4>Add User</h4>

<div class="form-wrapper" id="setup">

<form  id="clientForm">
<div class="form-group">
        <label for="name" class="fw-bold mt-4">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here" required>
        <small id="nameerror" class="text-danger"></small>
    </div>
    <div class="form-group">
        <label for="email" class="fw-bold mt-4">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email here" required>
        <small id="emailerror" class="text-danger"></small>
    </div>
    <div class="form-group">
        <label for="phone" class="fw-bold mt-4">Phone Number:</label>
        <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
         <small id="phoneerror" class="text-danger"></small>
    </div>
    <div class="form-group">
                 <label for="status" class="fw-bold mt-4">status</label>
  <select id="status" name="status" class="form-select"  required>
    <option value="" disabled selected  >Select state

</option>
</select>
 <small id="statuserror" class="text-danger"></small>
    </div>
    <button type="submit" name="submit" id="submit" class="btn btn-primary mx-2 my-4">Submit</button>
    <button type="reset" name="reset" id="reset" class="btn btn-danger mx-2 my-4">Reset</button>

</form>

</div>
</div>
</div>

<!-- Show Client Tab -->
<div class="tab-pane fade show active"
id="profile-tab-pane"
role="tabpanel ">

<h4>Show User</h4>

<div>
<div class="first border co-12 "  style="background-color: #cadcecb6">


                <label for="searchname" class="fw-bold mx-3">Search user:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
           
                <button id="search" class="btn btn-primary">Search</button>
                

</div>

<!-- <div class="second bg-body-secondary col-12">
<label class="fw-bold mx-3">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
</select>
</div> -->

<div class="second  col-12 d-flex justify-content-between border"  style="background-color: #cadcecb6">
    <div>
        <label class="fw-bold mx-3">Limit</label>

<select id="limit" class="form-select w-auto d-inline-block">
    <option value="5" selected>5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
      <option value="25">25</option>
       <option value="30">30</option>
        <option value="35">35</option>
         <option value="40">40</option>
</select>
</div>


<div class="paging mx-3">


</div>
</div>
</div>
<div class="third col-12 border"  style="background-color: #cadcecb6">
<table class="table table-hover">

       <thead>
<tr class="table-dark">

<th>
    ID 
    <span class="sort" data-column="id" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>
    Name 
    <span class="sort" data-column="name" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>
    Email 
    <span class="sort" data-column="email" data-order="ASC" style="cursor:pointer">↕</span>
</th>

<th>Phone Number</th>
<th>Status</th>
<th>Delete</th>
<th>Update</th>

</tr>
</thead>


  <tbody id="bodydata"></tbody>


</table>
</div>

<div id="model">
    <div id="model-form">
        <h2>Edit User Master Form</h2>
      <div class="text-black" id="close-btn">X</div>

        <div id="edit-form"></div>
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

<script src="/cool/js/userapi.js"></script>

</body>
</html>