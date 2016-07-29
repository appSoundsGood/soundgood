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
</script>