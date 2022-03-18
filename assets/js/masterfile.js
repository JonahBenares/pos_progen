function updateBin(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_bin/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateBuyer(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_buyer/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateDepartment(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_department/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateEmployee(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_employee/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateEquipment(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_equipment/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateGroup(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_group/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateCategory(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_category/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateLocation(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_location/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateManpower(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_manpower/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updatePurpose(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_purpose/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateRack(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_rack/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function AddSub(baseurl,cat_id){
    window.open(baseurl+"index.php/masterfile/view_cat/"+cat_id, "_blank", 'top=100px,left=400px,width=600,height=400');
}

function updateSupplier(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_supplier/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateUnit(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_uom/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function updateWarehouse(baseurl,id) {
    window.open(baseurl+"index.php/masterfile/update_warehouse/"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=350,width=700,height=600");
}

function confirmationDelete(anchor){
	   var conf = confirm('Are you sure you want to delete this record?');
	   if(conf)
	   window.location=anchor.attr("href");
}


