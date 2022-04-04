$('#filter').click(function(e){
    var item_id = document.getElementById("item_id").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/stock_card";
    $.ajax({
        url:redirect,
        data: 'item_id='+item_id,
        type: "POST",
        success:function(output){
             window.location.href = loc+"reports/stock_card/"+item_id;
        }
    })
})

<<<<<<< HEAD
$('#pendingFilter').click(function(e){

    var client = document.getElementById("client").value;
    var type = document.getElementById("type").value;
    if(client=="" || type==""){
        alert('Client/Type must not be empty!');
    }  else {

        var type= document.getElementById("type").value;
         var loc= document.getElementById("baseurl").value;
        window.location.href = loc+"reports/pending_list/"+client+"/"+type;
    }
})

function bill_pending(baseurl){
    
   var client = document.getElementById("client_id").value;
   var salestype = document.getElementById("salestype").value;
   
    var values = [];
     $.each($("input[name='sales_id']:checked"), function(){
            values.push($(this).val());
    });
    var id=values.join();
    if(id==""){
        alert("You have not chosen any DR. Please choose at least one (1) DR to proceed.");
    } else {
        window.open(baseurl+"reports/pending_popup/"+encodeURIComponent(id)+"/"+client+"/"+salestype, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
   }
    
}

function save_billing(){
    var data = $("#bs_table").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/save_billing_statement";
    var conf = confirm('Are you sure you want to save to proceed?');
    if(conf){
         $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            success: function(output){
             parent.window.opener.location="../../../print_billing/"+output; 
             window.close();
                
            }

        });
           
    }
}
=======
$('#filter_sales').click(function(e){
    var month = document.getElementById("month").value;
    if(month!=''){
        var month_url = document.getElementById("month").value;
    }else{
        var month_url = 'null';
    }
    var client_id = document.getElementById("client_id").value;
    if(client_id!=''){
        var client_id_url = document.getElementById("client_id").value;
    }else{
        var client_id_url = 'null';
    }
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/monthly_report";
    $.ajax({
        url:redirect,
        data: 'month='+month+'&client_id='+client_id,
        type: "POST",
        success:function(output){
             window.location.href = loc+"reports/monthly_report/"+month_url+'/'+client_id_url;
        }
    })
})

$('#filter_itpr').click(function(e){
    var item = document.getElementById("item").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/item_pr";
    $.ajax({
        url:redirect,
        data: 'item_id='+item,
        type: "POST",
        success:function(output){
             window.location.href = loc+"reports/item_pr/"+item;
        }
    })
})
>>>>>>> 71683a60f948eef05a1da3d94c8603f492c68dd4
