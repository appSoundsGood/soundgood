<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
var step = "";
var title = "" ;
var articleContent = "" ;
var email = "" ;
var locationArticle = "" ;


function nextform(){
   	
	if($("#step1").hasClass("active"))
		step = 1;
	else if($("#step2").hasClass("active"))
		step = 2;
   	
   	if( step == 1){
   		
   		$("#step1").removeClass("active");
   		$("#step2").addClass("active");
   		$("#tab1").css("display" , "none");
   		$("#tab2").css("display" , "block");
   		
   		$("#tab1").removeClass("active");
   		$("#tab2").addClass("active");

   		title = $("#title").val() ;
   		articleContent = $(".note-editable").html() ;
   		locationArticle = $("#location").val() ;
   		email = $("#email").val() ;
   		
   		$("#titlePreview").text(title);
   		$("#previewArticle").html(articleContent);
   		$("#locationPreview").text(locationArticle);
   		$("#emailPreview").text(email);

   		$('.button-submit').show();
   		
   		document.getElementById("mainDiv").scrollIntoView();
		
   	}
   	/*else if( step == 2){
   		
   		$("#step2").removeClass("active");
   		$("#step3").addClass("active");
   		
   		$("#tab2").css("display" , "none");
   		$("#tab3").css("display" , "block");
   		
   		$("#tab2").removeClass("active");
   		$("#tab3").addClass("active");
   		
   		$("#successEmail").text("You have created new advertisment");
   		document.getElementById("mainDiv").scrollIntoView();

   	}*/
}
function backform(){
	
	if($("#step1").hasClass("active")){step = 1;}
   	if($("#step2").hasClass("active")){step = 2;}

   	if (step == 1) {
   	   	// go to list
   	}
   	else if( step == 2){
   		$("#step2").removeClass("active");
   		$("#step1").addClass("active");
   		
   		$("#tab2").css("display" , "none");
   		$("#tab1").css("display" , "block");
   		
   		$("#tab2").removeClass("active");
   		$("#tab1").addClass("active");

   		$('.button-submit').hide();
   		
   		document.getElementById("mainDiv").scrollIntoView();
   	}
   	else if( step == 3){
   		$("#step3").removeClass("active");
   		$("#step2").addClass("active");
   		$("#tab3").css("display" , "none");
   		$("#tab2").css("display" , "block");
   		
   		$("#tab3").removeClass("active");
   		$("#tab2").addClass("active");
   		
   		
   		document.getElementById("mainDiv").scrollIntoView();
   	}
   	
}

$(function() {
	$('.select2').select2();
	$('.datepicker').datepicker({
		format: 'mm/dd/yy',
	});

	$('input[name="image"]').change(function() {
		var input = this;
		
		if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#preview-image').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	});
});
</script>