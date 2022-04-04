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