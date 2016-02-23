<?php 
error_reporting(0);
ob_start();
class session{

	function session(){
		//construtor
		session_start();
	}

	function setSession($vars,$val){
		$_SESSION[$vars] = $val;
	}
	
	function getSession($var){
		return $_SESSION[$var];
	}

}

?>