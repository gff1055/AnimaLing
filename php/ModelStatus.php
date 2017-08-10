<?php

require_once("Status.php");

class StatusConBD
{
	private $conexao;
	
	function __construct()
	{
		$this->conexao = mysqli_connect('localhost','root','','bdanimalnet');
		echo "<br>CONECTANDO AO BANCO DE DADOS...";
		if(mysqli_connect_errno($this->conexao))
		{
			$this->conexao = null;
		}
	}

	
	public function getConnection()
	{
		return $this->conexao;
	}
	
	public function cadastrar(Status $pStatus)
	{
		echo $pStatus->getNome();
	}
	
	public function atualizar()
	{
		
	}
	
	public function excluir()
	{
		
	}
	
	public function busca()
	{
		
	}
}

$testeSt = new Status;
$testeSt->setNome("ELA ESTA AQUI :-D");
$teste = new StatusConBD();
$teste->cadastrar($testeSt);
if($teste->getconnection()) echo "conectou";
else echo "deu erro";

?>