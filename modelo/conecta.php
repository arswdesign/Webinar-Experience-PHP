<?php
//header("Content-Type: text/html; charset=ISO-8859-1",true);

include_once 'modelo/config.php';

class conecta extends configuracao{
	
	function conecta(){
		//Construtor 
	}

	function conectar(){ // Esta função faz a conexão com o banco de dados
	
		switch($this->banco){
			
			case "mssql": // Conecta se o banco for o Microsoft SQL Server
				$conn = mssql_connect($this->host, $this->usuario, $this->senha);
				mssql_select_db($this->db,$conn);
				return $conn;
				break;
			
			case "mysql": // Conecta se o banco for o MYSQL
				$conn = mysql_connect($this->host, $this->usuario, $this->senha);
				mysql_select_db($this->db);
				return $conn;
				break;
			
		}
		
	}
	
	function query($sql, $conn){ // Executa a query no banco de dados, de acordo com a sql passada
								 // $conn é a conexão feita
		switch($this->banco){	 // $sql é a comando a ser executado no banco
			
			case "mssql": // Executa a consulta ao banco de dados Microsoft SQL Server
				$res = mssql_query(utf8_decode($sql), $conn);
				return $res;
				break;
			
			case "mysql": // Executa a consulta ao banco de dados MYSQL
				$res = mysql_query($sql, $conn);
				return $res;
				break;
			
		}
	}
	
	function fetch_array($res){ // Executa o fetch no banco de dados, de acordo com a sql passada, recuperando os dados
								 // $res é a comando a ser executado no banco
		switch($this->banco){
			
			case "mssql": // Executa a consulta ao banco de dados Microsoft SQL Server
				return mssql_fetch_array($res);
				break;
			
			case "mysql": // Executa a consulta ao banco de dados MYSQL
				return mysql_fetch_array($res);
				break;
			
		}
	}
	
	function row($res){
	
		switch($this->banco){
			
			case "mssql": // Executa a consulta ao banco de dados Microsoft SQL Server
				return mssql_num_rows($res);
				break;
			
			case "mysql": // Executa a consulta ao banco de dados MYSQL
				return mysql_num_rows($res);
				break;
			
		}
	}
	
	function configData(){
	
		switch($this->banco){
			
			case "mssql": // Formato de data se SQL Server
				return "GETDATE()";
				break;
			
			case "mysql": // Formato de data se MYSQL
				return "NOW()";
				break;
			
		}
	
	}
	
	function configLimite(){
	
		switch($this->banco){
			
			case "mssql": // Formato de data se SQL Server
				return "TOP";
				break;
			
			case "mysql": // Formato de data se MYSQL
				return "LIMIT";
				break;
			
		}
	
	}

	function close($conn){ // Fecha a conexão com o banco

		mssql_close($conn);

	}

}

?>