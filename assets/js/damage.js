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
                }
                document.getElementById("damage_id").value  = response;

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
            success: function(response){
              alert("Successfully saved!");
              location.reload(true);

            }

        });
           
    }
}

function check_rem_qty(count){
  var remaining_qty = $('select#transaction'+count+' option:selected').attr('mytag');
  var quantity= document.getElementById("qty"+count).value;
  if(quantity>remaining_qty){
    document.getElementById("savedamage").disabled = true;
    alert("Quantity requested exceeds available quantity!");
  }else{
    document.getElementById("savedamage").disabled = false;
  }
}