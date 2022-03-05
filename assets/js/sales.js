function goods_add_sales_items(baseurl,sales_head_id) {
    window.open(baseurl+"index.php/sales/goods_add_sales_item/"+sales_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function goods_update_sales_items(baseurl) {
    window.open(baseurl+"index.php/sales/goods_update_sales_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_add_sales_items(baseurl) {
    window.open(baseurl+"index.php/sales/services_add_sales_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_update_sales_items(baseurl) {
    window.open(baseurl+"index.php/sales/services_update_sales_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function proceed_sales(){
    var data = $("#salesHead").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/add_sales_head_process";
    var redirect2 = loc+"sales/load_button";
    var conf = confirm('Are you sure you want to proceed?');
    if(conf){
          $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){ 
                var x = document.getElementById("myDIV");
                var proc = document.getElementById("proc");
                var cancel = document.getElementById("cancel");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    proc.style.display = "none";
                    cancel.style.display = "block";
                } else {
                    x.style.display = "none";
                    proc.style.display = "block";
                    cancel.style.display = "none";
                }
                document.getElementById("sales_good_head_id").value  = response.sales_good_head_id;
                $("#myButton").append('<button class="btn btn-gradient-primary btn-xs pull-right " onclick="goods_add_sales_items(\''+loc+'\','+response.sales_good_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Item</button>'); 
                //window.history.pushState('page2', 'Title', loc+'sales/goods_add_sales_head/'+response.sales_good_head_id);
            }
        });  
    }
}



function cancel_sale(){
    var id = document.getElementById("sales_good_head_id").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/cancel_sales";
    var conf = confirm('Are you sure you want to cancel sales transaction?');
    if(conf){
		$.ajax({
			data: "id="+id,
			type: "POST",
			url: redirect,
			success: function(response){
				//window.history.pushState('page2', 'Title', loc+'sales/goods_add_sales_head');
			    location.reload(true);
			}
		});
    }
}

function client_append(){
	var client_id = document.getElementById("client").value;
	var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/client_info";
    $.ajax({
		data: 'client_id='+client_id,
		type: "POST",
		url: redirect,
		dataType: "json",
		success: function(response){
			document.getElementById("address").value = response.address;
			document.getElementById("tin").value = response.tin;
			document.getElementById("contact_person").value = response.contact_person;
			document.getElementById("contact_no").value = response.contact_no;
		}
	});  
}

function save_item(){
    var data = $("#sales_item").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_items";
    $.ajax({
        type: "POST", // Post / Get method
        url: redirect, //Where form data is sent on submission
        data:data, //Form variables
        success:function(response){
        	if (window.opener != null && !window.opener.closed) {
        		window.opener.document.getElementById("append_data").append(response);
			}
			window.close();
        }
    });
}

function item_append(){
    var item_id = document.getElementById("item").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/item_info";
    $.ajax({
        data: 'item_id='+item_id,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById("serial_no").value = response.serial_no;
            document.getElementById("selling_price").value = response.selling_price;
            document.getElementById("quantity").value = response.quantity;
            document.getElementById("uom").value = response.unit;
        }
    });  
}