<?php
	// Do a authentication check
	
	if(empty($_POST['channel'])) {
		die("INVALID QUERY: NO CHANNEL");
	}
	
	$Channel = $_POST['channel'];
	
	// Livestream META
		$LivestreamAuthor = "Callum Carmicheal";
		$LivestreamTitle = "Making this website, YOUR ON!";
		
	// Livestream Server
		$LServer = "rtmp://208.146.44.144/live/flv:";
		$LServer = $LServer. $Channel;
	
	// Password
	if(!empty($_POST['password'])) {
		$LServer = $LServer. "?viewerToken=";
		$LServer = $LServer. $_POST['password'];
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=($LivestreamAuthor. " - ". $LivestreamTitle)?></title>
		<link rel="stylesheet" type="text/css" href="css/streamStyle.css">
		<script src="http://content.jwplatform.com/libraries/AICYBCIu.js" type="text/javascript"></script>
		
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</head>
	
	<body style="overflow: hidden;">
		<!-- Header -->
		<div class="HeaderPanel"> 
			<div style="float:right; width: calc(100% - 725px);">
				<!-- Livestream Information -->
				<div style="float:left;">
					<div style="font-size: larger"><?=$LivestreamAuthor?></div>
					<div><?=$LivestreamTitle?></div>
				</div>
				
				<!-- Livestream Viewers -->
				<div style="float:right; text-align: right;">
					<div style="font-size: larger">VIEWERS</div>
					<div id="ViewerCount">Calculating</div>
				</div>
			</div>
		</div>
		
		<!-- Player -->
		<div class="JWPanelCenter">
			<div id="myElement">Loading the player ...</div>
			<script type="text/javascript">
				jwplayer("myElement").setup({
					file: "<?=$LServer?>",
					height: 405,
					width: 720
				});
			</script>
		</div>
		
		<script>
			// Live Users
			$(function() {
				console.log("Started Functions");
			
				// Start the timer
				// Resets at 10 secs, refreshes 5 secs
				getOnlineViewers();
				setTimeout(getOnlineViewers, 3000);
			});
			
			function getOnlineViewers() {
				console.log("Refreshing Viewers");
				// Get users
				$.get( "Engine/Livestreams/Viewers/countViewers.php?channel=<?=$Channel?>", function( data ) {
					console.log("Live Viewers: " + data);
					$('#ViewerCount').html(data);
				});
				
				setTimeout(getOnlineViewers, 3000);
			}
		</script>
	</body>
</html>