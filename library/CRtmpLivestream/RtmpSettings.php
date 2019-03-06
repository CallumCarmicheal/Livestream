<?php
/**
 * Created by PhpStorm.
 * User: callu
 * Date: 05/03/2019
 * Time: 21:54
 */

namespace CRtmpLivestream;

class RtmpSettings
{
	/**
	 * @var bool
	 */
	public $requestMethodIsPost = false;

	/**
	 * This is the server string
	 *
	 * @var string
	 */
	public $rtmpServer = "rtmp://localhost/live/flv:";

	/**
	 * This is a list of all accepted hosts for the server
	 * by default the localhost ip address is added.
	 *
	 * @var array
	 */
	public $acceptedServerHosts = ['127.0.0.1', '::1'];

	/**
	 * The Event Handler
	 * @var IRtmpEventHandler|null
	 */
	public $eventHandler = null;
}