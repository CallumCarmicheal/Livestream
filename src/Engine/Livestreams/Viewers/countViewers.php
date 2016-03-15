<?php
	include("common.code.php");
	
	if(isset($_GET['channel'])) {
		$State = "Channel";
		$Channel = $_GET['channel'];
	} else {
		$State = "Server";
		$Channel = "Global"; // -,-
	}
	
	$onlineUsers = countUsers(true, $State. ".". $Channel. ".VIEWS.bin");
	die("". $onlineUsers);
?>