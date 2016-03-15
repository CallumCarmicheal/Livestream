<?php
	if(empty($_POST['channel'])) 
		die("No post data found!");
	
	$channel = $_POST['channel'];
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/streamStyle.css">
	</head>
	<body>
		<form action="livestream.php" class="inputbox" method="post">
		  	<div style="font-family: monospace;top: -40px;position: relative;">
		  		<center>Please enter the password for #<?=$channel?></center>
		  	</div>
		  	
		  	<div style="font-family: monospace;top: -40px;position: relative;">
		  		<center>Leave blank if no password is Required</center>
		  	</div>
			
			
			<input name="channel" type="hidden" value="<?=$channel?>">
		  	<input name="password"/>
		  
		  	<button type="reset" class="del"></button>
		</form>
	</body>
</html>