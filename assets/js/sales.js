function goods_add_sales_items(baseurl,sales_head_id) {
    window.open(baseurl+"sales/goods_add_sales_item/"+sales_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function goods_update_sales_items(baseurl) {
    window.open(baseurl+"sales/goods_update_sales_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_add_sales_items(baseurl,sales_serv_head_id) {
    window.open(baseurl+"sales/services_add_sales_item/"+sales_serv_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_add_consumable(baseurl,sales_serv_head_id) {
    window.open(baseurl+"sales/services_add_consumable/"+sales_serv_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_add_manpower(baseurl,sales_serv_head_id) {
    window.open(baseurl+"sales/services_add_manpower/"+sales_serv_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function services_add_rental(baseurl,sales_serv_head_id) {
    window.open(baseurl+"sales/services_add_rental/"+sales_serv_head_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

// function services_update_sales_items(baseurl) {
//     window.open(baseurl+"sales/services_update_sales_items", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
// }

// function services_update_consumable(baseurl) {
//     window.open(baseurl+"sales/services_update_consumable/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
// }

// function services_update_manpower(baseurl) {
//     window.open(baseurl+"sales/services_update_manpower/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
// }

// function services_update_rental(baseurl) {
//     window.open(baseurl+"sales/services_update_rental/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
// }

function proceed_sales(){
    var data = $("#salesHead").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/add_sales_head_process";
    //var redirect2 = loc+"sales/load_button";
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
                var open = document.getElementById("open");
                var submitdata = document.getElementById("submitdata");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    proc.style.display = "none";
                    cancel.style.display = "block";
                    open.style.display = "block";
                    submitdata.style.display = "block";
                    $('#client').attr("disabled", true); 
                    document.getElementById('sales_date').readOnly = true;
                    document.getElementById('remarks').readOnly = true;
                    document.getElementById('pr_no').readOnly = true;
                    document.getElementById('po_no').readOnly = true;
                    document.getElementById('pr_date').readOnly = true;
                    document.getElementById('po_date').readOnly = true;
                    $('#vat').attr("disabled", true); 

                } else {
                    x.style.display = "none";
                    proc.style.display = "block";
                    cancel.style.display = "none";
                    open.style.display = "none";
                    submitdata.style.display = "none";
                }
                document.getElementById("sales_good_head_id").value  = response.sales_good_head_id;
                $("#myButton").append('<button class="btn btn-gradient-primary btn-xs pull-right " onclick="goods_add_sales_items(\''+loc+'\','+response.sales_good_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Item</button>'); 
                //window.history.pushState('page2', 'Title', loc+'sales/goods_add_sales_head/'+response.sales_good_head_id);
            }
        });  
    }
}

function open_fields(){
    var open = document.getElementById("open");
    var save = document.getElementById("save");
    open.style.display = "none";
    save.style.display = "block";
    $('#client').attr("disabled", false); 
    document.getElementById('sales_date').readOnly = false;
    document.getElementById('remarks').readOnly = false;
    document.getElementById('pr_no').readOnly = false;
    document.getElementById('po_no').readOnly = false;
    document.getElementById('pr_date').readOnly = false;
    document.getElementById('po_date').readOnly = false;
    $('#vat').attr("disabled", false); 
}

function update_sales(){
    var data = $("#salesHead").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/update_sales";
    var conf = confirm('Are you sure you want to save this?');
    if(conf){
          $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){ 
                var open = document.getElementById("open");
                var save = document.getElementById("save");
                if(response.status=='success'){
                    open.style.display = "block";
                    save.style.display = "none";
                    $('#client').attr("disabled", true); 
                    document.getElementById('sales_date').readOnly = true;
                    document.getElementById('remarks').readOnly = true;
                    document.getElementById('pr_no').readOnly = true;
                    document.getElementById('po_no').readOnly = true;
                    document.getElementById('pr_date').readOnly = true;
                    document.getElementById('po_date').readOnly = true;
                    $('#vat').attr("disabled", true); 
                    alert("Successfully Updated!");
                }else{
                    alert("Error! Please Try Again!");
                }
            }
        });  
    }
}

$(document).ready(function() {
    $('.update_selling').blur(function() {
        var data = $("#salesHead").serialize();
        var loc= document.getElementById("baseurl").value;
        var redirect = loc+"sales/update_selling";
        $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            success: function(output){
                location.reload();
            }
        });  

    });

    $('.update_discount').blur(function() {
        var data = $("#salesHead").serialize();
        var loc= document.getElementById("baseurl").value;
        var redirect = loc+"sales/update_discount";
        $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            success: function(output){
                location.reload();
            }
        });  

    });
});

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
    var conf = confirm('Are you sure you want to save this item?');
    if(conf){
	    $.ajax({
	        type: "POST", // Post / Get method
	        url: redirect, //Where form data is sent on submission
	        data:data, //Form variables
	        success:function(response){
                //alert(response);
	        	if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data").append(response);
	        		//window.opener.document.getElementById("append_data").append(response);
				}
				window.close();
	        }
	    });
	}
}

function item_append(){
    var item_id = $('select#item option:selected').attr('mytag');
    var in_id = document.getElementById("item").value;
    /*var exp = explode.split(",");
    var in_id = exp[0];
    var item_id = exp[1];*/
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/item_info";
    $.ajax({
        data: 'in_id='+in_id+'&item_id='+item_id,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            //document.getElementById("serial_no").value = response.serial_no;
            //document.getElementById("unit_cost").value = response.unit_cost;
            //document.getElementById("quantity").value = response.quantity;
            document.getElementById("uom").value = response.unit;
            document.getElementById("item_id").value = response.item_id;
            document.getElementById("group_id").value = response.group_id;
            document.getElementsByName('quantity')[0].placeholder = response.remaining_qty;
        }
    });  
}

function qty_append(){
    var item_id = $('select#item option:selected').attr('mytag');
	var in_id = document.getElementById("item").value;
    var qty = document.getElementById("quantity").value;
    /*var exp = explode.split(",");
    var in_id = exp[0];
    var item_id = exp[1];*/
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/qty_info";
    $.ajax({
        data: 'in_id='+in_id+'&item_id='+item_id+'&qty='+qty,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
          
          
            if(response.status!='error'){
                document.getElementById("unit_cost").value = response.cost;
                document.getElementById("serial_no").value = response.serial_no;
                document.getElementById("saveitem").disabled = false;
            } else {
                alert('Quantity requested exceeds available quantity!');
                document.getElementById("saveitem").disabled = true;
            }       
        }
    }); 
}

function delete_sales_item(sales_good_det_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/delete_item";
    var load = loc+"sales/goods_add_sales_head";
    $.ajax({
        data: 'sales_good_det_id='+sales_good_det_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_data'+count).remove();
        	$('#load_data'+count).load(loc+"sales/goods_add_sales_head #load_data"+count+"");
        }
    });  
}

function changePrice(){
	var selling_price = document.getElementById("selling_price").value;
	var qty = document.getElementById("quantity").value;
	var tprice = parseFloat(selling_price) * parseFloat(qty);
     
    var discount = document.getElementById("discount").value;
   
/*    var percent=discount/100;
    var new_discount = parseFloat(percent)*parseFloat(tprice);*/
    if(discount!=''){
        var total = (parseFloat(selling_price) * parseFloat(qty))-parseFloat(discount);
    } else {
         var total = parseFloat(selling_price) * parseFloat(qty);
    }
   // document.getElementById("discount_amount").value = parseFloat(discount);
    document.getElementById("grandtotal").value  = parseFloat(total);
}

function isNumberKey(txt, evt){
   var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
            return true;
        } else {
            return false;
        }
    } else {
        if (charCode > 31
             && (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
}

function saveAll(){
	var data = $("#saveAll").serialize();
	var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/save_sales";
    var conf = confirm('Are you sure you want to save this Sales?');
    if(conf){
	    $.ajax({
	        data: data,
	        type: "POST",
	        url: redirect,
	        beforeSend: function(){
	        	document.getElementById('alt').innerHTML='<b>Please wait, Saving Data...</b>'; 
                $("#submitdata").hide(); 
	        },
	        success: function(output){
	        	window.location=loc+'sales/goods_print_sales/'+output;  
	        }
	    }); 
    }	 
}

function proceed_sales_service(){
    var data = $("#salesService").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/add_sales_service_process";
    var conf = confirm('Are you sure you want to proceed?');
    if(conf){
          $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){ 
                var x = document.getElementById("myDIV2");
                var proc = document.getElementById("proc_service");
                var cancel = document.getElementById("cancel_service");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    proc.style.display = "none";
                    cancel.style.display = "block";
                    $('#client').attr("disabled", true); 
                    document.getElementById('sales_date').readOnly = true;
                    document.getElementById('jor_no').readOnly = true;
                    document.getElementById('joi_no').readOnly = true;
                    document.getElementById('jor_date').readOnly = true;
                    document.getElementById('joi_date').readOnly = true;
                    document.getElementById('date_started').readOnly = true;
                    document.getElementById('date_completed').readOnly = true;
                    document.getElementById('duration').readOnly = true;
                    document.getElementById('overall_remarks').readOnly = true;
                    document.getElementById('purpose').readOnly = true;
                    document.getElementById('ar_description').readOnly = true;
                    document.getElementById('remarks').readOnly = true;
                    document.getElementById('administrative_fee').readOnly = true;
                    $('#shipped_via').attr("disabled", true); 
                    document.getElementById('waybill_no').readOnly = true;
                    $('#vat').attr("disabled", true); 
                } else {
                    x.style.display = "none";
                    proc.style.display = "block";
                    cancel.style.display = "none";
                }
                document.getElementById("sales_serv_head_id").value  = response.sales_serv_head_id;
                $("#myButton2").append('<button class="btn btn-gradient-primary btn-xs mr-1 ml-1" onclick="services_add_sales_items(\''+loc+'\','+response.sales_serv_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Item</button>'); 
                $("#myButton2").append('<button class="btn btn-gradient-primary btn-xs mr-1 ml-1" onclick="services_add_consumable(\''+loc+'\','+response.sales_serv_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Consumable</button>'); 
                $("#myButton2").append('<button class="btn btn-gradient-primary btn-xs mr-1 ml-1" onclick="services_add_manpower(\''+loc+'\','+response.sales_serv_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Manpower</button>'); 
                $("#myButton2").append('<button class="btn btn-gradient-primary btn-xs mr-1 ml-1" onclick="services_add_rental(\''+loc+'\','+response.sales_serv_head_id+')" name=""><span class="mdi mdi-plus"></span> Add Rental</button>'); 
            }
        });  
    }
}



function cancel_sales_service(){
    var id = document.getElementById("sales_serv_head_id").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/cancel_service";
    var conf = confirm('Are you sure you want to cancel sales transaction?');
    if(conf){
        $.ajax({
            data: "id="+id,
            type: "POST",
            url: redirect,
            success: function(response){
                location.reload(true);
            }
        });
    }
}

function save_service_item(){
    var data = $("#service_item").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_service_items";
    var total = loc+"sales/sum_serv_price";
    var conf = confirm('Are you sure you want to save this item?');
    if(conf){
        $.ajax({
            type: "POST", // Post / Get method
            url: redirect, //Where form data is sent on submission
            data:data, //Form variables
            success:function(response){
                //alert(response);
                if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data2").append(response);
                    //window.opener.document.getElementById("append_data").append(response);
                    $.ajax({
                        type: "POST", 
                        url: total,
                        data:data,
                        success:function(output){
                            /*$('#temp_disp').hide();*/
                            //window.opener.document.getElementById("temp_disp").hide();
                            // var proc = window.opener.document.getElementById("temp_disp_item");
                            // proc.style.display = "none";
                            window.opener.document.getElementById("subtotal").innerHTML = output;
                            window.close();
                        }
                    });
                }
            }
        });
    }
}

function delete_service_item(sales_serv_items_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/delete_service_item";
    $.ajax({
        data: 'sales_serv_items_id='+sales_serv_items_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_data'+count).remove();
            $('#subtotal').load(loc+"sales/services_add_sales_head #subtotal");
            $('#load_data'+count).load(loc+"sales/services_add_sales_head #load_data"+count+"");
        }
    });  
}

function save_service_materials(){
    var data = $("#service_materials").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_service_materials";
    var total = loc+"sales/sum_materials_price";
    var conf = confirm('Are you sure you want to save this materials?');
    if(conf){
        $.ajax({
            type: "POST", // Post / Get method
            url: redirect, //Where form data is sent on submission
            data:data, //Form variables
            success:function(response){
                if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data3").append(response);
                    $.ajax({
                        type: "POST", 
                        url: total,
                        data:data,
                        success:function(output){
                            // var proc = window.opener.document.getElementById("temp_disp_material");
                            // proc.style.display = "none";
                            window.opener.document.getElementById("subtotal2").innerHTML = output;
                            window.close();
                        }
                    });
                }
            }
        });
    }
}

function delete_service_materials(sales_serv_mat_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/delete_service_materials";
    $.ajax({
        data: 'sales_serv_mat_id='+sales_serv_mat_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_material'+count).remove();
            $('#subtotal2').load(loc+"sales/services_add_sales_head #subtotal2");
            $('#load_material'+count).load(loc+"sales/services_add_sales_head #load_material"+count+"");
        }
    });  
}

function materials_price(){
    var qty = document.getElementById("quantity").value;
    var unit_cost = document.getElementById("unit_cost").value;
    var total = parseFloat(unit_cost) * parseFloat(qty);
    document.getElementById("grandtotal").value  = parseFloat(total);
}

function save_service_manpower(){
    var data = $("#service_manpower").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_service_manpower";
    var total = loc+"sales/sum_manpower_price"
    var conf = confirm('Are you sure you want to save this manpower?');
    if(conf){
        $.ajax({
            type: "POST", // Post / Get method
            url: redirect, //Where form data is sent on submission
            data:data, //Form variables
            success:function(response){
                if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data4").append(response);
                    $.ajax({
                        type: "POST", 
                        url: total,
                        data:data,
                        success:function(output){
                            /*var proc = window.opener.document.getElementById("temp_disp_manpower");
                            proc.style.display = "none";*/
                            window.opener.document.getElementById("subtotal3").innerHTML = output;
                            window.close();
                        }
                    });
                }
            }
        });
    }
}

function delete_service_manpower(sales_serv_manpower_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/delete_service_manpower";
    $.ajax({
        data: 'sales_serv_manpower_id='+sales_serv_manpower_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_manpower'+count).remove();
            $('#subtotal3').load(loc+"sales/services_add_sales_head #subtotal3");
            $('#load_manpower'+count).load(loc+"sales/services_add_sales_head #load_manpower"+count+"");
        }
    });  
}

function manpower_append(){
    var manpower_id = document.getElementById("manpower").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/manpower_info";
    $.ajax({
        data: 'manpower_id='+manpower_id,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById("rate").value = response.rate;
        }
    });  
}

function manpower_total(){
    var days = document.getElementById("days").value;
    var rate = document.getElementById("rate").value;
    var overtime = document.getElementById("overtime").value;
    if(overtime!=''){
        var total = (parseFloat(days) * parseFloat(rate))+parseFloat(overtime);
    }else{
        var total = parseFloat(days) * parseFloat(rate);
    }
    document.getElementById("grandtotal").value  = parseFloat(total);
}

function save_service_equipment(){
    var data = $("#service_equipment").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_service_equipment";
    var total = loc+"sales/sum_equipment_price";
    var conf = confirm('Are you sure you want to save this equipment?');
    if(conf){
        $.ajax({
            type: "POST", // Post / Get method
            url: redirect, //Where form data is sent on submission
            data:data, //Form variables
            success:function(response){
                if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data5").append(response);
                    $.ajax({
                        type: "POST", 
                        url: total,
                        data:data,
                        success:function(output){
                            // var proc = window.opener.document.getElementById("temp_disp_rental");
                            // proc.style.display = "none";
                            window.opener.document.getElementById("subtotal4").innerHTML = output;
                            window.close();
                        }
                    });
                }
            }
        });
    }
}

function delete_service_equipment(sales_serv_equipment_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/delete_service_equipment";
    $.ajax({
        data: 'sales_serv_equipment_id='+sales_serv_equipment_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_equipment'+count).remove();
            $('#subtotal4').load(loc+"sales/services_add_sales_head #subtotal4");
            $('#load_equipment'+count).load(loc+"sales/services_add_sales_head #load_equipment"+count+"");
        }
    });  
}

function equipment_append(){
    var equipment_id = document.getElementById("equipment").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/equipment_info";
    $.ajax({
        data: 'equipment_id='+equipment_id,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById("rate").value = response.rate;
            document.getElementById("rate_solve").value = response.rate;
        }
    });  
}

function equipment_total(){
    var days = document.getElementById("days").value;
    var rate = document.getElementById("rate").value;
    var quantity = document.getElementById("quantity").value;
    var total = parseFloat(days) * parseFloat(rate) * parseFloat(quantity);
    if(days!=''){
        document.getElementById("grandtotal").value  = parseFloat(total);
    }else{
        ocument.getElementById("grandtotal").value  = 0;
    }
}

/*function rental_rate_total(){
    var quantity = document.getElementById("quantity").value;
    var rate = document.getElementById("rate_solve").value;
    var total = parseFloat(quantity) * parseFloat(rate);
    if(quantity!='' && rate!=''){
        document.getElementById("rate").value  = parseFloat(total);
    }else{
        document.getElementById("rate").value  = 0;
    }
}*/

function rate_select(){
    var equipment_id = document.getElementById("equipment").value;
    var rate_selection = document.getElementById("rate_selection").value;
    var quantity = document.getElementById("quantity").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/rate_selection";
    $.ajax({
        data: 'rate_selection='+rate_selection+'&equipment_id='+equipment_id+'&quantity='+quantity,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            if(response.rate_selection=='1'){
                document.getElementById("rate_display").innerHTML = "Days";
            }else{
                document.getElementById("rate_display").innerHTML = "Hours";
            }
            document.getElementById("rate").value = response.rate;
        }
    });  
}

function saveAllservice(){
    var data = $("#saveAllservice").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/save_services";
    var conf = confirm('Are you sure you want to save this Sales?');
    if(conf){
        $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            beforeSend: function(){
                document.getElementById('alert').innerHTML='<b>Please wait, Saving Data...</b>'; 
                $("#submit_services").hide(); 
            },
            success: function(output){
                window.location=loc+'sales/services_print_sales/'+output;  
            }
        }); 
    }    
}

function saveAR(){
    var ARdata = $("#saveAR").serialize();

    var loc= document.getElementById("baseurl").value;
    var sales_serv_head_id= document.getElementById("sales_serv_head_id").value;
    var redirect = loc+'sales/save_ar';
    if(confirm('Are you sure you want to save this?')){
        $.ajax({
            type: "POST",
            url: redirect,
            data: ARdata,
            success: function(output){
                //alert(output);
                window.location.href = loc+'sales/services_acknow_print/'+sales_serv_head_id;
            }
        });
    }
}

function exportSalesgood(){
    var loc= document.getElementById("baseurl").value;
    window.location = loc+'sales/export_salesgood/';
}

function exportSalesserv(){
    var loc= document.getElementById("baseurl").value;
    window.location = loc+'sales/export_salesserv/';
}

$(document).on("click", "#serviceno", function () {
     var sales_serv_head_id = $(this).attr("data-id");
     $("#sales_serv_head_id").val(sales_serv_head_id);

});

function saveServicenumber(){
    var data = $("#saveServicenumber").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/insert_servicenumber";
    var conf = confirm('Are you sure you want to save this Sales service report number?');
    if(conf){
        $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            success: function(output){
                window.location=loc+'sales/services_sales_list/';  
            }
        }); 
    }    
}

function releasedEmp(){
    var released_by = document.getElementById("released_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/release_change";
    $.ajax({
        data: "released_by="+released_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('released_position').innerHTML=response.position; 
        }
    });
}

function approvedEmp(){
    var approved_by = document.getElementById("approved_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/approve_change";
    $.ajax({
        data: "approved_by="+approved_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('approved_position').innerHTML=response.position; 
        }
    });
}

function notedEmp(){
    var noted_by = document.getElementById("noted_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/noted_change";
    $.ajax({
        data: "noted_by="+noted_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('noted_position').innerHTML=response.position; 
        }
    });
}

function checkedEmp(){
    var checked_by = document.getElementById("checked_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/checked_change";
    $.ajax({
        data: "checked_by="+checked_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('checked_position').innerHTML=response.position; 
        }
    });
}

function verifiedEmp(){
    var verified_by = document.getElementById("verified_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/verified_change";
    $.ajax({
        data: "verified_by="+verified_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('verified_position').innerHTML=response.position; 
        }
    });
}

function recommEmp(){
    var recomm_approval = document.getElementById("recomm_approval").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/recomm_change";
    $.ajax({
        data: "recomm_approval="+recomm_approval,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('recomm_position').innerHTML=response.position; 
        }
    });
}

function ackapprovedEmp(){
    var ack_approved_by = document.getElementById("ack_approved_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/ack_approved_change";
    $.ajax({
        data: "ack_approved_by="+ack_approved_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('ack_position').innerHTML=response.position; 
        }
    });
}

function printDeliverygoods(){
    var sign = $("#delivery_sign").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'sales/print_deliver_goods';
     $.ajax({
        type: "POST",
        url: redirect,
        data: sign,
        success: function(output){
            if(output=='success'){
                document.getElementById('changeTextrel').innerHTML=$("#released_by option:selected").text();
                $('#released_by').hide();
                document.getElementById('changeTextapp').innerHTML=$("#approved_by option:selected").text();
                $('#approved_by').hide();
                document.getElementById('changeTextnote').innerHTML=$("#noted_by option:selected").text();
                $('#noted_by').hide();
                window.print();
            }
        }
    });
}

function printDeliveryservices(){
    var sign = $("#serviceSign").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'sales/print_deliver_services';
     $.ajax({
        type: "POST",
        url: redirect,
        data: sign,
        success: function(output){
            if(output=='success'){
                document.getElementById('changeTextchk').innerHTML=$("#checked_by option:selected").text();
                $('#checked_by').hide();
                document.getElementById('changeTextapp').innerHTML=$("#approved_by option:selected").text();
                $('#approved_by').hide();
                document.getElementById('changeTextnote').innerHTML=$("#noted_by option:selected").text();
                $('#noted_by').hide();
                window.print();
            }
        }
    });
}

function printAcknowledge(){
    var sign = $("#ack_sign").serialize();
    var loc= document.getElementById("baseurl").value;
    var client_id= document.getElementById("client_id").value;
    var redirect = loc+'sales/print_acknow';
     $.ajax({
        type: "POST",
        url: redirect,
        data: sign,
        success: function(output){
            if(output=='success'){
                document.getElementById('changeTextverified').innerHTML=$("#verified_by option:selected").text();
                $('#verified_by').hide();
                document.getElementById('changeTextackapp').innerHTML=$("#ack_approved_by option:selected").text();
                $('#ack_approved_by').hide();
                if(client_id==1){
                    document.getElementById('changeTextrecomm').innerHTML=$("#recomm_approval option:selected").text();
                    $('#recomm_approval').hide();
                }
                window.print();
            }
        }
    });
}

function changeDRNoGoods(){
    var sales_date = document.getElementById("sales_date").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/goods_dr_series";
    $.ajax({
        data: 'sales_date='+sales_date,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
                document.getElementById("dr_no").value = response.dr_no;
        }
    });
}

function changeDRNoServices(){
    var sales_date = document.getElementById("sales_date").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales/services_dr_series";
    $.ajax({
        data: 'sales_date='+sales_date,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
                document.getElementById("dr_no").value = response.dr_no;
        }
    });
}