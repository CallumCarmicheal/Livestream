<?php
		
	namespace Livestream\Engine\Authentication;
	
	class Viewer extends iAuthClass {
	private $token = "";
		function __construct($token) {
			$this->token = $token;
			parent::__construct($token);
		}
		
		function checkAuth() {
			// ITS A FREEDAY 
			return true;
		}
	}
?>