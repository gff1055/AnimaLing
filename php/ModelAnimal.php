<?php

require_once("Animal.php");
require_once("Dono.php");

class ModelAnimal
{
	private $conexao;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_CADASTRO = -1;
	const ALTERACAO_DADOS = -2;
	const EXCLUSAO = -3;
	const NO_RESULTS = 0;
	
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


	public function atualizar($pAnimal,$operacao)
	{
		$result = null;

		$feedback = null;

		if($this->existeAnimal($pAnimal,$operacao)){
			$feedback = "Ja existe um animal com esse nome";
		}
		else{
			if($operacao == ModelAnimal::NOVO_CADASTRO){
				$result = $this->conex->getConnection()->prepare("insert into animal(codigoDono,nome,especie,nascimento,sexo)values(?,?,?,?,?)");
				$feedback = "Cadastro de animal";
			}
			elseif($operacao == ModelAnimal::ALTERACAO_DADOS){
				//carrega a query de insercao se o tipo de alteracao for um novo cadastro
				$result=$this->conex->getConnection()->prepare("update animal set codigoDono=?, nome=?,especie=?,nascimento=?,sexo=? where codigo=?");
				$result->bindValue(6,$pAnimal->getCodigo());
				$feedback = "Alteracao de dados";
			}
			try{

				// VALORES A SEREM PASSADOS PARA A QUERY
				$result->bindValue(1,$pAnimal->getCodigoDono());
				$result->bindValue(2,$pAnimal->getNome());
				$result->bindValue(3,$pAnimal->getEspecie());
				$result->bindValue(4,$pAnimal->getNascimento());
				$result->bindValue(5,$pAnimal->getSexo());
			
			
				//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
				$result->execute();

				//operacao de insercao/atualizacao foi executada
				$feedback = $feedback." ok";

			}catch(PDOException $erro){
				echo "erro: ".$erro->getMessage();
				$feedback = "erro interno na aplicacao";
			}
		}

		// retornando o resultado da atualizacao
		return $feedback;
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