<?php 
include_once ('controle/cadastro.php');
include_once ('controle/consulta.php');
include_once ('controle/session.php');

$consulta = new consulta();
$cadastro = new cadastro();
$session = new session();


$mensagem = $consulta->strChr($_POST["mensagem"]);
$nome = $session->getSession('nome');
$evento = $session->getSession('evento');

$qry = utf8_decode("INSERT INTO webinar (nome, mensagem, evento) values( 
	'".$nome."',
	'".$mensagem."',
	".$evento."
	)");	

$rs_cadastro = $cadastro->cadastrar($qry);
if ($rs_cadastro){
	echo 1;
}
?>