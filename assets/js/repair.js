function confirmationRepair(anchor){
    var conf = confirm('Are you sure you want to tag this as repair?');
    if(conf)
    window.location=anchor.attr("href");
}

function redirect_repair(){
	var data = $("#redirect").serialize();
	var loc= document.getElementById("baseurl").value;
    var redirect = loc+"repair/insert_redirect";
    var conf = confirm('Are you sure you want to tag this as repair?');
    if(conf){
	    $.ajax({
	        data: data,
	        type: "POST",
	        url: redirect,
	        success: function(output){
	        	window.location=loc+'repair/repair_form/'+output;  
	        }
	    }); 
    }
}

function InsertRepair(){
	var data = $("#InsertRepair").serialize();
	var loc= document.getElementById("baseurl").value;
    var redirect = loc+"repair/insert_repair";
    var conf = confirm('Are you sure you want to save this record?');
    if(conf){
	    $.ajax({
	        data: data,
	        type: "POST",
	        url: redirect,
	        success: function(output){
	        	//alert(output);
	        	window.location=loc+'repair/repair_item';  
	        }
	    }); 
    }
}

function isNumberKey(evt, obj) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

function check_repair_qty(count){
  var avail_qty= document.getElementById("avail_qty"+count).value;
  var quantity= document.getElementById("repqty"+count).value;
  if (parseInt(quantity) >parseInt(avail_qty)){
    document.getElementById("saved").disabled = true;
    alert("Quantity encoded exceeds damaged quantity!");
  }else{
    document.getElementById("saved").disabled = false;
  }
}

function assessment_repair(option,count){
     var newpn = document.getElementById("new_pn"+count);
     alert(count);
    if(option=='1'){
        newpn.style.display = "block";
    } else {
        newpn.style.display = "none";
    }
}