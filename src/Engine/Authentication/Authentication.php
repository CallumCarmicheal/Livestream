<?php
	namespace Livestream\Engine\Authentication;

	if(!defined("LS_AUTHENTICATION_ACCEPTED"))
		define("LS_AUTHENTICATION_ACCEPTED", 			"token OK! ");
	
	if(!defined("LS_AUTHENTICATION_QUERY_INCORRECT"))
		define("LS_AUTHENTICATION_QUERY_INCORRECT", 	"wrong query input");
	
	if(!defined("LS_AUTHENTICATION_FAILURE"))
		define("LS_AUTHENTICATION_FAILURE", 			"token wrong! ");
	
	if(!defined("LS_AUTHENTICATION_HEADER"))
		define("LS_AUTHENTICATION_HEADER", 				'HTTP/1.0 404 Not Found');
	
	abstract class iAuthClass {
		
		private $token = "";
		private $authenticated = false;
		
		public function __construct($token) {
			$this->$token = $token;
				
			// Make sure this is authenticated
			$this->authenticated = $this->SUPER_SECRET_PASSWORD_AUTHENTICATION();
		}
		
		abstract function checkAuth();
		
		private function SUPER_SECRET_PASSWORD_AUTHENTICATION() {
			// Query a database later
			// you know all the super h4x0r stuff
				
			// Yep there is none
			return $this->checkAuth();
		}
		
		public function isAuthenticated() {
			return $this->authenticated;
		} 
		
		public function AuthenticationToString() {
			if($this->isAuthenticated()) {
				return "Authenticated";
			} else {
				return "Invalid Token";
			}
		}
		
		public function getToken() {
			return $this->token;
		}
		
		public function Execute() {
			if($this->isAuthenticated()) {
				die(LS_AUTHENTICATION_ACCEPTED);
			} else {
				header(LS_AUTHENTICATION_HEADER);
				die(LS_AUTHENTICATION_FAILURE);
			}
		}
		
	}
?>