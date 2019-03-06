<?php
/**
 * Created by PhpStorm.
 * User: callu
 * Date: 05/03/2019
 * Time: 22:38
 */

use CRtmpLivestream\IRtmpEventHandler;

class EventHandler extends IRtmpEventHandler
{
	public function onConnect($addr, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl)
	{
		return true;
	}

	public function onPublish($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name, $type)
	{
		return true;
	}

	public function onDone($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name)
	{
		$iAm = "Done?";
		return true;
	}

	public function onPublishUpdate($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name)
	{
		return true;
	}
}