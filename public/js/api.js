
    $(document).on('click', '#submit', function(e) {
        e.preventDefault(); 

        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var status = $("#status").val();

        console.log(name, email, phone, status);

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

    if (response.trim() === 'success') {
        $("form")[0].reset(); 

       window.location.href='/cool/home'
    } else {
        alert("Insert failed: " + response); 
    }
}
        });
    });





  function registerbtn(){

    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();

    if (name === "" || email === "" || password === "") {
        alert("All fields are required! Please fill out the entire form.");
        return;
    }

 $.ajax({
    url: "/cool/auth",
    type: "POST",
    data: {
        name: name,
        email: email,
        password: password
    },
    success: function(response) {
          
        if (response.trim() === 'success') {
            $("#registerform")[0].reset();
            window.location.href="/cool/login";
        } else {
           
        }
    },
})
};







    
    $("#search").click(function() {
        
        var searchname = $("#searchname").val();  
        var searchemail = $("#searchemail").val();  
        var searchphone = $("#searchphone").val();  
        var searchstatus = $("#searchstatus").val();  
        
            $.ajax({
                url: "/cool/search-users",  
                type: "POST", 
                data: {
                       search:true,
              
                    searchname: searchname,
                    searchemail:searchemail,
                    searchphone:searchphone,
                    searchstatus:searchstatus
                    
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


 


    