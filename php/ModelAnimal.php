<?php

require_once("Animal.php");

class AnimalConBD
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
	
	public function cadastrar(Animal $pAnimal)
	{
		echo $pAnimal->getNome();
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

$testeAnimal = new Animal;
$testeAnimal->setNome("CAO");
$teste = new AnimalConBD();
$teste->cadastrar($testeAnimal);
if($teste->getconnection()) echo "conectou";
else echo "deu erro";

?>