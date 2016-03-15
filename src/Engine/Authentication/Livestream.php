<?php

	namespace Livestream\Engine\Authentication;
	
	class Livestream extends iAuthClass {
		private $token = "";
		function __construct($token) {
			$this->token = $token;
			parent::__construct($token);
		}
		
		function checkAuth() {
			
			if(strcmp($this->token, "SecretToken") == 0) {
				return true;
			} return false;
		}
	}

?>