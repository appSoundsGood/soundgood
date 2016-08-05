<script>
function addItem(productId){
    $.ajax({
            url: "{{ URL::route('customer.addItem') }}",
            dataType : "json",
            type : "POST",
            data : {productId : productId},
            success : function(data) {
               if (data.result == 'success') {
            	   
               } else {
            	   
               }
            }
    });	
}
</script>