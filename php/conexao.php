<?php

class Conexao
{
	
	private $con;
	
	function __construct()
	{
		try
		{
			//conexao com o banco de dados
			$this->con = new PDO("mysql:host=localhost; dbname=bdanimalnet;charset=utf8","root","");
		}
		catch(PDOException $e)
		{
			echo "erro".$e->getMessage();
		}
	}
	
	function getConnection()
	{
		return $this->con;
	}
	
	
}