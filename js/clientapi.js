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

$(document).on("click","#serach",function(){

    var searchvalue = $("#searchname").val();

    $.ajax({
        url:"/cool/search-client",
        type:"POST",
        data:{
            search:searchvalue
        },
        success:function(response){

            $("#bodydata").html(response);

        }
    });

});







//update start from here 

$(document).on("click",".update-btn", function(){
    $("#model").show();
});



$(document).on("click","#close-btn",function(){
    $("#model").hide();
});


 $(document).on("click", ".update-btn", function() {
    $("#model").show();

    var id = $(this).data("eid");

    $.ajax({
        url: "/cool/clientid",
        type: "POST",
        data: { 
            id: id
        },
        success: function(response){
            $("#update-form").html(response);
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






    //reset form 
// $("#reset").click(function(){
//     $("#clientForm")[0].reset();
// });



  loadclients();


     
    $("#showuser").click(function(e){
        e.preventDefault();
        loadclients();
    });

    function loadclients() {
        $.ajax({
            url: "/cool/fetch-client",   
            type: "GET",
            success: function(data) {
                $("#bodydata").html(data); 
            }
        });
    }





//load state in the form

function loadStates(){
    $.ajax({
        url:"/cool/states",
        type:"POST",
        success:function(data){
            $("#states").append(data);
        }
    });
}

loadStates();




    


// insert start form here 
$(document).on("click","#submit",function(){

    var name    = $("#name").val();
    var phone   = $("#phone").val();
    var address = $("#address").val();
    var state   = $("#states").val();  
    var city    = $("#city").val();
    var pin     = $("#pin").val();

    if(name=="" || phone=="" || address=="" || state=="" || city=="" || pin==""){
        alert("Please fill all fields");
        return;
    }

    $.ajax({
        url: "/cool/insert-client",
        type: "POST",
        data:{
            name:name,
            phone:phone,
            address:address,
            state:state,  
            city:city,
            pin:pin
        },
       success: function(response) {
    console.log(response); 
    if (response == "success") {
      window.location.href= "/cool/client";
        
    } else {
      
    }
}
    });
});






