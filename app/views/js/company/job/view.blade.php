<script>

function hideView(obj) {
	var target = "div#" + obj.getAttribute('data-target');
	
	$(obj).parents(target).eq(0).slideUp( "fast", function() {
		// Animation complete.
	});
}

function showView(obj) {
	var target = "div#" + obj.getAttribute('data-target');
	var super_target = "div#" + obj.getAttribute('super-data-target');
	var other_target = "div#" + obj.getAttribute('other-data-target');

	if (super_target == "div#div_apply" && target == "div#div_proposal") {
		var applyId = obj.getAttribute('data-id');
	    $.ajax({
	        url: "{{ URL::route('company.user.async.updateStatus') }}",
	        dataType : "json",
	        type : "POST",
	        data : {apply_id : applyId},
	        success : function(data) {
	        }
	    });		
	}
	
	$(obj).parents(super_target).eq(0).find(target).eq(0).slideDown( "fast", function() {
		// Animation complete.
	});

	$(obj).parents(super_target).eq(0).find(other_target).eq(0).slideUp( "fast", function() {
		// Animation complete.
	});		
}


$("a#js-btn-notes").click(function() {
    var applyId = $(this).attr('data-id');
    var notes = $(this).parents('div#div_notes').eq(0).find('textarea#notes').eq(0).val();
    
    $.ajax({
        url: "{{ URL::route('company.job.async.saveNotes') }}",
        dataType : "json",
        type : "POST",
        data : {apply_id : applyId, notes : notes},
        success : function(data) {
        	bootbox.alert(data.msg);
        }
    });
});

$("a#js-btn-hint-notes").click(function() {
    var hintId = $(this).attr('data-id');
    var notes = $(this).parents('div#div_notes').eq(0).find('textarea#notes').eq(0).val();
    
    $.ajax({
        url: "{{ URL::route('company.job.async.saveHintNotes') }}",
        dataType : "json",
        type : "POST",
        data : {hint_id : hintId, notes : notes},
        success : function(data) {
        	bootbox.alert(data.msg);
        }
    });
});


$('#msgModal').on('shown.bs.modal', function () {
    $('#txt_message').focus();
}); 



$("button#js-btn-open-message").click(function() {

	var super_target = "div#" + $(this).attr('super-data-target');

	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).modal();
	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).find("#txt_message").eq(0).val("");
	$(this).parents(super_target).eq(0).find('div#msgModal').eq(0).find("textarea#txt_message").eq(0).focus();
});


$("button#js-btn-send-message").click(function() {

	var applyId = $(this).attr('data-id');
    var message = $(this).parents('div#msgModal').eq(0).find('textarea#txt_message').eq(0).val();

    $.ajax({
        url:"{{ URL::route('company.job.async.sendMessage') }}",
        dataType : "json",
        type : "POST",
        data : {apply_id : applyId, message : message},
        success : function(data){
        }
    });
    $("div#msgModal").modal('hide');        
});


$("button#js-btn-send-message-hint").click(function() {

	var hintId = $(this).attr('data-id');
    var message = $(this).parents('div#msgModal').eq(0).find('textarea#txt_message').eq(0).val();

    $.ajax({
        url:"{{ URL::route('company.job.async.sendHintMessage') }}",
        dataType : "json",
        type : "POST",
        data : {hint_id : hintId, message : message},
        success : function(data){
        }
    });
    $("div#msgModal").modal('hide');        
});



</script>