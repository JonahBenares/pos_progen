function chooseSubcat()
{

   var loc= document.getElementById("baseurl").value;
   var redirect = loc+'index.php/items/getcategory';
    var subcat = document.getElementById("subcat").value;

      $.ajax({
            type: 'POST',
            url: redirect,
            data: 'subcat='+subcat,
            dataType: 'json',
            success: function(response){
              
               document.getElementById("category").innerHTML  = response.cat;
               document.getElementById("category_id").value  = response.catid;
               document.getElementById("pn").value  = response.pn;
               document.getElementById("pn_format").value  = 1;
           }
        }); 
}

$( document ).ready(function() {
  $("#item_name").blur(function(){
   var loc= document.getElementById("baseurl").value;
   var redirect = loc+'index.php/items/search';
       //alert(redirect);
      
        $.ajax({
        type: "POST",
        url: redirect,
        data:'itemname='+$(this).val()+'&type=item',
        success: function(output){
         
          if(output!=0) {
                $("#item-check").show();
                $("#item-check").html("Warning: Item name already exists!");
                $('input[type="button"]').attr('disabled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
            }
            else{
                $("#item-check").hide();
                $('input[type="button"]').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
            }
          
        }
        });
      });
});

/*$(document).ready(function(){
   
  $("#item_name").blur(function(){
   var loc= document.getElementById("baseurl").value;
   var redirect = loc+'index.php/items/search';
       //alert(redirect);
      
        $.ajax({
        type: "POST",
        url: redirect,
        data:'itemname='+$(this).val()+'&type=item',
        success: function(output){
         
          if(output!=0) {
                $("#item-check").show();
                $("#item-check").html("Warning: Item name already exists!");
                $('input[type="button"]').attr('disabled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
            }
            else{
                $("#item-check").hide();
                $('input[type="button"]').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
            }
          
        }
        });
      });


    $("#pn").keyup(function(){
      document.getElementById("pn_format").value  = 0;
    });

    $('#category').change(function(){
      var category = $(this).val();
      var loc= document.getElementById("baseurl").value;
      var redirect = loc+'index.php/items/getsubcat';
      // AJAX request
      $.ajax({
        url: redirect,
        method: 'post',
        data: {category: category},
        dataType: 'json',
        success: function(response){
          // Remove options 
          $('#subcat').find('option').not(':first').remove();
          // Add options
          $.each(response,function(index,data){
            $('#subcat').append('<option value="'+data['subcat_id']+'">'+data['subcat_name']+'</option>');
          });
        }
      });
    });
 });*/

/*function check_item(){
         var itemid = document.getElementById('item_id').value;
         var supplierid = document.getElementById('supplier').value;
         var catalog = document.getElementById('catalog').value;
         var brandid = document.getElementById('brandid').value;
         var brand = document.getElementById('brand').value;
         var cost = document.getElementById('ucost').value;

         if(supplierid==""){
            $("#supplier-check").show();
            $("#supplier-check").html("Warning: Supplier must not be empty!");
         } else if(catalog==""){
            $("#catalog-check").show();
            $("#supplier-check").hide();
            $("#catalog").focus();
            $("#catalog-check").html("Warning: Catalog number must not be empty!");
         } else if(brand==""){
            $("#brand-check").show();
            $("#catalog-check").hide();
            $("#brand").focus();
            $("#brand-check").html("Warning: Brand must not be empty!");
         } else {
            $.ajax({
            type: "POST",
            url: "../count_item",
            data:'item='+itemid+'&supplier='+supplierid+'&catalog='+catalog+'&brand='+brandid,
            success: function(data){
              if(data>0){
                alert("Error: Item with the same supplier, catalog number and brand is already existing!");
              } else {
                addItem(itemid, supplierid, catalog, brandid, brand,cost);
              }
            }
            });
         }
     };*/

   function selectItem(val) {
        $("#item_name").val(val);
        $("#suggestion-item").hide();
    }


function readPic1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#pic1').attr('src', e.target.result);

          };
        var size1 = input.files[0].size;
        if(size1 >= 6000000){
          $("#img1-check").show();
          $("#img1-check").html("Warning: Image too big. Upload images less than 5mb.");
          $('input[type="button"]').attr('disabled','disabled');
          $("#img2").attr('disabled','disabled');
          $("#img3").attr('disabled','disabled');
        } else {
           $("#img1-check").hide();
           $('input[type="button"]').removeAttr('disabled');
           $("#img2").removeAttr('disabled');
           $("#img3").removeAttr('disabled');
        }
          reader.readAsDataURL(input.files[0]);
        
      }
    }
    function readPic2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#pic2')
                  .attr('src', e.target.result);
          };
        var size2 = input.files[0].size;
        if(size2 >= 6000000){
          $("#img2-check").show();
          $("#img2-check").html("Warning: Image too big. Upload images less than 5mb.");
          $('input[type="button"]').attr('disabled','disabled');
          $("#img3").attr('disabled','disabled');
        } else {
           $("#img2-check").hide();
           $('input[type="button"]').removeAttr('disabled');
           $("#img3").removeAttr('disabled');
        }

          reader.readAsDataURL(input.files[0]);
      }
    }
    function readPic3(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#pic3')
                  .attr('src', e.target.result);
          };

          var size3 = input.files[0].size;
        if(size3 >= 6000000){
          $("#img3-check").show();
          $("#img3-check").html("Warning: Image too big. Upload images less than 5mb.");
          $('input[type="button"]').attr('disabled','disabled');
        } else {
           $("#img3-check").hide();
           $('input[type="button"]').removeAttr('disabled');
        }

          reader.readAsDataURL(input.files[0]);
      }
    }



 function saveItem(){

    var frm = new FormData();

    var subcat =document.getElementById('subcat').value;
    frm.append('subcat', subcat);

    var cat =document.getElementById('category_id').value;
    frm.append('cat', cat);

    var item_name =document.getElementById('item_name').value;
    frm.append('item_name', item_name);

    var group =document.getElementById('group').value;
    frm.append('group', group);

    var pn =document.getElementById('pn').value;
    frm.append('pn', pn);

    var location =document.getElementById('location').value;
    frm.append('location', location);

    var unit =document.getElementById('unit').value;
    frm.append('unit', unit);

    var bin =document.getElementById('bin').value;
    frm.append('bin', bin);

    var warehouse =document.getElementById('warehouse').value;
    frm.append('warehouse', warehouse);

    var rack =document.getElementById('rack').value;
    frm.append('rack', rack);

    var nkk_no =document.getElementById('nkk_no').value;
    frm.append('nkk_no', nkk_no);

    var semt_no =document.getElementById('semt_no').value;
    frm.append('semt_no', semt_no);

    var barcode =document.getElementById('barcode').value;
    frm.append('barcode', barcode);

    var weight =document.getElementById('weight').value;
    frm.append('weight', weight);

    var pnformat =document.getElementById('pn_format').value;
    frm.append('pnformat', pnformat);

    var selling_price =document.getElementById('selling_price').value;
    frm.append('selling_price', selling_price);

    var img1 = document.getElementById('img1');
    frm.append('img1', img1.files[0]);
  
    var img2 = document.getElementById('img2');
    frm.append('img2', img2.files[0]);

    var img3 = document.getElementById('img3');
    frm.append('img3', img3.files[0]);
  


    if(subcat==''){
      $("#subcat").focus();
            $("#subcat_msg").show();
            $("#subcat_msg").html("Error: Please choose sub category.");
    } else if(item_name==''){
      $("#item_name").focus();
            $("#item_msg").show();
            $("#item_msg").html("Error: Item name must not be empty.");
    } else if(pn==''){
      $("#pn").focus();
            $("#pn_msg").show();
            $("#pn_msg").html("Error: PN no. must not be empty.");
    } else {

       $.ajax({
            type: 'POST',
            url: "insert_item",
            data: frm,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                document.getElementById('alt').innerHTML='<b>Please wait, Saving Data...</b>'; 
                $("#next").hide(); 
            },
            success: function(output){
               var output= output.trim();
               if(output=='ext'){
                alert('Error: File extension error.')
               } else {
                alert('Item successfully Added!');
                window.location = 'item_list/'+output;
               }
           }
        }); 
    }
  }

  function saveChangesItem(){
    
    var frm = new FormData();

    var subcat =document.getElementById('subcat').value;
    frm.append('subcat', subcat);

    var cat =document.getElementById('category_id').value;
    frm.append('cat', cat);

    var item_name =document.getElementById('item_name').value;
    frm.append('item_name', item_name);

    var itemid =document.getElementById('itemid').value;
    frm.append('item_id', itemid);

    var group =document.getElementById('group').value;
    frm.append('group', group);

    var pn =document.getElementById('pn').value;
    frm.append('pn', pn);

    var location =document.getElementById('location').value;
    frm.append('location', location);

    var unit =document.getElementById('unit').value;
    frm.append('unit', unit);

    var bin =document.getElementById('bin').value;
    frm.append('bin', bin);

    var warehouse =document.getElementById('warehouse').value;
    frm.append('warehouse', warehouse);

    var rack =document.getElementById('rack').value;
    frm.append('rack', rack);

    var nkk_no =document.getElementById('nkk_no').value;
    frm.append('nkk_no', nkk_no);

    var semt_no =document.getElementById('semt_no').value;
    frm.append('semt_no', semt_no);

    var barcode =document.getElementById('barcode').value;
    frm.append('barcode', barcode);

    var weight =document.getElementById('weight').value;
    frm.append('weight', weight);

    var pnformat =document.getElementById('pn_format').value;
    frm.append('pnformat', pnformat);

    var img1 = document.getElementById('img1');
    frm.append('img1', img1.files[0]);
  
    var img2 = document.getElementById('img2');
    frm.append('img2', img2.files[0]);

    var img3 = document.getElementById('img3');
    frm.append('img3', img3.files[0]);
  


    if(subcat==''){
      $("#subcat").focus();
            $("#subcat_msg").show();
            $("#subcat_msg").html("Error: Please choose sub category.");
    } else if(item_name==''){
      $("#item_name").focus();
            $("#item_msg").show();
            $("#item_msg").html("Error: Item name must not be empty.");
    } else if(pn==''){
      $("#pn").focus();
            $("#pn_msg").show();
            $("#pn_msg").html("Error: PN no. must not be empty.");
    } else {

       $.ajax({
            type: 'POST',
            url: "../savechanges_item",
            data: frm,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                document.getElementById('alt').innerHTML='<b>Please wait, Saving Data...</b>'; 
                $("#next").hide(); 
            },
            success: function(output){
               var output= output.trim();
             //  alert(output);
          
               if(output=='ext'){
                alert('Error: File extension error.')
               } else {
                alert('Item successfully updated!');
                window.location = '../item_list/'+output;
               }
              
           }
        }); 
    }
  }

  function deleteImage(id, pic_no,baseurl){
    var redirect = baseurl+'index.php/items/deleteImage';
    if(confirm('Are you sure you want to delete?')){
     $.ajax({
            type: 'POST',
            url: redirect,
            data: 'id='+id+'&pic='+pic_no,
            success: function(output){
              window.location = baseurl+'index.php/items/update_item/'+output;
           }
        }); 
    }
  }

  function damage_item_export() {
    var loc= document.getElementById("baseurl").value;
    var redirect = loc+'index.php/damage/damage_item_export';
    window.open(redirect, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=450,width=450,height=350");
  }

function chooseCategory(){
    var loc= document.getElementById("baseurl").value;

    var redirect = loc+'index.php/items/getCat';
    var category = document.getElementById("category_exp").value;

    $.ajax({
            type: 'POST',
            url: redirect,
            data: 'category='+category,
            success: function(data){
               $("#subcat_exp").html(data);
               //alert(data);
              
           }
    }); 
}