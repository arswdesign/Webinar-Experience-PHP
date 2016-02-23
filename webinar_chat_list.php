<?php 
session_start();
include_once ('controle/consulta.php');
include_once ('controle/session.php');

$consulta = new consulta();
$session = new session();


$conn = new conecta();
$con = $conn->conectar();

$rsevento = $consulta->consultar("eventos","ativo",1);
;


if ($rsevento["concluido"]){
	$html = 'O Webinar Terminou!';
}else{
	$query = $conn->query("SELECT * FROM webinar where evento = ".$_SESSION["evento"], $con);
	$html = '<div id="chatHeight">';
	while($rs = $conn->fetch_array($query)){
		$html .= '<span class="nome_chat">'.utf8_encode($rs["nome"])."</span><br />";
		$html .= '<span class="msg_chat">'.utf8_encode($rs["mensagem"])."</span><br />";
		$html .=  "<div class='line_inscricao clr' style='margin:10px 0'></div>";	
	}
	$html .= '</div>';
}

echo $html;
?>