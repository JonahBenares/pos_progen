function loadBackorder(){
	var id= document.getElementById("pr_no").value;  	
	var loc= document.getElementById("baseurl").value;
	window.location.href = loc+'index.php/Back_order/backorder_form/'+id;

}

function changeQty(count){
   var cost = document.getElementById("item_cost"+count).value;
   var qty = document.getElementById("quantity"+count).value;
   var item_total = parseFloat(cost) * parseFloat(qty);
    document.getElementById("total_cost").innerHTML  =item_total;
}

function changePrice(count){
   var cost = document.getElementById("item_cost"+count).value;
   var qty = document.getElementById("quantity"+count).value;
   var item_total = parseFloat(cost) * parseFloat(qty);
    document.getElementById("total_cost").innerHTML  =item_total;
}

function saveBO(){
  
  var backorderdata = $("#backorder").serialize();
  var loc= document.getElementById("baseurl").value;
  var redirect = loc+'index.php/Back_order/saveBackorder';
  var conf = confirm('Are you sure you want to save this Back Order?');
        if(conf){
          $.ajax({
          data: backorderdata,
          type: "POST",
          url: redirect,
            beforeSend: function(){
                document.getElementById('alt').innerHTML='<b>Please wait, Saving Data...</b>'; 
                $("#savebutton").hide(); 
            },
          success: function(output){
            $('#savebutton').show();
            $('#alt').hide();
          window.open( loc+'index.php/Back_order/print_backorder/'+output,'_blank');
           
          }
        });
      }   
}