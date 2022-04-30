function add_transaction(){
    var loc= document.getElementById("baseurl").value;
    var count=document.getElementById("count").value;
    var item=document.getElementById("item").value;

   var nc = parseInt(count)+1;
    var redirect = loc+"damage/add_transaction";
    $.ajax({
        data: "item_id="+item+"&count="+nc,
        type: "POST",
        url: redirect,
        success: function(output){
             document.getElementById("count").value = nc;
             $("#damage").append(output); 
         }
      });
             
}

function delete_damage_item(count){
    var loc= document.getElementById("baseurl").value;
    $('#load_data'+count).remove();
    document.getElementById("count").value=0;
    $('#load_data'+count).load(loc+"damage/damage_item #load_data"+count+"");
}

function canceled_damage(){
    var id = document.getElementById("damage_id").value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"damage/cancel_damage";
    var conf = confirm('Are you sure you want to cancel this damage transaction?');
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

function loadTransactions() {
    var x = document.getElementById("loadTransactions");
    var data = $("#damageHead").serialize();
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"damage/add_damage";
    var conf = confirm('Are you sure you want to save to proceed?');
    if(conf){
         $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            dataType: "json",
            success: function(response){
                var cancel = document.getElementById("cancel_damage");
                var proceed_damage = document.getElementById("proceed_damage");
                if (x.style.display === "block") {
                    x.style.display = "none";
                    cancel.style.display = "none";
                    proceed_damage.style.display = "none";
                } else {
                    x.style.display = "block";
                    cancel.style.display = "block";
                    proceed_damage.style.display = "none";
                    document.getElementById('pdr_no').readOnly = true;
                    document.getElementById('damage_date').readOnly = true;
                    $('#item').attr("disabled", true); 
                    document.getElementById('reported_by').readOnly = true;
                    document.getElementById('reported_date').readOnly = true;
                    $('#accounted_to').attr("disabled", true); 
                    $('#person_using').attr("disabled", true); 
                    document.getElementById('damage_description').readOnly = true;
                    document.getElementById('damage_reason').readOnly = true;
                    $('#inspected_by').attr("disabled", true); 
                    document.getElementById('date_inspected').readOnly = true;
                    document.getElementById('recommendation').readOnly = true;
                    $('#prepared_by').attr("disabled", true); 
                    $('#checked_by').attr("disabled", true); 
                    $('#noted_by').attr("disabled", true); 
                    document.getElementById('notes').readOnly = true;
                }
                document.getElementById("damage_id").value  = response.damage_id;
                document.getElementById("item_id").value  = response.item_id;

            }

        });
           
    }
}

function saveDamage(){
    var data = $("#damageDetails").serialize();

    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"damage/save_damage";
    var conf = confirm('Are you sure you want to save to this transaction?');
   
     if(conf){
         $.ajax({
            data: data,
            type: "POST",
            url: redirect,
            success: function(output){
               // alert(output);
              alert("Successfully saved!");
              window.location=loc+'damage/damage_print/'+output;
              //location.reload(true);

            }

        });
           
    }
}

function check_rem_qty(count){
    var remaining_qty = $('select#transaction'+count+' option:selected').attr('mytag');
    var quantity= document.getElementById("qty"+count).value;
    var item_cost= document.getElementById("total_cost"+count).value;
    var total_cost = parseFloat(quantity) * parseFloat(item_cost);
    if (parseInt(quantity) >parseInt(remaining_qty)){
        document.getElementById("savedamage").disabled = true;
        alert("Quantity encoded exceeds available quantity!");
    }else{
        document.getElementById("savedamage").disabled = false;
        document.getElementById("item_cost"+count).value = total_cost;
    }
}

function get_damitem_value(count){
    var in_id = document.getElementById("transaction"+count).value; 
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+"damage/itemdam_info";
    $.ajax({
        data: "in_id="+in_id,
        type: "POST",
        url: redirect,
        dataType: "json",
        success: function(response){
<<<<<<< HEAD
            /*document.getElementById("qty"+count).value = response.qty;*/
=======
            document.getElementById("qty"+count).value = 1;
>>>>>>> 2c39420951350a1ce1dd3e953152f8dc89770d6d
            document.getElementById("brand"+count).value = response.brand;
            document.getElementById("serial_no"+count).value = response.serial_no;
            document.getElementById("original_pn"+count).value = response.original_pn;
            document.getElementById("receive_date"+count).value = response.receive_date;
            document.getElementById("item_cost"+count).value = response.item_cost;
            document.getElementById("total_cost"+count).value = response.total_cost;
        }
    });
}


