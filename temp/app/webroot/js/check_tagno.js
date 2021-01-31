$(document).ready(function() {
	    $("#SystemDetailTagNo").focusout(function() {

	        var tagNo = $("#SystemDetailTagNo").val();
	        $.post("/Inventory/SystemDetails/exists", {data:{SystemDetail:{tag_no:tagNo}}}, function(data) {
	            if (data == 1) {
                       alert("Tag No. already exists");
	            }

	                });
	        });

                 $("#SystemDetailSerialNo").focusout(function() {

	        var serialNo = $("#SystemDetailSerialNo").val();
	        $.post("/Inventory/SystemDetails/exists", {data:{SystemDetail:{serial_no:serialNo}}}, function(data) {
	            if (data == 1) {
                      alert("Serial No. already exists");
	            }

	                });
	        });
	});
