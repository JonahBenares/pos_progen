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
	window.location.href = loc+'returns/return_form/'+sales_good_head_id;

}

function saveReturn(){
	var returndata = $("#returnSave").serialize();
	var loc= document.getElementById("baseurl").value;
	var redirect = loc+'returns/save_return';
	$.ajax({
		type: "POST",
		url: redirect,
		data: returndata,
		success: function(output){
			window.location.href = loc+'returns/print_return/'+output;
		}
	});
}