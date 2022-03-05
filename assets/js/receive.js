
$('.addPR').click(function() {

    var conf = confirm('Are you sure you want to add another PR?');
    if(conf){

            var count = document.getElementById("count").value;
             count++;
           
            $('.customer_records').clone().appendTo('.customer_records_dynamic'+count);
            $('.customer_records_dynamic'+count+' .customer_records').addClass('single remove');
            $('.single .extra-fields-customer').remove();
            $('.single').append('<a href="" class=" remove-field btn-remove-customer btn btn-sm btn-inverse-secondary btn-block btn-round"><span class="mdi mdi-window-close"></span> Remove PR</a>');
            $('.customer_records_dynamic'+count+' > .single').attr("class", "remove");

            $('.customer_records_dynamic'+count+' input').each(function() {
             
                var fieldname = $(this).attr("name");
                var fieldid = $(this).attr("id");
                var field = fieldname.slice(0, -1);
                var fid = fieldid.slice(0, -1);
                $(this).attr('name', field + count);
                $(this).attr('id', fid + count);
                document.getElementById(fid + count).value = "";
               
              });

           $('.customer_records_dynamic'+count+' select').each(function() {
              
                var fieldname = $(this).attr("name");
                var fieldid = $(this).attr("id");
                var field = fieldname.slice(0, -1);
                var fid = fieldid.slice(0, -1);
                $(this).attr('name', field + count);
                $(this).attr('id', fid + count);
                document.getElementById(fid + count).value = "";
                
              
              });
         
           document.getElementById("count").value = count;

           var receive_id= document.getElementById("receive_id").value;
         
           var loc= document.getElementById("baseurl").value;
           var redirect = loc+"receive/add_another_pr";
            $.ajax({
                data: "receive_id="+receive_id,
                type: "POST",
                url: redirect,
                success: function(output){
                      
                    document.getElementById("rd_id"+count).value=output;
                  
                }
          });

    }

  
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
                document.getElementById("rd_id1").value  = response.rd_id;
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

/*$('.updateDetails').blur(function() {*/
function updateDetails(thisfield, thisid){
    
    var pos = thisid.slice(-1);
    var field_name = thisid.slice(0, -1);
    var receive_id = document.getElementById("receive_id").value; 
    var rd_id = document.getElementById("rd_id"+pos).value; 
   

   var loc= document.getElementById("baseurl").value;
   var redirect = loc+"receive/update_receive_details";
    $.ajax({
            data: "rd_id="+rd_id+"&val="+thisfield+"&field="+field_name,
            type: "POST",
            url: redirect,
            success: function(response){
                  
               
            }
        });
/*});*/
}

/*$('.updateDetailsDD').change(function() {*/
function updateDetailsDD(thisfield, thisid){
  
    var pos = thisid.slice(-1);
     var field_name = thisid.slice(0, -1);
    var rd_id = document.getElementById("rd_id"+pos).value; 
    var val = this.value;
  

   var loc= document.getElementById("baseurl").value;
   var redirect = loc+"receive/update_receive_details";
    $.ajax({
            data: "rd_id="+rd_id+"&val="+thisfield+"&field="+field_name,
            type: "POST",
            url: redirect,
            success: function(output){
                
               
        }
    });
}
/*});
*/
function add_receive_items(baseurl) {
    window.open(baseurl+"index.php/receive/add_receive_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function update_receive_items(baseurl) {
    window.open(baseurl+"index.php/receive/update_receive_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}