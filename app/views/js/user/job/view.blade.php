<script>

function changePattern(sel) {
	var title = sel.value;
	var description = sel.options[sel.selectedIndex].getAttribute('data-description');

	$(sel).parents('div#job-apply-div').eq(0).find('input#title').eq(0).val(title);
	$(sel).parents('div#job-apply-div').eq(0).find('textarea#description').eq(0).html(description);
}

function hideView(obj) {
	var target = "div#" + obj.getAttribute('data-target');
	
	$(obj).parents(target).eq(0).slideUp( "fast", function() {
		// Animation complete.
	});
}


function showView(obj) {
	var target = "div#" + obj.getAttribute('data-target');
	var userId = '<?php echo Session::get('user_id');?>';

	if (target == 'div#div_hint') {
		if (userId == '') {
			bootbox.alert('You have to login first.');
			return;
		}
	}
	
	$(document).find(target).eq(0).slideDown( "fast", function() {
		// Animation complete.
	});
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};


$("button#js-btn-review").click(function() {
    var companyId = $(this).attr('data-id');
    var description = $('textarea#rating-description').val();
    var score = $('input#input-rate').val();

    if (description == '') {
		bootbox.alert('Please leave a message.');
		return;
    }
    
    
    $.ajax({
        url: "{{ URL::route('user.company.async.addReview') }}",
        dataType : "json",
        type : "POST",
        data : {company_id : companyId, score : score, description : description},
        success : function(data) {
        	location.reload();
        }
    });
});



$('#msgModal').on('shown.bs.modal', function () {
    $('#txt_message').focus();
}); 

$("button#js-btn-open-message").click(function() {

	var userId = '<?php if (isset($userId)) { echo $userId;} else { echo '';} ?>';

	if (userId == '') {
		bootbox.alert('You have to login first.');
		return;
	}

	var super_target = "div#" + $(this).attr('super-data-target');

	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).modal();
	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).find("#txt_message").eq(0).val("");
	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).find("textarea#txt_message").eq(0).focus();
});


$("button#js-btn-send-message").click(function() {

	var jobId = $(this).attr('data-id');
    var message = $(this).parents('div#msgModal').eq(0).find('textarea#txt_message').eq(0).val();

    $.ajax({
        url:"{{ URL::route('user.job.async.sendMessage') }}",
        dataType : "json",
        type : "POST",
        data : {job_id : jobId, message : message},
        success : function(data){
        	bootbox.alert(data.msg);
        }
    });
    $("div#msgModal").modal('hide');        
});




$("a#js-btn-hint").click(function() {
    var jobId = $(this).attr('data-id');
    var name = '';
    var phonenumber = '';
    var email = '';
    var currentJob = '';
    var previousJobs = '';
    var description = '';
    var nameflag = '<?php echo $job->is_name; ?>';
    var phoneflag = '<?php echo $job->is_phonenumber; ?>';
    var emailflag = '<?php echo $job->is_email; ?>';
    var currentjobflag = '<?php echo $job->is_currentjob; ?>';
    var previousjobsflag = '<?php echo $job->is_previousjobs; ?>';
    var descriptionflag = '<?php echo $job->is_description; ?>';

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



$(document).ready(function() {
    $("button#js-btn-check-apply").click(function() {

        if ($("div#job-apply-div").hasClass('hidden')) {
	        var jobId = $(this).attr('data-id');
	        
	        $.ajax({
	            url: "{{ URL::route('user.job.async.checkApply') }}",
	            dataType : "json",
	            type : "POST",
	            data : {job_id : jobId},
	            success : function(data) {
	               if (data.result == 'success') {
	            	   $("div#job-apply-div").removeClass('hidden');
	               } else {
	                   bootbox.alert(data.msg, function() {
	                       if (data.code == 'CD01') {
	                           window.location.href = "{{ URL::route('user.auth.login') }}";
	                       }
	                   });
	               }
	            }
	        });
        }else {
        	$("div#job-apply-div").addClass('hidden');
        }
    });

    $("button#js-btn-apply").click(function() {
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
            	   bootbox.alert(data.msg);
            	   $("div#job-apply-div").addClass('hidden');
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
            	bootbox.alert(data.msg);
            }
        });
    });
});

</script>