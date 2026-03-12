

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

// 
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

    // Remove item row
    $(document).on("click", ".remove-item", function() {
        $(this).closest(".item-row").remove();
        updateTotal();
    });

    // Handle form submission via AJAX
    $("#invoicesave").click(function(e) {
        e.preventDefault();

        // Collect form data
        const clientName = $('#clientname').val();
        const invoiceEmail = $('#invoiceemail').val();
        const invoicePhone = $('#invoicephone').val();
        const total = $('#total').val();

        // Collect items data
        let items = [];
        $('#itemsContainer .item-row').each(function() {
            const itemName = $(this).find('.itemname').val();
            const price = parseFloat($(this).find('.itemprice').val()) || 0;
            const quantity = parseInt($(this).find('.quantity').val()) || 1;
            items.push({ itemname: itemName, price: price, quantity: quantity });
        });

    
        const data = {
            clientname: clientName,
            invoiceemail: invoiceEmail,
            invoicephone: invoicePhone,
            total: total,
            items: items
        };

     
        $.ajax({
            url: '/cool/invoice-create',  
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),  
            success: function(response) {
                const res = typeof response === 'string' ? JSON.parse(response) : response;

                if (res.status === 'success') {
                    alert('Invoice saved successfully! Invoice ID: ' + res.invoice_id);
                    $('#invoiceForm')[0].reset(); 

                   
                    
                    
                    $('#total').val('0');  

                } else {
                    alert('Error: ' + res.message);
                }
            }
        });
    });



  





   
    $('#invoicereset').click(function(e) {
        e.preventDefault();
        $('#invoiceForm')[0].reset();
        $('#itemsContainer').html('');
        $('#total').val('0');
    });

    updateTotal();



   

