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
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
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