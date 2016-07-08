<script>
var step = "";
var title = "" ;
var articleContent = "" ;
var email = "" ;
var locationArticle = "" ;


function nextform(){
   	
	if($("#step1").hasClass("active")){step = 1;}
   	if($("#step2").hasClass("active")){step = 2;}
   	if($("#step3").hasClass("active")){step = 3;}
   	if($("#step4").hasClass("active")){step = 4;}
   	
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
   		
   		document.getElementById("mainDiv").scrollIntoView();
		
   	}
   	if( step == 2){
   		
   		$("#step2").removeClass("active");
   		$("#step3").addClass("active");
   		
   		$("#tab2").css("display" , "none");
   		$("#tab3").css("display" , "block");
   		
   		$("#tab2").removeClass("active");
   		$("#tab3").addClass("active");
   		
   		$("#successEmail").text("You have successed in email");
   		document.getElementById("mainDiv").scrollIntoView();
   		
   		$.ajax({
            url: "<?php echo URL::route('user.post.makeNew'); ?>",
            dataType : "json",
            type : "POST",
            data : { title: title ,
                     articleContent : articleContent ,
                     locationArticle : locationArticle ,
                	 email : email      
                },
            success : function(data) {
               if (data.result == 'success') {
            	   $("#imageForm").ajaxSubmit();
            	   		$("#postId").val(data.postId);
            	   		
               } else {
            	   
               }
            }
        });	
   		
   	}
   	if( step == 3){
   		
   		$("#step3").removeClass("active");
   		$("#step4").addClass("active");
   		
   		$("#tab3").css("display" , "none");
   		$("#tab4").css("display" , "block");
   		
		$("#tab3").removeClass("active");
   		$("#tab4").addClass("active");
   		
   		$("#gotoPage").text("go into the page");
   		document.getElementById("mainDiv").scrollIntoView();
   	}
   	
   	
}
function backform(){
	
	if($("#step1").hasClass("active")){step = 1;}
   	if($("#step2").hasClass("active")){step = 2;}
   	if($("#step3").hasClass("active")){step = 3;}
   	if($("#step4").hasClass("active")){step = 4;}
   	
   	if( step == 2){
   		$("#step2").removeClass("active");
   		$("#step1").addClass("active");
   		
   		$("#tab2").css("display" , "none");
   		$("#tab1").css("display" , "block");
   		
   		$("#tab2").removeClass("active");
   		$("#tab1").addClass("active");
   		
   		document.getElementById("mainDiv").scrollIntoView();
   	}
   	if( step == 3){
   		$("#step3").removeClass("active");
   		$("#step2").addClass("active");
   		$("#tab3").css("display" , "none");
   		$("#tab2").css("display" , "block");
   		
   		$("#tab3").removeClass("active");
   		$("#tab2").addClass("active");
   		
   		
   		document.getElementById("mainDiv").scrollIntoView();
   	}
   	if( step == 4){
   		$("#step4").removeClass("active");
   		$("#step3").addClass("active");
   		$("#tab4").css("display" , "none");
   		$("#tab3").css("display" , "block");
   		
   		$("#tab4").removeClass("active");
   		$("#tab3").addClass("active");
   		
   		
   		document.getElementById("mainDiv").scrollIntoView();
   	}
}
</script>