<!DOCTYPE html>
<html>
<head>
	<title>WebSocket CLient</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</head>
<body>

	<div class="messages">
		
	</div>
	<input type="text" id="send-msg" />
	<button id="send-msg-btn">Send</button>

	<script>
		$(function(){
			let conn = new WebSocket("ws://localhost:8080");

			function sendPacket(data)
			{
				conn.send(data);
			}

			conn.onopen = function(){
				console.log("connected to server");
			}

			conn.onmessage = function(msg){
				msg = msg.data;
				console.log(`received ${msg}`);
				$(".messages").append(`<p>Anonymous : ${msg}</p>`);
			}

			conn.onclose = function(){
				alert('Disconnected from the server.')
				console.log('Disconnected from the server.')
			}

			$(document).on('click', '#send-msg-btn', function(){
				let value = $("#send-msg").val();
				sendPacket(value);
				$("#send-msg").val("");
			})
		})
	</script>

</body>
</html>