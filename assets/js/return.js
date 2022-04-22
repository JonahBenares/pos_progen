function dr_append(){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'returns/dr_append';
    var sales_good_head_id = document.getElementById("dr_no").value;
    $.ajax({
        type: 'POST',
        url: redirect,
        data: 'sales_good_head_id='+sales_good_head_id,
        dataType: 'json',
        success: function(response){
            $("#sales_good_head_id").val(response.sales_good_head_id);
        }
    }); 
}

function loadReturn(){
	var sales_good_head_id= document.getElementById("sales_good_head_id").value;	
	var loc= document.getElementById("baseurl").value;
	$("#myTdable").show();
	window.location.href = loc+'returns/return_goods/'+sales_good_head_id;

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
				window.location.href = loc+'returns/print_return_goods/'+output;
			}
		});
	}
}

function check_return_qty(count){
  var total_qty= document.getElementById("qty"+count).value;
  var quantity= document.getElementById("retqty"+count).value;
  var damqty= document.getElementById("damqty"+count).value;
  var qty = parseInt(quantity) + parseInt(damqty);
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