<?php 
include_once 'modelo/conecta.php';

class consulta extends conecta{
	
	function consulta(){
		//contrutor
	}
	
	function consultar($tabela, $campo, $id){
	
		$conn = new conecta();
		$con = $conn->conectar();
		if($campo !=''){
			$query = $conn->query("SELECT * FROM ".$tabela." where ".$campo." = '".$id."'", $con);
		}else{
			$query = $conn->query("SELECT * FROM ".$tabela, $con);
		}
		
		return $conn->fetch_array($query);

	}
	
	
	function consultar_desc($tabela, $campo, $id, $ordem){
	
		$conn = new conecta();
		$con = $conn->conectar();
		if($campo){
			if($ordem){
				$qry = "SELECT * FROM ".$tabela." where ".$campo." = '".$id."'"." ORDER BY ".$ordem." DESC";
			}else{
				$qry = "SELECT * FROM ".$tabela." where ".$campo." = '".$id."'";
			}
		}else{
			if($ordem){
				$qry = "SELECT * FROM ".$tabela." ORDER BY ".$ordem." DESC";
			}else{
				$qry = "SELECT * FROM ".$tabela;
			}
		}
		
		$query = $conn->query($qry, $con);	
		return $conn->fetch_array($query);

	}
	
	
	
	function altString($str){
	
		$correta = str_replace("'", "\'", $str);
		return $correta;
	
	}
	
	function strChr($str){
	
		$str = str_replace(array("<", ">", "'", "\\", "!", "=", "?", "*", "&", "^", ";","#", "http://", "/", "www.", ".com.br",".com"), "", $str); 
		return $str;
	}
	
	function uppercase($string){
	
		$string = strtoupper ($string); 
		$string = str_replace ("â", "Â", $string); 
		$string = str_replace ("á", "Á", $string); 
		$string = str_replace ("ã", "Ã", $string); 
		$string = str_replace ("à", "A", $string); 
		$string = str_replace ("ê", "Ê", $string); 
		$string = str_replace ("é", "É", $string); 
		$string = str_replace ("Î", "I", $string); 
		$string = str_replace ("í", "Í", $string); 
		$string = str_replace ("ó", "Ó", $string); 
		$string = str_replace ("õ", "Õ", $string); 
		$string = str_replace ("ô", "Ô", $string); 
		$string = str_replace ("ú", "Ú", $string); 
		$string = str_replace ("Û", "U", $string); 
		$string = str_replace ("ç", "Ç", $string); 
		return $string; 
	}
	
	function gerasenha($tamanho = 6, $maiusculas = true, $numeros = true, $simbolos = false){
	// Caracteres de cada tipo
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	
	// Variáveis internas
	$retorno = '';
	$caracteres = '';
	
	// Agrupamos todos os caracteres que poderão ser utilizados
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	
	// Calculamos o total de caracteres possíveis
	$len = strlen($caracteres);
	
	for ($n = 1; $n <= $tamanho; $n++) {
	// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
	$rand = mt_rand(1, $len);
	// Concatenamos um dos caracteres na variável $retorno
	$retorno .= $caracteres[$rand-1];
	}
	
	return $retorno;
	}
	
}

?>
