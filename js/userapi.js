

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
    

    //insert start form here 
 $(document).on('click', '#submit', function(e) {
        e.preventDefault(); 

        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var status = $("#status").val();

      if(name=="" || email=="" || phone=="" || status==""){
        alert("Please fill all fields");
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
             success:function(response){
            if(response.trim() == "success"){
    window.location.href = "/cool/userhome";
                $("#clientForm")[0].reset();
            }else{
                 $("#clientForm")[0].reset();
                
            }
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