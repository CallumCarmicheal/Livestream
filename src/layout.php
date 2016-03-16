<?php
	$Channel = "test";
	// Livestream META
		$LivestreamAuthor = "Callum Carmicheal";
		$LivestreamTitle = "Making this website, YOUR ON!";
	// Livestream Server
		$LServer = "rtmp://208.146.44.144/live/flv:";
		$LServer = $LServer. $Channel;
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=($LivestreamAuthor. " - ". $LivestreamTitle)?></title>
		<link rel="stylesheet" type="text/css" href="css/streamStyle.css">
		<script src="http://content.jwplatform.com/libraries/AICYBCIu.js" type="text/javascript"></script>
		
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		
		<style>
			.DescriptionaryStuff {
				clear: both;
				position: relative;
				top: calc(95px - 100%);
				height: calc(100% - 424px);
				width: 720px;
				background: #381862;
			}
			
			.ChattyStuff {
				position: relative;
				left: 430px;
				top: -345px;
				height: calc(100% - 70px);
				width: calc(100% - 300px);
				float: right;
				background: #381862;
			}
		</style>
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
		
		<div>
			<div style="float:left; width: 720px">
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
			</div>
		</div>
		
		<div class="ChattyStuff">
				<!-- Chat -->
				Chatty stuff
		</div>
		
		<div class="DescriptionaryStuff">
			<!-- Description and Other Stuff? -->
			Descriptiony Stuffy stuff
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