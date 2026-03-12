
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


$('#itemname').on('change', function() {
    var itemName = $(this).val().trim();

    if (itemName) {
        $.ajax({
            url: '/cool/itemsdetails',
            type: 'POST',
            data: {
                name: itemName
            },
            success: function(response) {
                var data = typeof response === 'string' ? JSON.parse(response) : response;

               
                if (data.price) {
                    $('#invoiceprice').val(data.price);
                } else {
                    alert(data.message || 'Item not found');
                    $('#invoiceprice').val('');
                }
            }
        });
    }
});




