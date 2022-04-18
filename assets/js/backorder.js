function loadBackorder(){
	var id= document.getElementById("pr_no").value;  	
	var loc= document.getElementById("baseurl").value;
	window.location.href = loc+'index.php/Back_order/backorder_form/'+id;

}

function changeQty(count){
   var cost = document.getElementById("item_cost"+count).value;
   var qty = document.getElementById("quantity"+count).value;
   var avail_qty= document.getElementById("avail_qty"+count).value;
  if (parseInt(qty) > parseInt(avail_qty)){
    document.getElementById("savebutton").disabled = true;
    alert("Quantity encoded exceeds backorder quantity!");
  }else{
    document.getElementById("savebutton").disabled = false;
  }

   var item_total = parseFloat(cost) * parseFloat(qty);
  document.getElementById("total_cost"+count).innerHTML  =item_total;
}

function changePrice(count){
   var cost = document.getElementById("item_cost"+count).value;
   var qty = document.getElementById("quantity"+count).value;
   var item_total = parseFloat(cost) * parseFloat(qty);
    document.getElementById("total_cost").innerHTML  =item_total;
}

function saveBO(){
  var receive_date = document.getElementById("receive_date").value;
  var po_no = document.getElementById("po_no").value;
  var dr_no = document.getElementById("dr_no").value;
  var si_no = document.getElementById("si_no").value;
  if(receive_date==""){
      alert('Received Date must not be empty!');
  }  else if (po_no==""){
      alert('PO No must not be empty!');
  }  else if (dr_no==""){
      alert('DR No must not be empty!');
  }  else if (si_no==""){
      alert('SI/OR No must not be empty!');
  }  else {
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
}

function check_backroder_qty(count){
  var avail_qty= document.getElementById("avail_qty"+count).value;
  var quantity= document.getElementById("quantity"+count).value;
  if (parseInt(quantity) >parseInt(avail_qty)){
    document.getElementById("savebutton").disabled = true;
    alert("Quantity encoded exceeds backorder quantity!");
  }else{
    document.getElementById("savebutton").disabled = false;
  }
}