<?php 
session_start();

include_once ('controle/cadastro.php');
include_once ('controle/consulta.php');
include_once ('controle/session.php');

$consulta = new consulta();
$cadastro = new cadastro();
$session = new session();

$acao = $_POST["acao"];
$email = $consulta->strChr($_POST["email"]);
$nome = $consulta->strChr($_POST["name"]);
$data = date("Y-m-d H:i:s");


$session->setSession('nome',$nome);
$session->setSession('email',$email);
$session->setSession('validChat',1);


$rs = $consulta->consultar("lista","email", $email);
	
if(!$rs){

	$qry = utf8_decode("INSERT INTO lista(nome, email) values( 
		'".$nome."',
		'".$email."'
		)");	
	$rs_cadastro = $cadastro->cadastrar($qry);	
	echo 1;
}
	
?>