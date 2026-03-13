  $(document).ready(function(){

$("#clientMaster").click(function(){



});


//reset form 
$("#reset").click(function(){
    $("#clientForm")[0].reset();
});



//toggle side bar
$("#toggleSidebar").click(function(){
        $(".left").toggleClass("collapsed"); 
        $(".right").toggleClass("expanded");   
    });

  });

  $(".nav-link").click(function(){
        $(".nav-link").removeClass("active"); 
        $(this).addClass("active");

})

   //logout api start form here 
    
$('#logout').on('click', function() {
    $.ajax({
        url: '/cool/logout',      
        type: 'POST',            
        success: function(response) {
            if(response.trim() === "logout") { 
               
                window.location.href = '/cool/login'; 
            } else {
                alert("Something went wrong: " + response); 
            }
        }
    });
});
    





//search start form here
// Search client

// $(document).on("click","#serach",function(){

//     var searchvalue = $("#searchname").val();

//     $.ajax({
//         url:"/cool/search-client",
//         type:"POST",
//         data:{
//             search:searchvalue
//         },
//         success:function(response){

//             $("#bodydata").html(response);

//         }
//     });

// });







//update start from here 








 $(document).on("click", ".update-btn", function() {
    

    var id = $(this).data("eid");

    $("#addclient").tab("show");

    $.ajax({
    url: '/cool/clientid',
    type: 'POST',
    data: {
         id: id
         },
    dataType: 'json',
    success: function(data) {
     
            $("#name").val(data.name);
            $("#email").val(data.email);
            $("#phone").val(data.phone);
            $("#address").val(data.address);
            $("#state").val(data.state);     
            $("#city").val(data.city);      
            $("#pincode").val(data.pincode);  
        
    }
});
});


$(document).on("click", "#update-client", function() {
   
    var id = $("#edit-id").val();
    var name = $("#edit-name").val();
    var phone = $("#edit-phone").val();
    var address = $("#edit-address").val();
    var state = $("#edit-state").val();
    var city = $("#edit-city").val();
    var pincode = $("#edit-pin").val();

    // Validate required fields
    if (!name || !phone || !address || !state || !city || !pincode) {
        alert("Please fill in all fields.");
        return;
    }

   
    $.ajax({
        url: '/cool/update-client',  
        type: 'POST',
        data: {
            id: id,              
            name: name,         
            phone: phone,       
            address: address,    
            state: state,        
            city: city,          
            pincode: pincode   
        },
        success: function(response) {
          
            if (response.trim() === 'success') {
                alert("Client updated successfully!");  
                $("#model").hide(); 
                 loadclients();
            } else {
                $("#model").hide(); 
                loadclients();
               
            }
        }
    });
});







    //delete button api start from here 


$(document).on("click", ".clientbtn", function() {
    var clientid = $(this).data("id");
    var element = this;


    var isConfirmed = confirm("Are you sure you want to delete this client?");

   
    if (isConfirmed) {
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
                    console.log(response);
                }
            }
        });
    } else{
        console.log("error in deleting")
    }
});













    



// load states 

function loadStates() {
    $.ajax({
        url: "/cool/states",
        type: "POST",
        success: function(data) {
            $("#states").append(data);
        }
    });
}

loadStates();

$(document).on("change", "#states", function() {
    var state_id = $(this).val();
    

    $("#city").html('<option value="">Select city</option>');

    if (state_id == "" || state_id == null) return;

    $.ajax({
        url: "/cool/cities",
        type: "POST",
        data: { 
            state_id: state_id
         },
        success: function(data) {
            
            
            $("#city").append(data);
        }
        
    });
});

// Insert client form
$(document).on("click", "#submit", function() {

    var name = $("#name").val();
    var phone = $("#phone").val();
    var address = $("#address").val();
    var state = $("#states").val();
    var city = $("#city").val();
    var pin = $("#pin").val();

    var valid = true;

    $(".text-danger").text("");

    if (name == "") {
        $("#nameerror").text("Name is required");
        valid = false;
    }

    var phonePattern = /^[0-9]{10}$/;
    if (phone == "") {
        $("#phoneerror").text("Phone is required");
        valid = false;
    } else if (!phonePattern.test(phone)) {
        $("#phoneerror").text("Phone number must have 10 digits");
        valid = false;
    }

    if (address == "") {
        $("#addresserror").text("Address is required");
        valid = false;
    }

    if (state == "") {
        $("#stateerror").text("State is required");
        valid = false;
    }

    if (city == "") {
        $("#cityerror").text("City is required");
        valid = false;
    }

    var pinvalid = /^[1-9][0-9]{5}$/;
    if (pin == "") {
        $("#pinerror").text("PIN is required");
        valid = false;
    } else if (!pinvalid.test(pin)) {
        $("#pinerror").text("PIN must be 6 digits");
        valid = false;
    }

    if (!valid) {
        return;
    }

    $.ajax({
        url: "/cool/insert-client",
        type: "POST",
        data: {
            name: name,
            phone: phone,
            address: address,
            state: state,
            city: city,
            pin: pin
        },
        success: function(response) {
            if (response.trim() == "success") {
                window.location.href = "/cool/client";
            }
        }
    });
});


// //pagination and limit start from here 

// let page = 1;
// let limit = 5;

// function loadclients() {
//     limit = $("#limit").val() || 5;

//     $.ajax({
//         url: "/cool/client-pagination", 
//         type: "POST",
//         data: {
//             page: page,
//             limit: limit
//         },
//         success: function(response) {
//             let data = typeof response === "string" ? JSON.parse(response) : response;
//             $("#bodydata").html(data.table);

//             let pagination = "";
//             pagination += `<button class='btn btn-secondary mx-1' id='prev' ${data.page <= 1 ? 'disabled' : ''}>Prev</button>`;
//             pagination += `<span class='mx-2 fw-bold'> Page ${data.page} of ${data.totalPages} </span>`;
//             pagination += `<button class='btn btn-secondary mx-1' id='next' ${data.page >= data.totalPages ? 'disabled' : ''}>Next</button>`;

//             $(".paging").html(pagination);
//         },
//         error: function(err) {
//             console.error("Error loading clients:", err);
//         }
//     });
// }

// loadclients();

// $(document).on("click", "#prev", function() {
//     if (page > 1) {
//         page--;
//         loadclients();
//     }
// });

// $(document).on("click", "#next", function() {
//     page++;
//     loadclients();
// });

// $("#limit").change(function() {
//     page = 1;
//     loadclients();
// });





// // order by asc and desc api call 
// $(document).on("click", ".sort", function(){

//     var column = $(this).data("column");
//     var order = $(this).data("order");

//     $.ajax({
//         url: "/cool/client-order",
//         type: "POST",
//         data: {
//             column: column,
//             order: order
//         },
//         success: function(response){
//             $("#bodydata").html(response);
//         }
//     });

  
//     if(order === "ASC"){
//         $(this).data("order","DESC");
//     }else{
//         $(this).data("order","ASC");
//     }

// });










let page = 1;
let limit = 5; 
let search = ''; 
let orderCol = 'c.id';
let orderDir = 'ASC';

function loadClients() {
    limit = $("#limit").val() || 5; 
    search = $("#searchname").val().trim();

    $.ajax({
        url: "/cool/client-pagination",
        type: "POST",
        data: {
            page,
            limit,
            search,
            orderCol,
            orderDir
        },
        success: function(response) {
            let data = typeof response === "string" ? JSON.parse(response) : response;

            $("#bodydata").html(data.table);

            let pagination = "";
            pagination += `<button class='btn btn-secondary mx-1' id='prev' ${data.page <= 1 ? 'disabled' : ''}>Prev</button>`;
            pagination += `<span class='mx-2 fw-bold'>Page ${data.page} of ${data.totalPages}</span>`;
            pagination += `<button class='btn btn-secondary mx-1' id='next' ${data.page >= data.totalPages ? 'disabled' : ''}>Next</button>`;
            $(".paging").html(pagination); 

            
       
        }
    });
}


loadClients();


$(document).on("click", "#prev", function() {
    if (page > 1) {
        page--;
        loadClients();
    }
});


$(document).on("click", "#next", function() {
    page++;
    loadClients();
});


$("#limit").on("change", function() {
    page = 1;
    loadClients();
});


$(document).on("click", "#search", function() { 
    page = 1;
    loadClients();
});


$(document).on("click", ".sort", function() {
    let col = $(this).data("column");
    let fullCol = "c." + col;

 
    if (orderCol === fullCol) {
        orderDir = orderDir === 'ASC' ? 'DESC' : 'ASC';
    } else {
        orderCol = fullCol;
        orderDir = 'ASC';
    }
    page = 1; 
    loadClients();
});