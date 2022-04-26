function dr_append(){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'returns/dr_append';
    var sales_id = document.getElementById("dr_no").value;
    var transaction_type = $('select#dr_no option:selected').attr('mytag');
    $.ajax({
        type: 'POST',
        url: redirect,
        data: 'sales_id='+sales_id+'&transaction_type='+transaction_type,
        dataType: 'json',
        success: function(response){
            $("#sales_id").val(response.sales_id);
            $("#transaction_type").val(transaction_type);
        }
    }); 
}

function loadReturn(){
    var sales_id= document.getElementById("sales_id").value;    
	var transaction_type= document.getElementById("transaction_type").value;	
	var loc= document.getElementById("baseurl").value;
	$("#myTdable").show();
	window.location.href = loc+'returns/return_goods_services/'+sales_id+'/'+transaction_type;

}

function saveReturn(){
	var returndata = $("#returnSave").serialize();

	var loc= document.getElementById("baseurl").value;
	var redirect = loc+'returns/save_return';
	if(confirm('Are you sure you want to return items?')){
		$.ajax({
			type: "POST",
			url: redirect,
			data: returndata,
			success: function(output){
				//alert(output);
				window.location.href = loc+'returns/print_return_goods_services/'+output;
			}
		});
	}
}

function check_return_qty(count){
    var total_qty= document.getElementById("qty"+count).value;
    var quantity= document.getElementById("retqty"+count).value;
    var damqty= document.getElementById("damqty"+count).value;
    if(quantity!='' && damqty!=''){
        var qty = parseInt(quantity) + parseInt(damqty);
    }else if(quantity=='' && damqty!=''){
        var qty = parseInt(damqty);
    }else if(quantity!='' && damqty==''){
        var qty = parseInt(quantity);
    }

    if (parseInt(qty) > parseInt(total_qty)){
        document.getElementById("savedata").disabled = true;
        alert("Quantity to be returned exceeds quantity bought!");
    }else{
        document.getElementById("savedata").disabled = false;
    }
}

function dr_append_service(){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'returns/dr_append_service';
    var sales_serv_head_id = document.getElementById("dr_no").value;
    $.ajax({
        type: 'POST',
        url: redirect,
        data: 'sales_serv_head_id='+sales_serv_head_id,
        dataType: 'json',
        success: function(response){
            $("#sales_serv_head_id").val(response.sales_serv_head_id);
        }
    }); 
}

function loadReturnserve(){
    var sales_serv_head_id= document.getElementById("sales_serv_head_id").value;  
    var loc= document.getElementById("baseurl").value;
    $("#myTdable").show();
    window.location.href = loc+'returns/return_services/'+sales_serv_head_id;
}

function saveReturnserve(){
    var returndata = $("#returnserveSave").serialize();

    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'returns/save_return_services';
    if(confirm('Are you sure you want to return items?')){
        $.ajax({
            type: "POST",
            url: redirect,
            data: returndata,
            success: function(output){
                //alert(output);
                window.location.href = loc+'returns/print_return_services/'+output;
            }
        });
    }
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

function saveReturnDamage(){
    var returndata = $("#ReturnDamage").serialize();


    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"returns/save_return_damage";
    if(confirm('Are you sure you want to save this record?')){
        $.ajax({
            type: "POST",
            url: redirect,
            data: returndata,
            success: function(output){
                //alert(output);
                window.location.href = loc+'returns/return_damage_print/'+output;  
            }
        }); 
    }
}  
