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
            const myArray = output.split("-");
            var sales = myArray[0];
            var type = myArray[1];
            $('#savebutton').show();
            $('#alt').hide();
            if(type=='Goods'){
                 window.location.href = loc+'index.php/sales_backorder/backorder_form/';
                window.open( loc+'index.php/sales_backorder/print_backorder_goods/'+sales+'/'+type,'_blank');
            }else if(type=='Services'){
                window.location.href = loc+'index.php/sales_backorder/backorder_form/';
                window.open( loc+'index.php/sales_backorder/print_backorder_services/'+sales+'/'+type,'_blank');
            }
           
          }
        });
      }
    }  

function releasedEmp(){
    var released_by = document.getElementById("released_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"sales_backorder/release_change";
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
    var redirect = loc+"sales_backorder/approve_change";
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
    var redirect = loc+"sales_backorder/noted_change";
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
    var redirect = loc+"sales_backorder/checked_change";
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

function printBackorderGoods(){
    var sign = $("#goods_sign").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'sales_backorder/save_backorder_goods';
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

function printBackorderServices(){
    var sign = $("#service_sign").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'sales_backorder/save_backorder_services';
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