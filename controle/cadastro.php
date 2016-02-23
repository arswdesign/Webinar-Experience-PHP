<?php 

include_once 'modelo/conecta.php';

class cadastro extends conecta{

	function cadastro(){
		//contrutor
	}

	function cadastrar($query){
		
		$con = new conecta();
		$conn = $con->conectar();
		if ($con->query($query,$conn)){
			return true;	
		}else{
			return false;
		}
	
	}
	
}

?>