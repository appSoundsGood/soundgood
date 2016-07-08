<script>

function changePattern(sel) {
	var title = sel.value;
	var description = sel.options[sel.selectedIndex].getAttribute('data-description');

	$(sel).parents('div#div_apply').eq(0).find('input#title').eq(0).val(title);
	$(sel).parents('div#div_apply').eq(0).find('textarea#description').eq(0).html(description);
}

function hideView(obj) {
	var target = "div#" + obj.getAttribute('data-target');
	
	$(obj).parents(target).eq(0).slideUp( "fast", function() {
		// Animation complete.
	});
}

function showView(obj) {
	var target = "div#" + obj.getAttribute('data-target');

	if ($(obj).parents("div#div_job").eq(0).find(target).eq(0).css('display') == "none") {
	
		var other_target = "div#" + obj.getAttribute('other-target');
		var other_target_second = "div#" + obj.getAttribute('other-target-second');
		var other_target_third = "div#" + obj.getAttribute('other-target-third');
	
		var userId = '<?php echo Session::get('user_id');?>';
	
		if (target == 'div#div_hint' || target== 'div#div_apply') {
			if (userId == '') {
				bootbox.alert('You have to login first.');
				return;
			}
		}
		
		$(obj).parents("div#div_job").eq(0).find(target).eq(0).slideDown( "fast", function() {
			// Animation complete.
		});
		$(obj).parents("div#div_job").eq(0).find(other_target).eq(0).slideUp( "fast", function() {
			// Animation complete.
		});		
		$(obj).parents("div#div_job").eq(0).find(other_target_second).eq(0).slideUp( "fast", function() {
			// Animation complete.
		});
		$(obj).parents("div#div_job").eq(0).find(other_target_third).eq(0).slideUp( "fast", function() {
			// Animation complete.
		});
			
	}else {
		
		$(obj).parents("div#div_job").eq(0).find(target).eq(0).slideUp( "fast", function() {
			// Animation complete.
		});
	}
}


$("button#js-btn-apply").click(function() {
    var jobId = $(this).attr('data-id');
    var name = $(this).parents('div#div_apply').eq(0).find('input#title').eq(0).val();
    var description = $(this).parents('div#div_apply').eq(0).find('textarea#description').eq(0).val();

    if (name == "") {
		bootbox.alert("Please input the title");
		return;
   	}

   	if (description == "") {
		bootbox.alert("Please input the description");
		return;
   	}
    
    $.ajax({
        url: "{{ URL::route('user.job.async.apply') }}",
        dataType : "json",
        type : "POST",
        data : {job_id : jobId, name : name, description : description},
        success : function(data) {
           if (data.result == 'success') {
        	   bootbox.alert(data.msg, function() {
        		   location.reload();
            	   });
           } else {
        	   bootbox.alert(data.msg);
           }
        }
    });
});



$("button#js-btn-addToCart").click(function() {
    var jobId = $(this).attr('data-id');
    
    $.ajax({
        url: "{{ URL::route('user.job.async.addToCart') }}",
        dataType : "json",
        type : "POST",
        data : {job_id : jobId},
        success : function(data) {
            if (data.result == 'success') {
         	   bootbox.alert(data.msg, function() {
         		   location.reload();
             	   });
            } else {
         	   bootbox.alert(data.msg);
            }
        }
    });
});

$(function () {
	$('#datetimepicker5').datetimepicker({
		pickTime: false
	});
});

$('#category_select').on("change",function() {
	//Your code here
	$('#search_form').submit();
});

$('#type_select').on("change",function() {
	//Your code here
	$('#search_form').submit();
});



$("a#js-a-hint").click(function() {
    var jobId = $(this).attr('data-id');
    var name = '';
    var phonenumber = '';
    var email = '';
    var currentJob = '';
    var previousJobs = '';
    var description = '';

    if ($(this).parents('div#div_hint').find('input#is_name').eq(0) !== null) {
		nameflag = $(this).parents('div#div_hint').find('input#is_name').eq(0).val();
   	}
   	
    if ($(this).parents('div#div_hint').find('input#is_phonenumber').eq(0) !== null) {
    	phoneflag = $(this).parents('div#div_hint').find('input#is_phonenumber').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('input#is_email').eq(0) !== null) {
    	emailflag = $(this).parents('div#div_hint').find('input#is_email').eq(0).val();
   	}  

    if ($(this).parents('div#div_hint').find('input#is_currentjob').eq(0) !== null) {
    	currentjobflag = $(this).parents('div#div_hint').find('input#is_currentjob').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('input#is_previousjobs').eq(0) !== null) {
    	previousjobsflag = $(this).parents('div#div_hint').find('input#is_previousjobs').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('textarea#is_description').eq(0) !== null) {
    	descriptionflag = $(this).parents('div#div_hint').find('textarea#is_description').eq(0).val();
   	}
 
   	    

    if ($(this).parents('div#div_hint').find('input#name').eq(0) !== null) {
		name = $(this).parents('div#div_hint').find('input#name').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('input#phonenumber').eq(0) !== null) {
    	phonenumber = $(this).parents('div#div_hint').find('input#phonenumber').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('input#email').eq(0) !== null) {
    	email = $(this).parents('div#div_hint').find('input#email').eq(0).val();
   	}   	

    if ($(this).parents('div#div_hint').find('input#currentJob').eq(0) !== null) {
    	currentJob = $(this).parents('div#div_hint').find('input#currentJob').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('input#previousJobs').eq(0) !== null) {
    	previousJobs = $(this).parents('div#div_hint').find('input#previousJobs').eq(0).val();
   	}

    if ($(this).parents('div#div_hint').find('textarea#description').eq(0) !== null) {
    	description = $(this).parents('div#div_hint').find('textarea#description').eq(0).val();
   	}

   	if (name == '' && nameflag == '1') {
		bootbox.alert ('Please input the name.');
		return;
   	}

   	if (phonenumber == '' && phoneflag == '1') {
   		bootbox.alert ('Please input the phone number.');
   		return;
   	}

   	if (emailflag == '1') {
		if (!isValidEmailAddress(email)) {
	   		bootbox.alert ('Please input the valid email address.');
	   		return;
		}
   	}

   	if (currentJob == '' && currentjobflag == '1') {
   		bootbox.alert ('Please input the current job.');
   		return;
   	}

   	if (previousJobs == '' && previousjobsflag == '1') {
   		bootbox.alert ('Please input the previous jobs.');
   		return;
   	}

   	if (description == '' && descriptionflag == '1') {
   		bootbox.alert ('Please input the description.');
   		return;
   	}
   	    
    $.ajax({
        url: "{{ URL::route('user.job.async.addHint') }}",
        dataType : "json",
        type : "POST",
        data : {job_id : jobId, name : name, phonenumber: phonenumber, email: email, currentJob: currentJob, previousJobs: previousJobs, description: description},
        success : function(data) {
        	bootbox.alert(data.msg);
        }
    });
});


function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};



var objSlider;
$(document).ready(function() {
    $('#js-slider-waiting-time').slider({});
    
    objSlider = $('#js-slider-waiting-time').on('slide', function(obj) {
        $("div#js-div-range-waiting-min").text("$" + obj.value[0] + " : " + "$" + obj.value[1]);
        $("#js-waiting-time-min").val(obj.value[0]);
        $("#js-waiting-time-max").val(obj.value[1]);
    });
    
});
</script>