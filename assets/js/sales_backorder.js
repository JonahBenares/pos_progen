function dr_append(){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'sales_backorder/dr_append';
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

function loadSalesBO(){
    var sales_id= document.getElementById("sales_id").value;    
    var transaction_type= document.getElementById("transaction_type").value;    
    var loc= document.getElementById("baseurl").value;
    $("#myTdable").show();
    window.location.href = loc+'sales_backorder/backorder_form/'+sales_id+'/'+transaction_type;

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
    document.getElementById("total_cost"+count).value  =item_total;
}

function saveSalesBO(){
  var backorderdata = $("#sales_bo").serialize();
  var loc= document.getElementById("baseurl").value;
  var redirect = loc+'index.php/sales_backorder/saveBackorder';
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
            window.location.href = loc+'index.php/sales_backorder/backorder_form/';
          window.open( loc+'index.php/sales_backorder/print_backorder/'+output,'_blank');
          }
        });
      }
    }   