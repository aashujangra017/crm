

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

<div class="left " style="background-color:  #1784bb">
  

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
        <button  onclick="location.href='/cool/invoice'"  class="nav-link text-dark" id="itemMaster">
            <i class="fa-solid fa-file-invoice"></i> <span class="link-text">Invoice Master</span>
        </button>
       
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- right side bar  start from here    -->
<div class="right container " id="rightPanel">
  <div class="row border rounded h-25 px-3">
    <div class="col-12 bg-primary d-flex justify-content-center align-items-center container-fluid" style="background: linear-gradient(90deg, #0C7BB3 0%, #F2BAE8 100%) "> 
      <h1>Welcome to Dashboard Page </h1>
    </div>
  </div>

  <div class="row my-5 g-4 ">
  
<div class="col-md-3">
  <div class="border rounded p-4 text-center bg-success-subtle">
    <h2>User Master</h2>
    <p class="fs-1 fw-bold mb-0" id="userCount">
      <span class="spinner-border spinner-border-sm"></span>
    </p>
    <small class="text-muted">Total Users</small>
  </div>
</div>

  <div class="col-md-3">
    <div class="border rounded p-4 text-center bg-success-subtle">
    <h2>Client Master</h2>
    <p class="fs-1 fw-bold mb-0" id="clientCount">
      <span class="spinner-border spinner-border-sm"></span>
    </p>
    <small class="text-muted">Total Clients</small>
  </div>
  </div>

  <div class="col-md-3">
     <div class="border rounded p-4 text-center bg-success-subtle">
    <h2>Items Master</h2>
    <p class="fs-1 fw-bold mb-0" id="itemsCount">
      <span class="spinner-border spinner-border-sm"></span>
    </p>
    <small class="text-muted">Total Items</small>
  </div>
  </div>
   <div class="col-md-3">
    <div class="border rounded p-4 text-center bg-success-subtle">
    <h2>Invoices Master</h2>
    <p class="fs-1 fw-bold mb-0" id="invoicesCount">
      <span class="spinner-border spinner-border-sm"></span>
    </p>
    <small class="text-muted">Total Invoices</small>
  </div>
  </div>

</div>

</div>


    
       




</div>


</div>



<script src="/cool/public/bootstrap/js/jquery.js"></script>
<script src="/cool/js/clientapi.js"></script>



<script>

  $(document).ready(function() {
   
    $.ajax({
    url: '/cool/totalusermaster',
    method: 'GET',
    data: {
       action: 'usercount'
       },
    dataType: 'json',
    success: function(response) {
        $('#userCount').text(response.total); 
    },
    error: function(err) {
        console.error('Error fetching user count:', err);
        $('#userCount').text('Error');
    }
});





// client master api

$.ajax({
    url: '/cool/totalclientmaster',
    method: 'GET',
    data: {
       action: 'usercount'
       },
    dataType: 'json',
    success: function(response) {
        $('#clientCount').text(response.total); 
    }
});
});



$.ajax({
    url: '/cool/totalitemsmaster',
    method: 'GET',
    data: {
       action: 'usercount'
       },
    dataType: 'json',
    success: function(response) {
        $('#itemsCount').text(response.total); 
    }
});




$.ajax({
    url: '/cool/totalinvoicesmaster',
    method: 'GET',
    data: {
       action: 'usercount'
       },
    dataType: 'json',
    success: function(response) {
        $('#invoicesCount').text(response.total); 
    }
});



</script>



</body>
</html>