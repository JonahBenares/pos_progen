function pending_popup(baseurl) {
    window.open(baseurl+"reports/pending_popup", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

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