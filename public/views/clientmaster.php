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
             <i class="fa-solid fa-user"></i>  <span class="link-text text-dark">User Master</span>
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
<div class="right  container"  id="rightPanel">

<div class="container ">

<h3 class="mb-3 text-center container p-3  border rounded"  style="background-color: #cadcecb6">Welcome To Client Master Home Page</h3>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="addclient"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab">
            Add Client
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
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
<div class="tab-pane fade "
id="home-tab-pane"
role="tabpanel">

<div class="form-container" style="background-color: #cadcecb6">

<h4>Add Client</h4>

<div class="form-wrapper" id="setup">

<form  id="clientForm">

<div class="form-group">
<label for="name" class="fw-bold mt-2">Name</label>
<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here" required>
<small id="nameerror" class="text-danger"></small>
</div>

<div class="form-group">
<label for="phone" class="fw-bold mt-2">Phone Number:</label>
<input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
<small id="phoneerror" class="text-danger"></small>
</div>

<div class="form-group">
<label for="address" class="fw-bold mt-2">Address</label>
<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
<small id="addresserror" class="text-danger"></small>
</div>

<!-- <div class="form-group ">
<label for="state" class="fw-bold">State</label>
<input type="text" class="form-control" id="state" name="state" placeholder="Enter your state" required>
</div> -->

<!-- <div class="stat">
    <label for="state " class="fw-bold mt-2">State:</label>
  <select class="form-select" id="states" name="states" required>
    <select class="form-select" id="state" name="state">
    <option value="">Select state</option>

</select>
</div> -->
<div class="stat">
    <label for="states" class="fw-bold mt-2">State:</label>
    <select class="form-select" id="states" name="states" required>
        <option value="">Select state</option>
        <small id="stateerror" class="text-danger"></small>
        
    </select>
</div>



<div class="form-group">
<label for="city" class="fw-bold mt-2">City</label>
<input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
<small id="cityerror" class="text-danger"></small>
</div>


<div class="form-group">
<label for="pin" class="fw-bold mt-2" >Pin</label>
<input type="text" class="form-control" id="pin" name="pin" placeholder="Enter your pin" required>
<small id="pinerror" class="text-danger"></small>
</div>

<button type="button" name="submit" id="submit" class="btn btn-danger mt-3 mx-2 ">Submit</button>
<button type="reset" name="reset" id="reset" class="btn btn-success mt-3">Reset</button>

</form>

</div>
</div>
</div>

<!-- Show Client Tab -->
<div class="tab-pane fade show active"
id="profile-tab-pane"
role="tabpanel">

<h4>Show client</h4>

<div>
<div class="first border  co-12"  style="background-color: #cadcecb6">


                <label for="searchname" class="fw-bold mx-3">Search Client:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <button id="serach" class="btn btn-primary">Search</button>
                

</div>

<div class="second border col-12 d-flex justify-content-between"  style="background-color: #cadcecb6" >
    <div>
        <label class="fw-bold mx-3">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
      <option value="25">25</option>
       <option value="30">30</option>
        <option value="35">35</option>
         <option value="40">40</option>
</select>
</div>
<!-- <label class="fw-bold ">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
</select> -->

<div class="paging mx-5">
   
</div>
</div>
<div class="third border col-12"  style="background-color: #cadcecb6">
<table class="table table-hover">

        <thead>
            
            <tr class="table-dark">
                <th> ID
        <span class="sort" data-column="id" data-order="ASC" style="cursor:pointer">↕</span>
 
         </th>
        <th>  Name
         <span class="sort" data-column="name" data-order="ASC" style="cursor:pointer">↕</span>
     
                </th>
        <th> Phone
          <span class="sort" data-column="email" data-order="ASC" style="cursor:pointer">↕</span>
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

<div id="model" >
    <div id="model-form" >
        <h2 class="text-black">Edit Client Master Form</h2>
        <div class="text-black" id="close-btn">X</div>

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
<script src="/cool/js/clientapi.js"></script>


</body>
</html>