function clickX()
{
  var message = $("#messageText").val();
  var areaNew = $(".Area").eq(1).clone();
  areaNew.css("display" , "inline-block");
  areaNew.find(".textL").eq(0).text(message);
  $(".Area").eq($(".Area").length-2).after(areaNew);
  sendMessage();
}
	
	var socket = io.connect( 'http://localhost:8080/' );
	var providerId = "1";
 	var consumerId = "2";
 	var senderType = "3";
	var consumerName = "4";
	var providerName = "Jason";
	

	function sendMessage(){
	 	
	 	//var msg = $( "#messageInput" ).val();
	 	var msg = $("#messageText").val();
		var messageContent = providerId + "/" + consumerId + "/" + 	senderType + "/" + consumerName + "/" + providerName + "/" + msg;
		//chatRegister(consumerId , consumerName , providerId , providerName , senderType , msg)
		
	 	socket.emit( 'message', {  message: messageContent } );
	 	
	 	return false;
	 }

	 socket.on( 'message', function( data ) {
			var messageArr = data.message.split("/");
	 	//if( messageArr[2] == "provider" && messageArr[0] == providerId){
	 		var content =  messageArr[5] ;
	 		var providerId = messageArr[0] ;

	 		var messageContent = providerName + " : " + content ;
	 		if(providerId != "1"){
	 			

				 var areaNew = $(".Area").eq(0).clone();
				  areaNew.css("display" , "inline-block");
				  areaNew.find(".textR").eq(0).text(messageContent);
				  $(".Area").eq($(".Area").length-2).after(areaNew);
	 		}
	 
	 });


 