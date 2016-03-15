<?php
	use Livestream\Engine\Authentication;
	use Livestream\Engine\Debugging;
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 'on');

	include("Debugging/Logger.php");
	include("Authentication/Authentication.php");
	include("Authentication/Livestream.php");

	define("Log_Calls", false);
	
	if(!isset($log)) {
		$log = new Debugging\Logger();
		$log->LogCallsIF(Log_Calls, "onLivestream");
	}
	
	function LogTxt($txt) {
		if(!isset($log)) {
			$log = new Debugging\Logger();
			$log->LogCallsIF(Log_Calls, "onLivestream");
		}
		
		$log->LogText("debug.output", "Module.onLivestream", true, "Authentication Request -> ". $txt, true);
	}
	
	if(empty($_POST['streamToken']))  	{
		LogTxt("Invalid Query (No Stream Token)");
		
		header(LS_AUTHENTICATION_HEADER);
		die(LS_AUTHENTICATION_QUERY_INCORRECT);
	}
	
	// Get the token
	$token = $_POST['streamToken'];
	
	// Check if the token is L3G1T
	$user = new Authentication\Livestream($token);
	LogTxt("Token '". $token. "' <- ". $user->AuthenticationToString());
	$user->Execute();
?>