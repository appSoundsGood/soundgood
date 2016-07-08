

function clickY()
{
  var message = $("#messageText").val();
  var areaNew = $(".Area").eq(0).clone();
  areaNew.css("display" , "inline-block");
  areaNew.find(".textR").eq(0).text(message);
  $(".Area").eq($(".Area").length-2).after(areaNew);
  sendMessageClient();
}

	var socket = io.connect( 'http://localhost:8080/' );
	var senderId = "2";
 	var receiverId = "2";
 	var senderType = "3";
	var senderName = "4";
	var receiverName = "John";
	

	function sendMessageClient(){
	 	
	 	//var msg = $( "#messageInput" ).val();
	 	var msg = $("#messageText").val();
		var messageContent = senderId + "/" + receiverId + "/" + 	senderType + "/" + receiverName + "/" + senderName + "/" + msg;
		//chatRegister(receiverId , receiverName , senderId , senderName , senderType , msg)
		socket.emit( 'message', {  message: messageContent } );
	 	
	 	return false;
	 }

	socket.on( 'message', function( data ) {
			var messageArr = data.message.split("/");
	 	//if( messageArr[2] == "provider" && messageArr[0] == senderId){
	 		var content =  messageArr[5] ;
	 		var senderId = messageArr[0] ;

	 		var messageContent = senderName + " : " + content ;
	 		if(senderId != "2"){
	 			 var areaNew = $(".Area").eq(1).clone();
				areaNew.css("display" , "inline-block");
				areaNew.find(".textL").eq(0).text(messageContent);

				$(".Area").eq($(".Area").length-2).after(areaNew);
	 		}
	 
	 });