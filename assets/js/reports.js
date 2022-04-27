function adjust_all(baseurl) {
    window.open(baseurl+"reports/adjust_all/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function filter_stockcard(){
    var item_id = document.getElementById("item_id").value;
    var loc= document.getElementById("baseurl").value;
    window.location.href = loc+"reports/stock_card/"+item_id;
}


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


$('#billedFilter').click(function(e){

    var client = document.getElementById("client").value;
    if(client==""){
        alert('Client must not be empty!');
    }  else {

         var loc= document.getElementById("baseurl").value;
        window.location.href = loc+"reports/billed_list/"+client;
    }
})

$('#paidFilter').click(function(e){

    var client = document.getElementById("client").value;
    if(client==""){
        alert('Client must not be empty!');
    }  else {

         var loc= document.getElementById("baseurl").value;
        window.location.href = loc+"reports/paid_list/"+client;
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

function filter_monthlyreports(){
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
    window.location.href = loc+"reports/monthly_report/"+month_url+'/'+client_id_url;
}

function filter_prreport(){
    var item = document.getElementById("item").value;
    var loc= document.getElementById("baseurl").value;
    window.location.href = loc+"reports/item_pr/"+item;
}

function loadPR(){
    var pr= document.getElementById("pr").value;     
    var loc= document.getElementById("baseurl").value;
    window.location.href = loc+'index.php/reports/overallpr_report/'+pr;

}

function loadSCGP(){
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    var client = document.getElementById("client").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/summary_scgp";
    if(from!=''){
        var from_url = from;
    }else{
        var from_url = 'null';
    }

    if(to!=''){
        var to_url = to;
    }else{
        var to_url = 'null';
    }

    if(client!=''){
        var client_url = client;

             window.location.href = loc+"reports/summary_scgp/"+from_url+"/"+to_url+"/"+client_url;

    }else{
        alert('Client must not be empty!');
    }
}


function bill_pay(baseurl){
    var client = document.getElementById("client_id").value;
    var conf = confirm('Are you sure you want to save to proceed?');
    if(conf){
        var values = [];
         $.each($("input[name='billing_id']:checked"), function(){
                values.push($(this).val());
        });
        var id=values.join();
        if(id==""){
            alert("You have not chosen any Billing Statement. Please choose at least one (1) Billing Statement to proceed.");
        } else {
            window.location.href = baseurl+"reports/bill_pay/"+encodeURIComponent(id);
           
       }
   }
}

function submit_payment(baseurl){

    var pdate = document.getElementById("payment_date").value;
    var amount = document.getElementById("amount").value;
    var payment_type = document.querySelector('input[name="payment_type"]:checked').value;
  
    var check_no = document.getElementById("check_no").value;
    var receipt_no = document.getElementById("receipt_no").value;
    var billing_id = document.getElementById("billing_id").value;
     var redirect = baseurl+"reports/submit_payment";
    var conf = confirm('Are you sure you want to save to proceed?');
    if(conf){
        if(pdate==""){
            alert("Payment date must not be empty.");
        } else if(amount==""){
            alert("Amount must not be empty.");
        } else {
            $.ajax({
                url:redirect,
                data: 'payment_date='+pdate+'&payment_type='+payment_type+'&check_no='+check_no+'&receipt_no='+receipt_no+'&amount='+amount+'&billing_id='+billing_id,
                type: "POST",
                success:function(output){
                     alert("Billing statement successfully paid!");
                     window.location.href = baseurl+"reports/paid_list";
                }
            })
        }
    }
}

function filter_rangereport(){
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    var category = document.getElementById("category").value;
    var subcat = document.getElementById("subcat").value;
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"reports/inventory_rangedate";
    if(from!=''){
        var from_url = from;
    }else{
        var from_url = 'null';
    }

    if(to!=''){
        var to_url = to;
    }else{
        var to_url = 'null';
    }

    if(category!=''){
        var category_url = category;
    }else{
        var category_url = 'null';
    }

     if(subcat!=''){
        var subcat_url = subcat;
    }else{
        var subcat_url = 'null';
    }
    window.location.href = loc+"reports/inventory_rangedate/"+from_url+"/"+to_url+"/"+category_url+"/"+subcat_url;
}


function chooseSubcat_range(){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'reports/get_subcat';
    var category = document.getElementById("category").value;
    $.ajax({
            type: 'POST',
            url: redirect,
            data: 'category='+category,
            success: function(data){
                $("#subcat").html(data);
           }
    }); 
}

function generateAdjustment(){
    var loc= document.getElementById("baseurl").value;
     var billing_id= document.getElementById("billing_id").value;
     var billing_no= document.getElementById("billing_no").value;
      var redirect = loc+'reports/generateAdjustment';
     var conf = confirm('Are you sure you want to generate adjustment form?');
    if(conf){
        $.ajax({
                type: 'POST',
                url:   redirect,
                data: "billing_id="+billing_id+"&billing_no="+billing_no,
                success: function(data){
                    window.location.href = loc+"reports/adjustment_print/"+data;
               }
        }); 
    }   
}