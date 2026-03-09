

// toggle side bar
$("#toggleSidebar").click(function() {
        $(".left").toggleClass("collapsed");
        
    });



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
    

//     //insert start form here 
//  $(document).on('click', '#submit', function(e) {
//         e.preventDefault(); 

//         var name = $("#name").val();
//         var email = $("#email").val();
//         var phone = $("#phone").val();
//         var status = $("#status").val();

//       if(name=="" || email=="" || phone=="" || status==""){
//         alert("Please fill all fields");
//         return;
//     }

//         $.ajax({
//             url: "/cool/insert/",
//             type: "POST",
//             data: {
//                 name: name,
//                 email: email,
//                 phone: phone,
//                 status: status
//             },
//              success:function(response){
//             if(response.trim() == "success"){
//     window.location.href = "/cool/userhome";
//                 $("#clientForm")[0].reset();
//             }else{
//                  $("#clientForm")[0].reset();
                
//             }
//         }
//         });
//     });


$(document).on('click', '#submit', function(e) {
    e.preventDefault();

    var name = $("#name").val().trim();
    var email = $("#email").val().trim();
    var phone = $("#phone").val().trim();
    var status = $("#status").val();

    var valid = true;


    $(".text-danger").text("");

   
    if (name == "") {
        $("#nameerror").text("Name is required");
        valid = false;
    }


    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email == "") {
        $("#emailerror").text("email is required");
        valid = false;
    } else if (!emailPattern.test(email)) {
        $("#emailerror").text("Please enter a valid email like abc@gmail.com");
        valid = false;
    }

    var phonePattern = /^[0-9]{10}$/;
    if (phone == "") {
        $("#phoneerror").text("Phone number is required");
        valid = false;
    } else if (!phonePattern.test(phone)) {
        $("#phoneerror").text("Phone number have  10 digits");
        valid = false;
    }


    if (status == "" || status == null) {
        $("#statuserror").text("Please select status");
        valid = false;
    }

  
    if (!valid) {
        return;
    }

  
    $.ajax({
        url: "/cool/insert/",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            status: status
        },
        success: function(response) {
            if (response.trim() == "success") {
                window.location.href = "/cool/userhome";
                $("#clientForm")[0].reset();
            } else {
                alert("Insert failed");
            }
        },
        error: function() {
            alert("Server error");
        }
    });
});


    
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



//update start form here for select and update api



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

//     $(document).on("click","#update-user",function(){

//      var id = $("#edit-id").val();
//      var name = $("#edit-name").val();
//      var email = $("#edit-email").val();
//      var phone = $("#edit-phone").val();
//      var status = $("#edit-status").val();

//      var isValid = true;

// $(".text-danger").text(""); 
// on
// if(name === ""){
//     $("#name-error").text("Name is required");
//     isValid = false;
// }


// var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
// if(email === ""){
//     $("#email-error").text("Email is required");
//     isValid = false;
// }else if(!emailPattern.test(email)){
//     $("#email-error").text("Invalid email format");
//     isValid = false;
// }


// var phonePattern = /^[0-9]{10}$/;
// if(phone === ""){
//     $("#phone-error").text("Phone is required");
//     isValid = false;
// }else if(!phonePattern.test(phone)){
//     $("#phone-error").text("Phone must be 10 digits");
//     isValid = false;
// }

// // Status validation
// if(status === ""){
//     $("#status-error").text("Status is required");
//     isValid = false;
// }

// if(!isValid){
//     return;
// }



//      $.ajax({
//         url:"/cool/update",
//         type:"POST",
//         data:{
//             id:id,
//             name:name,
//             email:email,
//             phone:phone,
//             status:status
//         },
//         success:function(response){
//             if(response.trim() ==='success'){
//                 $("#model").hide();
//                 loadUsers();
//             }else{
//                 console.log(response)
//             }
//         }
//      })


//     })

$(document).on("click","#update-user",function(){

$(".text-danger").text(""); // clear old errors

var name = $("#edit-name").val().trim();
var email = $("#edit-email").val().trim();
var phone = $("#edit-phone").val().trim();
var status = $("#edit-status").val().trim();
var id = $("#edit-id").val();

var valid = true;

if(name == ""){
    $("#name-error").text("Name is required");
    valid = false;
}

if(email == ""){
    $("#email-error").text("Email is required");
    valid = false;
}

if(phone == ""){
    $("#phone-error").text("Phone is required");
    valid = false;
}

if(status == ""){
    $("#status-error").text("Status is required");
    valid = false;
}

if(!valid){
return;
}

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

        if(response.trim() === "success"){
            $("#model").hide();
            loadUsers();
        }else{
            console.log(response);
        }

    }
});

});




    //loads user

    
//     function loadUsers() {
//         $.ajax({
//             url: "/cool/fetch-users",   
//             type: "GET",
//             success: function(data) {
//                 $("#bodydata").html(data); 
//             }
//         });
//     }
//   loadUsers();


  //limit users
    
 // limit api start from here

    // $("#limit").change(function() {
    //     var limit = $(this).val(); 
    //     loadData(limit); 
    // });

    // function loadData(limit) {
    //     $.ajax({
    //         url: "/cool/limit",
    //         type: "POST",
    //         data: {
    //             limit: limit
    //         },
    //         success: function(data) {
    //             $("#bodydata").html(data); 
    //         }
    //     });
    // }
    //     loadData(5);




        


        
    // search api start form here 
    
$(document).on("click", "#search", function() {

 var searchvalue = $("#searchname").val();

    $.ajax({
        url:"/cool/user-search",
        type:"POST",
        data:{
            search:searchvalue
        },
        success:function(response){

            $("#bodydata").html(response);

        }
    });
 })



 //pagination start from here 

let page = 1;
let limit = 5;

function loadUsers(){
    limit = $("#limit").val() || 5;

    $.ajax({
        url: "/cool/user-pagination",
        type: "POST",
        data: {
            page: page,
            limit: limit
        },
        success: function(response){
            let data = typeof response === "string" ? JSON.parse(response) : response;

            $("#bodydata").html(data.table);

            let pagination = "";
            pagination += `<button class='btn btn-secondary mx-1' id='prev' ${data.page <= 1 ? 'disabled' : ''}>Prev</button>`;
            pagination += `<span class='mx-2 fw-bold'> Page ${data.page} of ${data.totalPages} </span>`;
            pagination += `<button class='btn btn-secondary mx-1' id='next' ${data.page >= data.totalPages ? 'disabled' : ''}>Next</button>`;

            $(".paging").html(pagination);
        }
    });
}

loadUsers();

$(document).on("click","#prev",function(){

if(page > 1){
page--;
loadUsers();
}

});

$(document).on("click","#next",function(){


page++;

loadUsers();

});

$("#limit").change(function(){

page = 1;
loadUsers();

});


//order user api start from here 

$(document).on("click", ".sort", function(){

    var column = $(this).data("column");
    var order = $(this).data("order");

    $.ajax({
        url: "/cool/user-order",
        type: "POST",
        data: {
            column: column,
            order: order
        },
        success: function(response){
            $("#bodydata").html(response);
        }
    });

  
    if(order === "ASC"){
        $(this).data("order","DESC");
    }else{
        $(this).data("order","ASC");
    }

});
