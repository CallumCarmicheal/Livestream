<?php
/**
 * Created by PhpStorm.
 * User: callu
 * Date: 05/03/2019
 * Time: 21:56
 */

namespace CRtmpLivestream;

class IRtmpEventHandler {
	protected $handler = null;
	public function setHandler($h) { $this->handler = $h; }

	/**
	 * Event is invoked when the on_connect event has been fired by RTMP
	 *  This is fired when the client first connects (viewer)
	 *
	 * @see https://github.com/arut/nginx-rtmp-module/wiki/Directives#on_connect
	 *
	 * @param $addr string          Client IP address
	 * @param $app string           Application name
	 * @param $flashVer string      Client flash version
	 * @param $swfUrl string        Client swf url
	 * @param $tcUrl string
	 * @param $pageUrl string       Client page url
	 * @return bool                 States if event is accepted
	 */
	public function onConnect($addr, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl) {
		return true;
	}

	/**
	 * Event is invoked when a viewer starts to watch a stream
	 *
	 *
	 * @see https://github.com/arut/nginx-rtmp-module/wiki/Directives#on_play
	 *
	 * @param $addr string          Client IP address
	 * @param $clientid string      Nginx client id (displayed in log and stat)
	 * @param $app string           Application name
	 * @param $flashVer string      Client flash version
	 * @param $swfUrl string        Client swf url
	 * @param $tcUrl string
	 * @param $pageUrl string       Client page url
	 * @param $name string          Stream name
	 * @return bool                 States if event is accepted
	 */
	public function onPlay($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name) {
		return true;
	}


	public function onPlayDone() {
		return true;
	}

	/**
	 * Terminated ? from onUpdate ?
	 *
	 * @param $addr string          Client IP address
	 * @param $clientid string      Nginx client id (displayed in log and stat)
	 * @param $app string           Application name
	 * @param $flashVer string      Client flash version
	 * @param $swfUrl string        Client swf url
	 * @param $tcUrl string
	 * @param $pageUrl string       Client page url
	 * @param $name string          Stream name
	 * @return bool                 States if event is accepted
	 */
	public function onDone($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name) {
		return true;
	}

	/**
	 * User has started streaming
	 *
	 * @param $addr
	 * @param $clientid
	 * @param $app
	 * @param $flashVer
	 * @param $swfUrl
	 * @param $tcUrl
	 * @param $pageUrl
	 * @param $name
	 * @param $type
	 * @return bool
	 */
	public function onPublish($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name, $type) {
		return true;
	}

	/**
	 * Just like publish but every x seconds defined as notify_update_timeout
	 *    this would be used to terminate a stream
	 * @return bool
	 */
	public function onPublishUpdate($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name) {
		return true;
	}

	/**
	 * User is done streaming
	 *
	 * @param $addr
	 * @param $clientid
	 * @param $app
	 * @param $flashVer
	 * @param $swfUrl
	 * @param $tcUrl
	 * @param $pageUrl
	 * @param $name
	 * @return bool
	 */
	public function onPublishDone($addr, $clientid, $app, $flashVer, $swfUrl, $tcUrl, $pageUrl, $name) {
		return true;
	}


	/**
	 * TODO: Figure out how to invoke
	 *
	 * @return bool
	 */
	public function onRecordDone() {
		return true;
	}



}