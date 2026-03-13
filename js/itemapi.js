 $(document).ready(function(){


//reset form 
$("#reset").click(function(){
    $("#clientForm")[0].reset();
});


$("#reset-user").click(function(){
    $("#clientForm")[0].reset();
});


//toggle side bar
$("#toggleSidebar").click(function(){
        $(".left").toggleClass("collapsed"); 
        
    });

  });

  $(".nav-link").click(function(){
        $(".nav-link").removeClass("active"); 
        $(this).addClass("active");

})


//update select and update api start from her 




 $(document).on("click", ".update-btn", function() {
   

    var id = $(this).data("eid");

     $("#addclient").tab("show");

    $.ajax({
        url: "/cool/itemid",
        type: "POST",
        data: { 
            id: id
        },
        dataType: "json",
       success: function(response){
    $("#userid").val(response.id);
    $("#itemname").val(response.itemname);
    $("#price").val(response.price);
    $("#description").val(response.description);
     if (response.image) {
        $("#current-image-preview").attr("src", "uploads/" + response.image);
        $("#current-image-container").show();
        $("#existing-image").val(response.image);
    }
}
    });
});


//uopdate and insert
$(document).on("click", "#submit", function(e) {
    e.preventDefault();

    var id = $("#userid").val().trim(); // hidden id field
    var itemname = $("#itemname").val().trim();
    var price = $("#price").val().trim();
    var description = $("#description").val().trim();
    var fileInput = $("#image")[0].files[0];

    var isValid = true;
    $(".text-danger").text("");

    // Validation
    if(itemname === ""){
        $("#itemnameerror").text("Item name is required");
        isValid = false;
    }

    if(price === ""){
        $("#priceerror").text("Price is required");
        isValid = false;
    } else if(isNaN(price) || price <= 0){
        $("#priceerror").text("Price must be a valid number");
        isValid = false;
    }

    if(description === ""){
        $("#descriptionerror").text("Description is required");
        isValid = false;
    }

    // Image required only for insert
    if((id === "" || id == null) && !fileInput){
        $("#imageerror").text("Image is required");
        isValid = false;
    }

    if(!isValid){
        return;
    }

   
    var url = (id === "" || id == null) ? "/cool/item-insert" : "/cool/item-update";

    // Prepare form data
    var formData = new FormData();
    formData.append("id", id);
    formData.append("itemname", itemname);
    formData.append("price", price);
    formData.append("description", description);
    formData.append("existing_image", $("#existing-image").val());
    formData.append("submit", "1");

    if(fileInput){
        formData.append("image", fileInput);
    }

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.trim() === "success"){
                loaditems();                      
                $("#showclient").tab("show");    
                $("#clientForm")[0].reset();      
                $("#userid").val("");             
                $("#existing-image").val("");     
                $("#current-image-container").hide();
            } else {
                alert("Insert/Update failed: " + response);
            }
        }
    });

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
    


//search api start form here

$(document).on("click","#serach",function(){

    var searchvalue = $("#searchname").val();

    $.ajax({
        url:"/cool/item-search",
        type:"POST",
        data:{
            search:searchvalue
        },
        success:function(response){

            $("#bodydata").html(response);

        }
    });

});







//delete api start form here 

$(document).on("click", ".deletebutton", function() {
    var itemid = $(this).data("id");
    var element = this;

    var isConfirmed = confirm("Are you sure you want to delete this item?");

    if (isConfirmed) {
        $.ajax({
            url: "/cool/item-delete",
            type: "POST",
            data: {
                id: itemid
            },
            success: function(response) {
                if (response.trim() === "success") {
                    $(element).closest("tr").fadeOut();
                } 
            }
        });
    } 
});








//fetch item start form here



//   loaditems();

//     function loaditems() {
//         $.ajax({
//             url: "/cool/item-fetch",   
//             type: "GET",
//             success: function(data) {
//                 $("#bodydata").html(data); 
//             }
//         });
//     }





  //insert item start form here
// $(document).on("click", "#submit", function(e) {
//     e.preventDefault();

//     var itemname    = $("#itemname").val();
//     var price       = $("#price").val();
//     var description = $("#description").val();
//     var image       = $("#image")[0].files[0];

//     // if (itemname == "" || price == "" || description == "" || !image) {
//     //     alert("Please fill all fields and upload an image.");
//     //     return;
//     // }

//     var valid = true;
//     $(".text-danger").text("");

//     if(itemname == "") {
//         $("#itemnameerror").text("Item name is required");
//         valid = false;
//     }

//     if(price == "") {
//         $("#priceerror").text("Price is required");
//         valid = false;
//     } else if (!/^\d+(\.\d+)?$/.test(price) || Number(price) <= 0) {
//         $("#priceerror").text("Enter a valid positive price");
//         valid = false;
//     }

//     if(!description  ) {
//         $("#descriptionerror").text("Description is required");
//         valid = false;
//     }





//     if(!valid) return;



    

//     var formData = new FormData();
//     formData.append("itemname", itemname);
//     formData.append("price", price);
//     formData.append("description", description);
//     formData.append("image", image);
//     formData.append("submit", "1"); 

//     $.ajax({
//         url: "/cool/item-insert",
//         type: "POST",
//         data: formData,                 
//         contentType: false,              
//         processData: false,          
//         success: function(response) {
//             if (response.trim() == "success") {
                
//                 $("#clientForm")[0].reset();
//                   $("#showclient").tab('show');
                
//             } else {
              
//             }
//         }
//     });
// });








let page = 1;
let limit = 5;
let search = '';
let orderCol = 'id';
let orderDir = 'ASC';

function loaditems() {
    limit = $("#limit").val() || 5;
    search = $("#searchname").val().trim();

    $.ajax({
        url: "/cool/item-pagination",
        type: "POST",
        data: { page, limit, search, orderCol, orderDir },
        success: function(response) {
            let data = typeof response === "string" ? JSON.parse(response) : response;

            $("#bodydata").html(data.table);

        
            let pagination = "";
            pagination += `<button class='btn btn-secondary mx-1' id='prev' ${data.page <= 1 ? 'disabled' : ''}>Prev</button>`;
            pagination += `<span class='mx-2 fw-bold'>Page ${data.page} of ${data.totalPages}</span>`;
            pagination += `<button class='btn btn-secondary mx-1' id='next' ${data.page >= data.totalPages ? 'disabled' : ''}>Next</button>`;
            $(".paging").html(pagination);

         
            $(".sort").html("↕");
            $(`.sort[data-column="${orderCol}"]`).html(orderDir === 'ASC' ? '↑' : '↓');
        }
    });
}

loaditems();


$(document).on("click", "#prev", function () {
    if (page > 1) { 
        page--; 
        loaditems(); }
});
$(document).on("click", "#next", function () {
    page++; 
    loaditems();
});


$("#limit").on("change", function () {
    page = 1; 
    loaditems();
});


$("#search").on("click", function () {
    page = 1; 
    loaditems();
});



$(document).on("click", ".sort", function () {
    let col = $(this).data("column");

    if (orderCol === col) {
        orderDir = orderDir === 'ASC' ? 'DESC' : 'ASC'; 
    } else {
        orderCol = col;
        orderDir = 'ASC'; 
    }

    page = 1; 
    loaditems();
});
