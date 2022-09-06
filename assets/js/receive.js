
$('.addPR').click(function() {
    var loc= document.getElementById("baseurl").value;
    var conf = confirm('Are you sure you want to add another PR?');
    if(conf){

            var count = document.getElementById("count").value;
             count++;
           
            $('.customer_records').clone().appendTo('.customer_records_dynamic'+count);
            $('.customer_records_dynamic'+count+' .customer_records').addClass('single remove');
            //$('.single .extra-fields-customer').remove();
            //$('.single').append('<a href="" class=" remove-field btn-remove-customer btn btn-sm btn-inverse-secondary btn-block btn-round"><span class="mdi mdi-window-close"></span> Remove PR</a>');
            //$('.customer_records_dynamic'+count+' > .single').attr("class", "remove");
           

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

         $('.customer_records_dynamic'+count+' table').each(function() {

                var tableid = $(this).attr("id");
                var tib = tableid.slice(0, -1);
                $(this).attr('id', tib + count);

                $(this).find('tbody').each(function(){
                     $(this).attr('id', "append_data" + count);

                });

         });


         $('.customer_records_dynamic'+count+' .bttn').each(function() {

                var divid = $(this).attr("id");
                var sid = divid.slice(0, -1);

                $(this).attr('id', sid + count);


         });

          $('.customer_records_dynamic'+count+' .prcnt').each(function() {

                var spanid = $(this).attr("id");
                var spid = spanid.slice(0, -1);
                $(this).attr('id', spid + count);
                $("#"+spid+count).html("0"+count);
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
                    $('.single').append('<button onclick="remove_pr('+output+','+count+')" class=" remove-field btn-remove-customer btn btn-sm btn-inverse-secondary btn-block btn-round"><span class="mdi mdi-window-close"></span> Remove PR</button>');
                    $('.customer_records_dynamic'+count+' > .single').attr("class", "remove");
                    document.getElementById("rd_id"+count).value=output;
                    var loc= document.getElementById("baseurl").value;
                   
                    $("#append_data"+count).empty();
                    $("#myButton"+count).empty();
                    $("#myButton"+count).append('<button class="btn btn-gradient-primary btn-xs pull-right " onclick="add_receive_items(\''+loc+'\','+output+','+receive_id+','+count+')" name=""><span class="mdi mdi-plus"></span> Add Item</button>'); 
                  
                    /*$('.single').append('<a href="" onclick ='+removePR(loc, output)+' class=" remove-field btn-remove-customer btn btn-sm btn-inverse-secondary btn-block btn-round"><span class="mdi mdi-window-close"></span> Remove PR</a>');
                   $('.customer_records_dynamic'+count+' > .single').attr("class", "remove");*/
                }
          });

     
      /*  var rd_id= document.getElementById("rd_id"+count).value;
        alert(rd_id);*/
        

    }

  
});

function remove_pr(rd_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/removePR";
    $.ajax({
        data: 'rd_id='+rd_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('.customer_records_dynamic'+count).load(loc+"receive/add_receive_head .customer_records_dynamic"+count+"");
        }
    });  
}

/*$(document).on('click', '.remove-field', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});*/


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
                    document.getElementById('receive_date').readOnly = true;
                    document.getElementById('po_no').readOnly = true;
                    document.getElementById('dr_no').readOnly = true;
                    document.getElementById('si_no').readOnly = true;
                    document.getElementById('exampleTextarea1').readOnly = true;
                     $('#pcf').attr("disabled", true); 
                } else {
                    x.style.display = "none";
                    pr.style.display = "none";
                    proc.style.display = "block";
                    cancel.style.display = "none";
                }

                document.getElementById("receive_id").value  = response.receive_id;
                document.getElementById("rd_id1").value  = response.rd_id;
                $("#myButton1").append('<button class="btn btn-gradient-primary btn-xs pull-right " onclick="add_receive_items(\''+loc+'\','+response.rd_id+','+response.receive_id+','+1+')" ><span class="mdi mdi-plus"></span> Add Item</button>');
                $("#savebttn").append('<button class="btn btn-gradient-success btn-md" onclick="savePR(\''+loc+'\','+response.receive_id+')" >Save and Print</button>');  
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
function add_receive_items(baseurl,rd_id, receive_id, counter) {
    window.open(baseurl+"index.php/receive/add_receive_item/"+receive_id+"/"+rd_id+"/"+counter+"/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function save_item_receive(){
    var data = $("#receive_item").serialize();
    var counter = document.getElementById("counter").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/insert_items";
  
       $.ajax({
            type: "POST", 
            url: redirect, 
            data:data, 
            success:function(response){
               
                if (window.opener != null && !window.opener.closed) {
                    window.opener.$("#append_data"+counter).append(response); 
                }
                window.close();
            }
        });
}

function update_receive_items(baseurl) {
    window.open(baseurl+"index.php/receive/update_receive_item", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function removePR(loc, rdid){
    var redirect = loc+"receive/removePR"
    $.ajax({
        type: "POST", 
        url: redirect, 
        data:"rd_id="+rdid, 
      
    });
        
}

function savePR(loc, receive_id){
  var redirect = loc+"receive/savePR"
    var conf = confirm('Are you sure you want to save and print this transaction?');
        if(conf){
        $.ajax({
            type: "POST", 
            url: redirect, 
            data:"receive_id="+receive_id, 
              success:function(response){
                window.location.href = loc+"receive/print_receive/"+receive_id;
              }
          
        });
    }

}

function delete_receive_item(ri_id,count){
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/delete_item";
    $.ajax({
        data: 'ri_id='+ri_id,
        type: "POST",
        url: redirect,
        success: function(output){
            $('#load_data'+count).load(loc+"receive/add_receive_head #load_data"+count+"");
        }
    });  
}

function exportReceive(){
    var loc= document.getElementById("baseurl").value;
    window.location = loc+'receive/export_receive/';
}

function printReceive(){
    var sign = $("#receive_sign").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'receive/receive_print';
     $.ajax({
        type: "POST",
        url: redirect,
        data: sign,
        success: function(output){
            if(output=='success'){
                document.getElementById('changeTextdel').innerHTML=$("#delivered_by option:selected").text();
                $('#delivered_by').hide();
                document.getElementById('changeTextrec').innerHTML=$("#received_by option:selected").text();
                $('#received_by').hide();
                document.getElementById('changeTextack').innerHTML=$("#acknowledged_by option:selected").text();
                $('#acknowledged_by').hide();
                document.getElementById('changeTextnote').innerHTML=$("#noted_by option:selected").text();
                $('#noted_by').hide();
                window.print();
            }
        }
    });
}


function deliveredEmp(){
    var delivered_by = document.getElementById("delivered_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/delivered_change";
    $.ajax({
        data: "delivered_by="+delivered_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('delivered_position').innerHTML=response.position; 
        }
    });
}

function receivedEmp(){
    var received_by = document.getElementById("received_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/received_change";
    $.ajax({
        data: "received_by="+received_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('received_position').innerHTML=response.position; 
        }
    });
}

function acknowledgedEmp(){
    var acknowledged_by = document.getElementById("acknowledged_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/acknowledged_change";
    $.ajax({
        data: "acknowledged_by="+acknowledged_by,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
            document.getElementById('acknowledged_position').innerHTML=response.position; 
        }
    });
}

function notedEmp(){
    var noted_by = document.getElementById("noted_by").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"receive/noted_change";
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