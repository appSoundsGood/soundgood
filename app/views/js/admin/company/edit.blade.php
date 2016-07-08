<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


<script>
var map;
var myLatLng;
var marker;
var services = [];


<?php
	$i = 0; 
    foreach ($services as $service) {?>
    	services[<?php echo $i++;?>] = {
    	    	label: '<?php echo $service->name;?>',
    	    	value: '<?php echo $service->name?>',
    	    	desc: '<?php echo $service->icon_code?>',
    	    	serviceId: <?php echo $service->id?>
    	};
<?php } ?>

<?php 
	foreach ($companyServices as $companyService) {?>
		onAddService('<?php echo $companyService->service->name;?>', '<?php echo $companyService->service->icon_code;?>', '<?php echo $companyService->service->id;?>', '<?php echo substr(json_encode($companyService->description), 1, strlen(json_encode($companyService->description)) - 2);?>')
<?php }?>


$(".is_published").change(function() {
    if(this.checked) {
        //Do stuff
        $("input.is_published").val(1);
    }else {
    	$("input.is_published").val(0);
    }
});


$(document).ready(function() {

	var lat = '<?php echo $company->lat?>';
	var lng = '<?php echo $company->long?>';

	lat = lat * 1.0;
	lng = lng * 1.0; 

	var opts = {'center': new google.maps.LatLng(lat, lng), 'zoom':11, 'mapTypeId': google.maps.MapTypeId.ROADMAP } 
	map = new google.maps.Map(document.getElementById('mapdiv'),opts); 

	google.maps.event.addListener(map,'click',function(event) { 
 		document.getElementById('latlng').value = event.latLng.lat() + ', ' + event.latLng.lng();
 		document.getElementById('lat').value = event.latLng.lat();
 		document.getElementById('lng').value = event.latLng.lng();
 		myLatLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
 		if (marker) {
 			marker.setMap(null);
 		}
 		marker = new google.maps.Marker({position:myLatLng});
 		marker.setMap(map); 
	}) 
	
	google.maps.event.addListener(map,'mousemove',function(event) { 
	});	
	
	myLatLng = new google.maps.LatLng(lat, lng);
 	if (marker) {
 		marker.setMap(null);
 	}
 	marker = new google.maps.Marker({position:myLatLng});
 	marker.setMap(map);	
	
});

function onAddService(name, code, id, des) {
	var objClone = $("div#clone_div_service").clone().removeClass('hidden');
	objClone.attr("id", "service_item");
	objClone.find("input#service_name").val(name);
	objClone.find("input#icon_code").val(code);
	objClone.find("input#service_id").val(id);
	objClone.find("textarea#service_description").html(des);
 	objClone.find("input#service_name").autocomplete({
 	 	source: services,
 	 	focus: function(event, ui) {
 	 			objClone.find("input#service_name").val(ui.item.label);	
 	 	 	},
 	 	select: function (event, ui) {
				objClone.find("input#icon_code").val(ui.item.desc);	
				objClone.find("input#service_id").val(ui.item.serviceId);
 	 	 	}
 		});
	$("div#service_list").eq(0).append(objClone);
}

function onDeleteService(obj) {
	$(obj).parents('div#service_item').eq(0).remove();
}

</script>