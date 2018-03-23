<?php

require_once("Animal.php");
require_once("Dono.php");
require_once("Conexao.php");


class ModelAnimal
{
	private $conexao;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_CADASTRO = 1;
	const ALTERACAO_DADOS = 2;
	const EXCLUSAO = -3;
	const NO_RESULTS = 0;
	const NOME_JA_CADASTRADO=4;
	const OK=5;
	
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


	// Exibe dados de um usuario
	public function exibirDadosAnimal($pcodigo){

		//preparando a query do banco de dados
		$resultado=$this->conex->getConnection()->prepare(
			"select animal.nome as nomeAnimal, especie, animal.sexo as sexo, animal.nascimento as dataNascimento, usuario
			from animal, dono
			where dono.codigo=animal.codigoDono and animal.codigo=?"
			);
		//RESULTADO=CONEXAO->prepare("SENTENCA SQL")
		
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		$resultado->bindValue(1,$pcodigo);
		
		//EXECUTANDO A QUERY
		$resultado->execute();
		
		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(PDO::FETCH_ASSOC)){
				return $linha;
			}			
		}
		
		else{
			return self::NO_RESULTS;
		}
	}	


	// FUNCAO PARA VERIFICAR SE UM DADO EXISTE NO BANCO
	public function existeAnimal($pAnimal,$codOcorrencia){

		$query = "select * from animal where nome=? and codigoDono=?";
		try{

			
			if($codOcorrencia == ModelAnimal::NOVO_CADASTRO){
				$result=$this->conex->getConnection()->prepare($query);
			}

			else{
				$query = $query." and codigo<>?";
				$result=$this->conex->getConnection()->prepare($query);
				$result->bindValue(3,$pAnimal->getCodigo());
			}

			//EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(1,$pAnimal->getNome());
			$result->bindValue(2,$pAnimal->getCodigoDono());
						

			//EXECUCAO DA QUERY COM OS VALORES
			$result->execute();
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}


		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			return true;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return false;
		}
	}


	public function inserirAnimal($pAnimal){
		$query = "insert into animal(codigoDono,nome,especie,nascimento,sexo)values(?,?,?,?,?)";
		$insercao = $this->gerenciaAnimal($pAnimal,$this::NOVO_CADASTRO,$query);
		return $insercao;
	}


	public function alterarDadosAnimal($pAnimal){
		$query = "update animal set codigoDono=?, nome=?,especie=?,nascimento=?,sexo=? where codigo=?";
		$alteracao = $this->gerenciaAnimal($pAnimal,$this::ALTERACAO_DADOS,$query);
		return $alteracao;
	}	


	private function gerenciaAnimal($pAnimal, $operacao, $query){

		$result = null;
		
		$haErro=$this->existeAnimal($pAnimal,$operacao);

		if($haErro){

			return $this::NOME_JA_CADASTRADO;
		}

		else{

			try{

				$result=$this->conex->getConnection()->prepare($query);
				$result->bindValue(1,$pAnimal->getCodigoDono());
				$result->bindValue(2,$pAnimal->getNome());
				$result->bindValue(3,$pAnimal->getEspecie());
				$result->bindValue(4,$pAnimal->getNascimento());
				$result->bindValue(5,$pAnimal->getSexo());

				if($operacao==$this::ALTERACAO_DADOS){
					$result->bindValue(6,$pAnimal->getCodigo());
				}

				$result->execute();

				return $this::OK;

			}catch(PDOException $erro){
				return "erro: ".$erro->getMessage();
			}
		}
	}


	public function excluir($pAnimal)
	{
		$excluido = false;
		
		try{
			$resultado=$this->conex->getConnection()->prepare("delete from animal where codigo = ?");
			$resultado->bindValue(1,$pAnimal->getCodigo());
			$resultado->execute();
			$excluido = true;
		}catch(PDOException $erro){
			return "Erro inesperado da aplicacao";
		}
	
		if($excluido){
			return "Animal excluido";
		}
	}
	
	
	public function buscarAnimal($termo)
	{
		
		$resultado=$this->conex->getConnection()->prepare("
			select a.nome as nomeAnimal, especie, d.nome as nomeDono
			from animal as a
			inner join dono as d
			on d.codigo = a.codigoDono and a.nome like ?");
		//preparando a query do banco de dados

		$resultado->bindValue(1,"%".$termo."%");
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		//RESULTADO->bindValue(INDICE, VALOR)
		
		//EXECUTANDO A QUERY
		$resultado->execute();

		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		$arr = array();
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(PDO::FETCH_ASSOC)){

				//ADICIONANDO O REGISTRO NO ARRAY DE OBJETOS
				array_push($arr,$linha);
			}			
		}
		
		else{
			
			$arr = self::NO_RESULTS;
		}
		
		return $arr;
	}
}
?>