<?php
if(isset($_POST['content'])) {
	file_put_contents('data.txt', date('H:i').' : '.$_POST['content']."\n", FILE_APPEND );
}

if(isset($_GET['getContent'])) {
	$content = file_get_contents('data.txt');
	echo nl2br($content);
	exit();
}

$content = file_get_contents('data.txt');

?>
<!doctype html>
<html>
<head>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  
  
<link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>
html {
  height: 100%;
}
body {
  min-height: 100%;
  background-color:#CCC;
  position: relative;
  margin:0;
  overflow: hidden;
}

#chat {
	min-width: 500px;
	background-color:#FFF;
	font-family: sans-serif;
	font-size: 40px;
}

input {
	font-size: 100px;
}
</style>


</head>

<body>

<div style="height:100%">
	<div id="chat" style="border: solid 1px; width: 100%; max-height: 500px; overflow: auto">
		<?php echo nl2br($content);?>
	</div>
		
	<div>
		<form id="chatForm" method="post">
			<input style="width:calc(100% - 170px)" name="content" id="content"/>
			<input type="submit" value="OK" style="50px"/>
		</form>
	</div>
</div>
<script>
document.getElementById('content').focus();
</script>

<script>

$('#chatForm').submit(function() {
	$.ajax({
		url: '?',
		method: 'post',
		data: {
			'content': $('#content').val()
		},
		success: function(data) {
			$('#content').val('');
			//console.debug('ici');
		}
	});	
	
	return false;
});

setInterval(function() {
	
	$.ajax({
		url: '?getContent=1',
		success: function(data) {
			$('#chat').html(data);
			var objDiv = document.getElementById("chat");
			objDiv.scrollTop = objDiv.scrollHeight;
		}
	});
	
}, 500);
</script>

</body>
</html>