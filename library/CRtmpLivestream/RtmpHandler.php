<?php 

namespace CRtmpLivestream;
	
class RtmpHandler {
	/**
	 * @var RtmpSettings|null
	 */
	protected $settings = null;

	/**
	 * RtmpHandler constructor.
	 * @param $settings RtmpSettings
	 */
	public function __construct($settings) {
		$this->settings = $settings;
	}

	/**
	 * Checks if this is a accepted rtmp host
	 * @return bool
	 */
	public function IsAllowedHost() {
		var_dump($_SERVER['REMOTE_ADDR']);

		return (in_array($_SERVER['REMOTE_ADDR'], $this->settings->acceptedServerHosts));
	}

	public function Process() {
		$state = $this->Invoke();

		ob_clean();
		http_response_code($state ? 200 : 500);
		exit;
	}

	public function Invoke() {
		$data = $this->settings->requestMethodIsPost ? $_POST : $_GET;

		if (!isset($data['call']))
			return false;

		switch($data['call']) {

			case "connect":
				return $this->settings->eventHandler->onConnect(
					$data['addr'], $data['app'], $data['flashver'],
					$data['swfurl'], $data['tcurl'], $data['pageurl']);

			case "done":
				return $this->settings->eventHandler->onDone(
					$data['addr'], $data['clientid'], $data['app'], $data['flashver'],
					$data['swfurl'], $data['tcurl'], $data['pageurl'], $data['name']);
				break;

			case "play":
				return $this->settings->eventHandler->onPlay(
					$data['addr'], $data['clientid'], $data['app'], $data['flashver'],
					$data['swfurl'], $data['tcurl'], $data['pageurl'], $data['name']);
				break;

			case "play_done":
				break;

			case "publish":
				return $this->settings->eventHandler->onPublish(
					$data['addr'], $data['clientid'], $data['app'], $data['flashver'],
					$data['swfurl'], $data['tcurl'], $data['pageurl'], $data['name'],
					$data['type']);

			case "update_publish":
				break;

			case "publish_done":
				return $this->settings->eventHandler->onPublishDone(
					$data['addr'], $data['clientid'], $data['app'], $data['flashver'],
					$data['swfurl'], $data['tcurl'], $data['pageurl'], $data['name']);

			case "record_done":
				break;

			default: return false;
		}

	}
}