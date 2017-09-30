<?php

require_once("Animal.php");
require_once("Dono.php");

class ModelAnimal
{
	private $conexao;
	
	function __construct()
	{
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function getConnection()
	{
		return $this->conexao;
	}
	
	public function cadastrar($pAnimal,$pCodigoDono)
	{
		try{

			//carrega a query de insercao se o tipo de alteracao for um novo cadastro
			$result=$this->conex->getConnection()->prepare("insert into animal(codigoDono,nome,especie,nascimento,sexo)values(?,?,?,?,?)");
			
			// VALORES A SEREM PASSADOS PARA A QUERY
			$result->bindValue(1,$pCodigoDono);
			$result->bindValue(2,$pAnimal->getNome());
			$result->bindValue(3,$pAnimal->getEspecie());
			$result->bindValue(4,$pAnimal->getNascimento());
			$result->bindValue(5,$pAnimal->getSexo());
			
			
			//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
			$result->execute();

			return "cadastro do animal feito";

		}catch(PDOException $erro){
			echo "erro interno na aplicacao";
			echo "erro: ".$erro->getMessage();
		}
	}

	public function selecionarAnimal($pCodigoAnimal){
		
	}
	
	public function alteracao($pAnimal, $pCodigoDono)
	{
		try{

			//carrega a query de insercao se o tipo de alteracao for um novo cadastro
			$result=$this->conex->getConnection()->prepare("update animal set codigoDono=?, nome=?,especie=?,nascimento=?,sexo=? where codigo=?");
			
			// VALORES A SEREM PASSADOS PARA A QUERY
			$result->bindValue(1,$pAnimal->getCodigoDono());
			$result->bindValue(2,$pAnimal->getNome());
			$result->bindValue(3,$pAnimal->getEspecie());
			$result->bindValue(4,$pAnimal->getNascimento());
			$result->bindValue(5,$pAnimal->getSexo());
			$result->bindValue(6,$pAnimal->getCodigo());
			
			
			
			//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
			$result->execute();

			return "alteracao de dados efeituada";

		}catch(PDOException $erro){
			echo "erro interno na aplicacao";
			echo "erro: ".$erro->getMessage();
		}
	}
	
	public function excluir($codigo)
	{
		$excluido = false;
		
		try{
			$resultado=$this->conex->getConnection()->prepare("delete from animal where codigo = ?");
			$resultado->bindValue(1,$codigo);
			$resultado->execute();
			$excluido = true;
		}catch(PDOException $erro){
			return "Erro inesperado da aplicacao";
		}
	
		if($excluido){
			return "usuario excluido";
		}
	}
	
	
	public function busca()
	{
		
	}
}
?>