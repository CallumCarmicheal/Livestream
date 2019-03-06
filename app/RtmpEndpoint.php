<?php
/**
 * Created by PhpStorm.
 * User: callu
 * Date: 05/03/2019
 * Time: 22:38
 */

require_once "loader.php";
require_once "EventHandler.php";

$rtmpSettings = new \CRtmpLivestream\RtmpSettings();
$rtmpSettings->eventHandler = new EventHandler();
$rtmpHandler = new \CRtmpLivestream\RtmpHandler($rtmpSettings);


if ($rtmpHandler->IsAllowedHost())
	/** Process Request */
	$rtmpHandler->Process();

echo "THIS IS NOT A RTMP REQUEST?";