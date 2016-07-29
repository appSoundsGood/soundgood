<script>
function follow(followerId){
   $.ajax({
      url: "<?php echo URL::route('user.follow'); ?>",
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
      url: "<?php echo URL::route('user.unfollow'); ?>",
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
</script>