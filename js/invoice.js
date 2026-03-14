

   function updateTotal() {
    let overallTotal = 0;

    $("#itemsContainer .item-row").each(function() {
        const price = parseFloat($(this).find(".itemprice").val()) || 0;
        const qty   = parseInt($(this).find(".quantity").val()) || 1;
        const rowTotal = price * qty;
        overallTotal += rowTotal;
    });

    $("#total").val(overallTotal.toFixed(2));
}


$(document).on("click", ".increase", function() {
    const qtyInput = $(this).siblings(".quantity");
    qtyInput.val(parseInt(qtyInput.val()) + 1);
    updateTotal();
});

$(document).on("click", ".decrease", function() {
    const qtyInput = $(this).siblings(".quantity");
    let current = parseInt(qtyInput.val());
    if (current > 1) qtyInput.val(current - 1);
    updateTotal();
});


$(document).on("input", ".quantity, .itemprice", function() {
    updateTotal();
});










//  itemname on change 
$(document).on("change", ".itemname", function() {
    const row = $(this).closest(".item-row");
    const itemName = $(this).val().trim();

    if (itemName) {
        $.ajax({
            url: '/cool/itemsdetails',
            type: 'POST',
            data: { name: itemName },
            success: function(response) {
                const data = typeof response === 'string' ? JSON.parse(response) : response;

                if (data.price) {
                    row.find(".itemprice").val(data.price);
                } else {
                    alert(data.message || 'Item not found');
                    row.find(".itemprice").val('');
                }
                updateTotal();
            }
        });
    }
});


// api for the suggest cientname 
$("#clientname").on("keyup", function (e) {
    const searchTerm = $(this).val().trim();

   
    if (searchTerm.length > 0) {

        console.log("Searching for:", searchTerm);
        $.ajax({
            url: '/cool/getclients',  
            type: 'GET',
            data: { query: searchTerm }, 
            success: function (response) {
                const clientList = $('#clientList');  
                
             
                clientList.empty();  

                if (response.clients && response.clients.length > 0) {
                    
                    response.clients.forEach(client => {
                        clientList.append(new Option(client.name, client.name)); 
                    });
                } else {
                   
                    clientList.append(new Option("No clients found", ""));
                }
            },
            error: function () {
                alert('Failed to fetch client list.');
            }
        });
    } else {
        $('#clientList').empty();  
    }
});



//api for suggest the  itemname

$("#itemname").on("keyup", function() {
    const searchTerm = $(this).val().trim();

    if (searchTerm.length > 0) {
        $.ajax({
            url: "/cool/getitems",
            type: "GET",
            data: { query: searchTerm },
            success: function(response) {
                const itemList = $("#itemList");  

                itemList.empty(); 

                if (response.items && response.items.length > 0) {
                    
                    response.items.forEach(item => {
                       
                        itemList.append(new Option(item.itemname, item.itemname));
                    });
                } else {
                 
                    itemList.append(new Option("No items found", ""));
                }
            },
            error: function() {
                alert('Failed to fetch item list.');
            }
        });
    }
});


//client name on change start form here 


     $('#clientname').on('change', function() {
    var clientName = $(this).val();

    if (clientName) {
        $.ajax({
            url: '/cool/clientdetails',
            type: 'POST',
            data: { 
                name: clientName
             },
            success: function(response) {

                var data = typeof response === 'string' ? JSON.parse(response) : response;

                if (data.email && data.phone) {
                    $('#invoiceemail').val(data.email);
                    $('#invoicephone').val(data.phone); 
                } else {
                    alert(data.message);
                    $('#invoiceemail').val('');
                    $('#invoicephone').val('');
                }
            }
        });
    }
});

   
 $("#addItem").click(function() {
        const newRow = `
            <div class="row item-row mb-2 mx-1">
                <div class="col-md-4">
                    <input type="text" class="form-control itemname" placeholder="Item Name" />
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control itemprice" placeholder="Price" />
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                        <input type="number" class="form-control quantity" value="1" min="1" />
                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <button class="btn btn-danger remove-item " type="button">Remove</button>
                </div>
            </div>`;
        $("#itemsContainer").append(newRow);
        updateTotal();
    });


    $(document).on("click", ".remove-item", function() {
        $(this).closest(".item-row").remove();
        updateTotal();
    });



    // api form insert start from here 

 
// $(document).on("click", "#invoicesave", function(e) {
//         e.preventDefault();

//          const invoiceId = $('#invoiceid').text();
//         const clientName = $('#clientname').val();
//         const invoiceEmail = $('#invoiceemail').val();
//         const invoicePhone = $('#invoicephone').val();
//         const total = $('#total').val();

//         // Collect items data
//         let items = [];
//         $('#itemsContainer .item-row').each(function() {
//             const itemName = $(this).find('.itemname').val();
//             const price = parseFloat($(this).find('.itemprice').val()) || 0;
//             const quantity = parseInt($(this).find('.quantity').val()) || 1;
//             items.push({
//                  itemname: itemName,
//                   price: price, 
//                   quantity: quantity 
//                 });
//         });

    
//        const data = {
//         invoiceid: invoiceId,
//         clientname: clientName,
//         invoiceemail: invoiceEmail,
//         invoicephone: invoicePhone,
//         total: total,
//         items: items
//     };

     
//         $.ajax({
//             url: '/cool/invoice-create',  
//             type: 'POST',
//             contentType: 'application/json',
//             data: JSON.stringify(data),  
//             success: function(response) {
//                 const res = typeof response === 'string' ? JSON.parse(response) : response;

//                 if (res.status === 'success') {
//                     loadinvoice();
                       
//                     $('#invoiceForm')[0].reset(); 
//                     $("#showclient").tab("show");

                        

                   
                    
                    
//                     $('#total').val('0');  

//                 } else {
//                     alert('Error: ' + res.message);
                    
//                 }
//             },
            
//     error: function() {
       
//         alert('An error occurred while creating the invoice.');
//     }
//         });
//     });



  
// generate uniquer id
$("#addclient").click(function(){

let uniqueId = "SAN-" + Math.floor(100000 + Math.random() * 900000);

$("#invoiceid").text(uniqueId);

});






// fetch api start form here
//   function loadinvoice() {
//     $.ajax({
//         url: "/cool/invoice-fetch",
//         type: "GET",
//         success: function(data) {
//             $("#bodydata").html(data);
//         }
//     });
// }

// loadinvoice();


let page = 1;

let limit = 5;
 
let search = '';
let orderCol = 'id';
let orderDir = 'ASC';



function loadinvoice() {

    limit = $("#limit").val() || 5;
    search = $("#searchname").val().trim();  

    $.ajax({
        url: "/cool/invoice-pagination", 
        type: "POST",
        data: {
            page: page,         
            limit: limit,        
            search: search,      
            orderCol: orderCol,  
            orderDir: orderDir   
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


loadinvoice();


$("#limit").on("change", function () {
    page = 1; 
    loadinvoice();
});


$("#search").on("click", function () {
    page = 1; 
    loadinvoice();
});

$(document).on("click", "#prev", function () {
    if (page > 1) { 
        page--; 
        loadinvoice(); }
});
$(document).on("click", "#next", function () {
    page++; 
    loadinvoice();
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
    loadinvoice();
});



// select for udpate start form here 

$(document).on("click", ".update-invoice", function() {
    var id = $(this).data("eid");

       $("#addclient").tab("show");

    $.ajax({
        url: "/cool/selectbyid", 
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

          
            $("#invoice_id").val(response.invoice.invoice_id);
              $("#invoiceid").val(response.invoice.invoice_codes);
           $("#clientname").val(response.invoice.client_name).prop("readonly", true);
     $("#invoiceemail").val(response.invoice.email).prop("readonly", true);
      $("#invoicephone").val(response.invoice.phone).prop("readonly", true);
            $("#total").val(response.invoice.total);

           
            $("#itemsContainer").empty();

            
            if (response.items && response.items.length > 0) {
    response.items.forEach(function(item) {
    var itemRow = `
    <div class="row item-row mb-2" data-itemid="${item.item_id}">
        <div class="col-md-4 ml-2">
            <label class="fw-bold text-black">Item Name</label>
            <input type="text" class="form-control itemname" value="${item.item_name}" />
        </div>
        <div class="col-md-4">
            <label class="fw-bold text-black">Price</label>
            <input type="number" class="form-control itemprice" value="${item.price}" />
        </div>
        <div class="col-md-2">
            <label class="fw-bold text-black">Quantity</label>
            <input type="number" class="form-control quantity" value="${item.quantity}" />
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-danger remove-item" type="button">Remove</button>
        </div>
    </div>`;
    $("#itemsContainer").append(itemRow);
});
}
        },
        error: function() {
            alert("An error occurred while fetching the invoice.");
        }
    });
});

//udpate start form here 
$(document).on("click", "#invoicesave", function(e) {
    e.preventDefault();
    
    var items = [];
    
    $(".item-row").each(function() {
        var item_id = $(this).data("itemid");
        
        if (!item_id) return; 

        var item_name = $(this).find(".itemname").val();
        var price = parseFloat($(this).find(".itemprice").val());
        var quantity = parseInt($(this).find(".quantity").val());

    
        if (item_name && !isNaN(price) && !isNaN(quantity) && price > 0 && quantity > 0) {
            items.push({
                item_id: item_id,
                item_name: item_name,
                price: price,
                quantity: quantity
            });
        }
    });

    if (items.length === 0) {
        alert("No valid items to update.");
        return;
    }

    $.ajax({
        url: "/cool/invoice-update", 
        type: "POST",
        data: { 
            items: JSON.stringify(items) 
        },
        dataType: "json",
        success: function(response) {
            if (response.error) {
                alert("Error: " + response.error);
            } else if (response.status === "failure") {
                alert("Failed to update some items: " + JSON.stringify(response.failed_updates));
            } else {
                 loadinvoice();
                   $("#showclient").tab('show');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
            alert("An error occurred while updating the invoice.");
        }
    });
});











//pdf generate api
$(document).on('click', '.generate-pdf', function() {
    var invoiceId = $(this).data('id');
    
    $.ajax({
        type: 'GET',
        url: '/cool/pdf-generate', 
        data: { 
            id: invoiceId 
        },
        responseType: 'arraybuffer',
        success: function(response) {
           
            var blob = new Blob([response], { type: 'application/pdf' });
            
   
            var url = window.URL.createObjectURL(blob);
            

            window.open(url);
        },
        error: function(xhr, status, error) {
            console.error('Error generating PDF:', status, error);
        }
    });
});



   
    $('#invoicereset').click(function(e) {
        e.preventDefault();
        $('#invoiceForm')[0].reset();
    
        $('#total').val('0.00');
    });

    updateTotal();



   

