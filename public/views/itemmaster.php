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
         <button  onclick="location.href='/cool/invoice'"  class="nav-link text-dark" id="itemMaster">
            <i class="fa-solid fa-file-invoice"></i> <span class="link-text">Invoice</span>
        </button>
        
   
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- right bar start -->

<div class="right  container" id="rightPanel">

<div class="container ">

<h3 class="mb-3 text-center container p-3  border rounded" style="background-color: #cadcecb6">Welcome To Item Master Home Page</h3>

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

<form id="clientForm">
    <input type="hidden" id="userid" name="id" value="">

    <div class="form-group">
        <label for="itemname" class="fw-bold mt-2">Itemname</label>
        <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Enter your itemname here">
        <small id="itemnameerror" class="text-danger"></small>
    </div>

    <div class="form-group">
        <label for="price" class="fw-bold mt-2">Price:</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter the price">
        <small id="priceerror" class="text-danger"></small>
    </div>

    <div class="form-group">
        <label for="description" class="fw-bold mt-2">Description:</label>
        <textarea class="form-control" id="description" name="description" placeholder="Enter item description" rows="5"></textarea>
       
        <small id="descriptionerror" class="text-danger"></small>
    </div>

    <div class="form-group">
        <label for="image" class="fw-bold mt-2 text-black">Image:</label>
      
        <input type="file" class="form-control" id="image" name="image">
        <small id="imageerror" class="text-danger"></small>

        <input type="hidden" id="existing-image" name="existing_image" value="">
        <div id="current-image-container" style="display:none;" class="mt-2">
            <p class="fw-bold mb-1">Current Image:</p>
            <img id="current-image-preview" src="" style="max-width:130px; max-height:130px; border-radius:5px; border:1px solid #ddd; padding:3px;">
        </div>
    </div>

    <button type="button" name="submit" id="submit" class="btn btn-primary mt-3 mx-3">Submit</button>
    <!-- type="button" on reset to prevent default form reset before our handler -->
    <button type="button" name="reset" id="reset" class="btn btn-danger mt-3">Reset</button>
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
<div class="first  border co-12"  style="background-color: #cadcecb6">


                <label for="searchname" class="fw-bold mx-3 text-black">Search Item:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <button id="search" class="btn btn-primary">Search</button>
                

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
<div class="third  border col-12"  style="background-color: #cadcecb6">
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



</div>

</div>

</div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="/cool/public/bootstrap/js/jquery.js"></script>
<script src="/cool/js/itemapi.js"></script>






</body>
</html>