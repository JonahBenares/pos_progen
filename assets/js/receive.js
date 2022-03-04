
$('.addPR').click(function() {
 
    $('.customer_records').clone().appendTo('.customer_records_dynamic');
    $('.customer_records_dynamic .customer_records').addClass('single remove');
    $('.single .extra-fields-customer').remove();
    // $('.single').append('<a href="#" class="remove-field btn-remove-customer">Remove Fields</a>');
    $('.customer_records_dynamic > .single').attr("class", "remove");

    $('.customer_records_dynamic input').each(function() {
        var count =2;
        var fieldname = $(this).attr("name");
        var field = fieldname.slice(0, -1);
        $(this).attr('name', field + count);
        count++;
      });

  /*  $('.customer_records_dynamic select').each(function() {
       var count =2;
        var fieldname = $(this).attr("name");
        var field = fieldname.slice(0, -1);
        $(this).attr('name', field + count);
         count++;
      
      });
  */
});

$(document).on('click', '.remove-field', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});


function proceed(){
       
    var data = $("#receiveHead").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/add_receive_head_process";
    var conf = confirm('Are you sure you want to proceed?');
    if(conf){
          $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){
                  
                var x = document.getElementById("myDIV");
                var pr = document.getElementById("PRDiv");
                var proc = document.getElementById("proc");
                var cancel = document.getElementById("cancel");
                if (x.style.display === "none" && pr.style.display === "none" ) {
                    x.style.display = "block";
                    pr.style.display = "block";
                    proc.style.display = "none";
                    cancel.style.display = "block";
                } else {
                    x.style.display = "none";
                    pr.style.display = "none";
                    proc.style.display = "block";
                    cancel.style.display = "none";
                }

                document.getElementById("receive_id").value  = response.receive_id;
            }
        });

         
    }

}

function cancel_receive(){
    var id = document.getElementById("receive_id").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/cancel_receive";
    var conf = confirm('Are you sure you want to cancel receive transaction?');
    if(conf){
          $.ajax({
            data: "id="+id,
            type: "POST",
            url: redirect,
            success: function(response){
                  
                location.reload(true);
            }
        });

         
    }

}

function updateDetails(val){
   var id = document.getElementById("receive_id").value; 
   var loc= document.getElementById("baseurl").value;
   var redirect = loc+"receive/update_receive_details";
    $.ajax({
            data: "id="+id+"&val="+val,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){
                  
                var x = document.getElementById("myDIV");
                var pr = document.getElementById("PRDiv");
                if (x.style.display === "none" && pr.style.display === "none" ) {
                    x.style.display = "block";
                    pr.style.display = "block";
                } else {
                    x.style.display = "none";
                    pr.style.display = "none";
                }

                document.getElementById("receive_id").value  = response.receive_id;
            }
        });
}
 

function add_receive_items(baseurl) {
    window.open(baseurl+"index.php/receive/add_receive_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function update_receive_items(baseurl) {
    window.open(baseurl+"index.php/receive/update_receive_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}