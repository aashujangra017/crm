<!DOCTYPE html>

<head>
   
    <link rel="stylesheet" href="public/bootstrap/css/dashboard.css"  >

    <link rel="stylesheet" href="public/bootstrap/js/bootstrap.js">
</head>
<body>

<div class="main">

<!-- left side bar start form here  -->
<div class="left col-2 " style="background-color:#fffff">
   

    <!-- <ul class="menu">
        <li><a href="#" onclick="window.location.href='/cool/home'">User Master</a></li>
        <li><a href="#" >Client Master</a></li>
        <li><a href="#">Item Master</a></li>
        <li><a href="#"  style="background-color: #FF2E2E">Logout</a></li>
    </ul>
</div> -->

 <div class="nav flex-column mt-3" id="sidebarMenu">
      <button onclick="location.href='/cool/homes'"  class="nav-link" id="userMaster">
            <i class="bi bi-people-fill"></i> <span class="link-text">User Master</span>
        </button>
        <button onclick="location.href='/cool/client'" class="nav-link" id="clientMaster">
            <i class="bi bi-person-lines-fill"></i> <span class="link-text">Client Master</span>
        </button>
        <button onclick="location.href='/cool/home'" class="nav-link" id="itemMaster">
            <i class="bi bi-box-seam"></i> <span class="link-text">Item Master</span>
        </button>
        <!-- <button class="nav-link" id="logout">
            <span class="link-text">logout</span>
        </button> -->
    </div>
</div>




<!-- right side bar start form here -->

<div class="right bg-light col-10">
    <div class="first bg-dark-subtle" >
   <button class="btn btn-primary" onclick="window.location.href='/cool/'">Add client</button>
   <button class="btn btn-success" id="showuser" >Show Client</button>
</div>
<div class="second form-group bg-dark-subtle">

                <label for="searchname" class="fw-bold">Name:</label>
                <input class="form-control"  type="text" name="name" id="searchname" placeholder="Search for name" />
                <label for="searchemail " class="fw-bold">Email:</label>
                <input class="form-control"  type="text" name="email" id="searchemail" placeholder="Search for email" />
                <label for="searchphone" class="fw-bold">phone:</label>
                <input class="form-control"  type="number" name="phone" id="searchphone" placeholder="Search for phone" />
                  <label for="searchstatus" class="fw-bold">Status:</label>
                <input class="form-control"  type="text" name="phone" id="searchstatus" placeholder="Search status" />
                <!-- <label for="status" class="fw-bold">status</label>
  <select id="status" name="status" class="form-select"  required>
    <option value="" disabled selected  >Select state

</option>
</select> -->
                
                <button class="btn btn-danger" id="search">Search</button>
    
</div>
<div class="third bg-dark-subtle">
    <div class="third-limit">
                   
<label class="fw-bold ">Limit</label>
<select id="limit" class="form-select w-auto d-inline-block">
    <option value="" disabled selected>Select Limit</option>
    <option value="5">5</option>
    <option value="10">10</option>
      <option value="15">15</option>
</select>
</div>
<div class="third-list">
    <ul class="pagination">
        <li>prev</li>
        <li class="active">1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>next</li>
    </ul>
</div>

</div>



<!-- fourth div start from here
 
-->
<div class="fourth bg-dark-subtle">
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
        <th> Email
         <span class="sort" data-column="email" data-order="ASC" style="cursor:pointer">↑</span>
         <span class="sort" data-column="email" data-order="DESC" style="cursor:pointer">↓</span>
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
   <!-- <div id="model">
            <div id="model-form">
             <h1>Edit Form</h1>
            <table cellpadding="10px" width="100%">
                   


</table>

<div id="close-btn">
    X
</div> -->

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

<script src="/cool/public/bootstrap/js/jquery.js"></script>




<script>

$(document).ready(function(){

// toggle side bar
$("#toggleSidebar").click(function() {
        $(".left").toggleClass("collapsed");
        
    });

//select and update start form here 

 $(document).on("click", ".edit-btn", function() {
    $("#model").show();

    var id = $(this).data("eid");

    $.ajax({
        url: "/cool/selectid",
        type: "POST",
        data: { 
            id: id
        },
        success: function(response){
            $("#edit-form").html(response);
        } 
    });
});



$("#close-btn").on("click",function(){
        $("#model").hide();
    })

    $(document).on("click","#update-user",function(){

     var id = $("#edit-id").val();
     var name = $("#edit-name").val();
     var email = $("#edit-email").val();
     var phone = $("#edit-phone").val();
     var status = $("#edit-status").val();


     $.ajax({
        url:"/cool/update",
        type:"POST",
        data:{
            id:id,
            name:name,
            email:email,
            phone:phone,
            status:status
        },
        success:function(response){
            if(response.trim() ==='success'){
                $("#model").hide();
                loadUsers();
            }else{
                console.log(response)
            }
        }
     })


    })


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







  // fetch all user api start 

    loadUsers();


     
    $("#showuser").click(function(e){
        e.preventDefault();
        loadUsers();
    });
     



    function loadUsers() {
        $.ajax({
            url: "/cool/fetch-users",   
            type: "GET",
            success: function(data) {
                $("#bodydata").html(data); 
            }
        });
    }

                                                                
    
 // limit api start from here

    $("#limit").change(function() {
        var limit = $(this).val(); 
        loadData(limit); 
    });

    function loadData(limit) {
        $.ajax({
            url: "/cool/limit",
            type: "POST",
            data: {
                limit: limit
            },
            success: function(data) {
                $("#bodydata").html(data); 
            }
        });
    }
        loadData(5);

 


    // search api start form here 
    
    $("#search").click(function() {
        
        var searchname = $("#searchname").val();  
        var searchemail = $("#searchemail").val();  
        var searchphone = $("#searchphone").val();  
        var searchstatus = $("#searchstatus").val();  
        
            $.ajax({
                url: "/cool/search-users",  
                type: "POST", 
                data: {
                   
              
                    searchname: searchname,
                    searchemail:searchemail,
                    searchphone:searchphone,
                    searchstatus:searchstatus,
                     
                    
                },
                success: function(response) {
                    if (response) {
                        $("#bodydata").html(response);  
                    } else {
                        console.log(response)
                        
                       
                    }
                   
                     $("#searchname").val('');
                    $("#searchemail").val('');
                     $("#searchphone").val('');
                     $("#searchstatus").val('');
                },
                
            });
        } 
      
        );




    //delete button api start from here 
$(document).on("click", ".deletebutton", function() {
    var userid = $(this).data("id");
    var element = this;
    var isdelete = confirm("Are you sure you want to delete this user?");

    if (isdelete) {
        $.ajax({
            url: "/cool/delete",
            type: "POST",
            data: {
                id: userid
            },
            success: function(response) {
                if (response.trim() === "success") {
                    $(element).closest("tr").fadeOut();
                } else {
                    console.log(response);
                }
            }
        });
    }
});

//sort asc desc api start form here


function sortData(column, order) {
    $.ajax({
        url: "/cool/order",
        type: "POST",
        data: { 
          column,
           order
         },
        success: function (response) {
            $("#bodydata").html(response);
        }
    });
}


//order by asc and desc start form here

$(document).ready(function () {

    sortData("id", "ASC");

    $(document).on("click", ".sort", function () {

        let column = $(this).data("column");
        let order = $(this).data("order");

    

        sortData(column, order);
    });

});

$("document").on("click",".edit-btn", function(){
    $("model").show();
})



       


    

 });



</script>


<script src="/cool/public/js/api.js"></script>



    
</body>
</html>