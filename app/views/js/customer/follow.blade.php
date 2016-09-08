<script>
function follow(followerId){
   $.ajax({
      url: "<?php echo URL::route('customer.follow'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
             followerId : followerId 
          },
      success : function(data) {
         $("#followButton").css("display" , "none");
         $("#unfollowButton").css("display" , "block");

      }
   });
}

function searchRecipe(){
  var recipeName = $("#recipeFilter").val();
  if(recipeName != ""){
    $("#recipeButton").click();
  }
}
function unfollow(followerId){
      $.ajax({
      url: "<?php echo URL::route('customer.unfollow'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
             followerId : followerId 
          },
      success : function(data) {
         $("#followButton").css("display" , "block");
         $("#unfollowButton").css("display" , "none");
         
      }
   });
}  
function like(recipeId , ownerId){
      $.ajax({
      url: "<?php echo URL::route('customer.like'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
             recipeId : recipeId ,
             ownerId : ownerId 
          },
      success : function(data) {
         $("#likeButton" + recipeId).css("display","none");
         $("#unlikeButton" + recipeId).css("display","block");
         location.href = "/customer/recipe"  
      }
   });
} 
function unlike(recipeId , ownerId){
    $.ajax({
      url: "<?php echo URL::route('customer.unlike'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
              recipeId : recipeId ,
              ownerId : ownerId 
          },
      success : function(data) {
         $("#likeButton" + recipeId).css("display","block");
         $("#unlikeButton" + recipeId).css("display","none");
         
      }
   });
} 
function likeRecipe(userId , recipeId){
  
  $.ajax({
      url: "<?php echo URL::route('customer.likeRecipe'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
              userId : userId ,
              recipeId : recipeId 
          },
      success : function(data) {
         $("#unlikeRecipe").css("display","block");
         $("#likeRecipe").css("display","none");
      }
   });
}
function unlikeRecipe(userId , recipeId){
  
  $.ajax({
      url: "<?php echo URL::route('customer.unlikeRecipe'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
              userId : userId ,
              recipeId : recipeId 
          },
      success : function(data) {
        $("#unlikeRecipe").css("display","none");
        $("#likeRecipe").css("display","block");
         
      }
   });
}

function cookRecipe(userId, recipeId) {
	$.ajax({
	      url: "<?php echo URL::route('customer.cookRecipe'); ?>",
	      dataType : "json",
	      type : "POST",
	      data : { 
	              userId : userId ,
	              recipeId : recipeId 
	          },
	      success : function(data) {
	      		         
	      }
	   });
}
</script>