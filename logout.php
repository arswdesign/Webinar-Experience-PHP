<?php 
include_once ('controle/session.php');

$session = new session();

	$session->setSession('nome', '');
	$session->setSession('email', '');
	$session->setSession('validChat', '');
?>