 $(document).ready(function(){

// $("#itemMaster").click(function(){

// $("#rightPanel").load("/cool/public/views/itemright.php");

// });


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
        // $(".right").toggleClass("expanded");   
    });

  });

  $(".nav-link").click(function(){
        $(".nav-link").removeClass("active"); 
        $(this).addClass("active");

})


//update select and update api start from her 

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
        url: "/cool/itemid",
        type: "POST",
        data: { 
            id: id
        },
        success: function(response){
            $("#update-form").html(response);
        } 
    });
});

$(document).on('click', '#update-item', function() { 
        var formData = new FormData();
        var id = $('#edit-id').val();
        var itemname = $('#edit-itemname').val();
        var price = $('#edit-price').val();
        var description = $('#edit-description').val();
        var fileInput = $('#edit-image')[0].files[0];

        formData.append('id', id);
        formData.append('itemname', itemname);
        formData.append('price', price);
        formData.append('description', description);

        if (fileInput) {
            formData.append('image', fileInput);
        }

        $.ajax({
            url: '/cool/item-update', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
          success: function(response) {
        if (response.trim() === 'success') {
           
            $("#model").hide(); 
            loaditems();
        } else {
            $("#model").hide(); 
            loaditems();
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
                } else {
                    console.log(response);
                }
            }
        });
    } else{
        console.log("error in deleting")
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
$(document).on("click", "#submit", function(e) {
    e.preventDefault();

    var itemname    = $("#itemname").val();
    var price       = $("#price").val();
    var description = $("#description").val();
    var image       = $("#image")[0].files[0];

    if (itemname == "" || price == "" || description == "" || !image) {
        alert("Please fill all fields and upload an image.");
        return;
    }


    var formData = new FormData();
    formData.append("itemname", itemname);
    formData.append("price", price);
    formData.append("description", description);
    formData.append("image", image);
    formData.append("submit", "1"); 

    $.ajax({
        url: "/cool/item-insert",
        type: "POST",
        data: formData,                 
        contentType: false,              
        processData: false,          
        success: function(response) {
            if (response == "success") {
                
                $("#clientForm")[0].reset();
                 window.location.href = "/cool/home";  
            } else {
              
            }
        }
    });
});




// pagintaion api start from here 

let page = 1;
let limit = 5;

function loaditems (){
         let limit = $("#limit").val() || 5;

 $.ajax({
        url: "/cool/item-pagination",
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

loaditems();


$(document).on("click","#prev",function(){

if(page > 1){
page--;
loaditems();
}

});

$(document).on("click","#next",function(){


page++;

loaditems();

});

$("#limit").change(function(){

page = 1;
loaditems();

});

