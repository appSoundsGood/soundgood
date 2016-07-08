<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>

var selectedCount = 0;

/* add event for checkbox */
$("input#job_select_checkbox").change(function() {

	var jobId = $(this).attr('data-id');
	
    if(this.checked) {
        //Do stuff
    	selectedCount ++;
    }else {
    	selectedCount --;		
    }
});
/*  */

function changePattern(sel) {
	var title = sel.value;
	var description = sel.options[sel.selectedIndex].getAttribute('data-description');

	$(sel).parents('div#apply-div').eq(0).find('input#title').eq(0).val(title);
	$(sel).parents('div#apply-div').eq(0).find('textarea#description').eq(0).html(description);
}

function removeThisJob(obj) {
	var cartId = obj.getAttribute('data-id');
	
    bootbox.confirm("Are you sure?", function(result) {
        if (result) {
	        $.ajax({
	            url: "{{ URL::route('user.job.async.removeFromCart') }}",
	            dataType : "json",
	            type : "POST",
	            data : {cart_id : cartId},
	            success : function(data) {
	               if (data.result == 'success') {
	            	   location.reload();	
	               } else {
	            	   message = data.msg;
	            	   bootbox.alert(message);
	               }
	            }
	        });	
        }
    });
}


function checkAll() {
	$('input#job_select_checkbox').each(function() {

			var jobId = $(this).attr('data-id');

			if ($(this).attr('checked')) {
				$(this).removeAttr('checked');
				selectedCount --;
			}else {
				$(this).attr('checked', true);
				$(this).prop('checked', true);
				selectedCount ++;
			}
		});
}


$(document).ready(function () {
    $("button#js-btn-apply").click(function() {
        if ($("div#apply-div").hasClass('hidden')) {
            if (selectedCount > 0){
    			$("div#apply-div").removeClass('hidden');
            }else {
				bootbox.alert ('Please select at least one job.');
            }
        }else {
        	$("div#apply-div").addClass('hidden')
        }
    });	

    $("button#js-btn-submit").click(function() {
        var flag = 0;
        var message = '';

    	$('input#job_select_checkbox').each(function() {

        	if (this.checked) {
    			var jobId = $(this).attr('data-id');

    	        var name = $('input#title').val();
    	        var description = $('textarea#description').val();
    	        
    	        $.ajax({
    	            url: "{{ URL::route('user.job.async.apply') }}",
    	            dataType : "json",
    	            type : "POST",
    	            data : {job_id : jobId, name : name, description : description},
    	            success : function(data) {
    	               if (data.result == 'success') {
    		               
    	               } else {
    	            	   message = data.msg;
    	            	   flag = 1;
    	               }
    	            }
    	        });	
        	}
		});

		if (flag == 0) {
			bootbox.alert('Jobs are applied successfully.', function () {
				location.reload();
				});
		}else {
			bootbox.alert(message);
		}
    });	
});

</script>