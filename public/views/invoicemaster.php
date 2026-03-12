


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
            <i class="fa-solid fa-file-invoice"></i> <span class="link-text">Invoice Master</span>
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





<div class="container  ">




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
            Add Invoice 
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

 <input type="hidden" id="userid" name="id" value="">  
   
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






<div class="first-invoice text-black ">
<div class="inner-first" style="font-size: 24px">
 Add Invoice
</div>

<div>
    <button class="btn btn-primary"> Add item </button>
</div>
</div>


<!-- second div start from here -->

<div class="second-invoice bg-light">
<div class="invoice-form">
<!-- Invoice Form -->
<form>
    <!-- First Row: Client Name, Item Name, Price -->
    <div class="row">
        <div class="col-md-4 ">
            <div class="form-group mt-4">
                <label for="clientname"  class="fw-bold text-black">Client Name</label>
                <input type="text" id="clientname" class="form-control" placeholder="Enter client name" />
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group mt-4">
                <label for="invoiceemail" class="fw-bold text-black">Email</label>
                <input type="email" id="invoiceemail" class="form-control" placeholder="Enter item name" />
            </div>
        </div>
        <div class="col-md-4">
           <div class="form-group mt-4">
                <label for="invoicephone" class="fw-bold text-black">Phone</label>
                <input type="number" id="invoicephone" class="form-control" placeholder="Enter phone" />
            </div>
        </div>
    </div>

    <!-- Row for Plus and Minus Buttons -->
    <div class="row">

      <div class="col-md-4">
            <div class="form-group mt-4">
                <label for="itemname" class="fw-bold text-black">Itemname</label>
                <input type="text" id="itemname" class="form-control" placeholder="Enter item itemname" />
            </div>
        </div>
        <div class="col-md-4">
           <div class="form-group mt-4">
                <label for="invoiceprice" class="fw-bold text-black">Price</label>
                <input type="number" id="invoiceprice" class="form-control" placeholder="Enter price" />
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group mt-4">
                <label for="quantity">Quantity</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button">-</button>
                    <input type="number" id="quantity" class="form-control" value="1" min="1">
                    <button class="btn btn-outline-secondary" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>


<div class="invoice-total">
    <h1>hey buddy</h1>
    

</div>

 

</div>



<!-- third div start form here  -->



<div class="third-invoice">

<h4>Total number of Invoice</h4>

</div>


<div>


</div>

</div>












</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="/cool/public/bootstrap/js/jquery.js"></script>
<script src="/cool/js/invoice.js"></script>






</body>
</html>