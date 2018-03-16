<?php

require_once("Status.php");
require_once("Conexao.php");

class ModelStatus
{
	private $conex;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_STATUS = -1;
	const EDITANDO_STATUS = -2;
	const EXCLUSAO = -3;
	const NO_RESULTS = 0;
	
	
	function __construct()
	{
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function exibirTodosStatus($codigoAnimal){

		try{
			$resultado=$this->conex->getconnection()->prepare("
				select
					a.nome as nomeAnimal, s.conteudo as conteudo, s.dataStatus as dataStatus 
				from
					animal as a
				inner join
					status as s 
				on
					a.codigo=s.codigoAnimal
				where
					s.codigoAnimal=?");

			$resultado->bindValue(1,$codigoAnimal);
			$resultado->execute();

			$todosStatus=array();

			//verifica se foi encontrado algum status associado ao animal
			if($resultado->rowCount()>0 ){
				while($linha=$resultado->fetch(PDO::FETCH_ASSOC)){
					array_push($todosStatus,$linha);
				}

				return $todosStatus;
			}
			
			else
				return 0;
		
		}catch(PDOException $e){
			return  "ERRO: ".$erro->getmessage();
		}
	}

	public function inserirStatus($pStatus){
	
		try{

			//preparacao da query de insercao
			$resultado=$this->conex->getconnection()->prepare("insert into status(conteudo, codigoAnimal, dataStatus) values (?,?,?)");

			//fazendo o binding do codigo, data de status edo conteudo
			$resultado->bindValue(1,$pStatus->getConteudo());
			$resultado->bindValue(2,$pStatus->getCodigoAnimal());
			$resultado->bindValue(3,$pStatus->getDataStatus());

			//executando a query
			$resultado->execute();
			
			return "novo status OK";

		}catch(PDOException $erro){
			$feedback = "Erro:".$erro->getMessage();
			return "erro";
		}
	}

	public function atualizarStatus($pStatus){
	
		try{

			//preparacao da query de atualizacao
			$resultado=$this->conex->getconnection()->prepare("update status set conteudo=? where codigo=?");

			//fazendo o binding do codigo do Status
			$resultado->bindValue(1,$pStatus->getConteudo());
			$resultado->bindValue(2,$pStatus->getCodigo());

			$resultado->execute();

			return "atualizacao de status OK";

		}catch(PDOException $erro){
			$feedback = "Erro:".$erro->getMessage();
			return "erro";
		}

	}

	
	public function excluir($pStatus)
	{

		$feedback = null;

		try{

			$resultado=$this->conex->getConnection()->prepare("delete from status where codigo=?");
			$resultado->bindValue(1,$pStatus->getCodigo());
			$resultado->execute();
			$feedback = "O status foi excluido";


		}catch(PDOException $erro){

			echo "Erro: ".$erro.getMessage();
			$feedback = "erro inesperado";
		}

		return $feedback;
	}
	
	public function busca($termo)
	{
		$resultado=$this->conex->getConnection()->prepare("
				select
					a.nome as nomeAnimal, s.conteudo as acontAgora
				from
					animal as a
				inner join
					status as s
				on
					a.codigo = s.codigoAnimal
				where
					a.nome like ? or s.conteudo like ?");
		//preparando a query do banco de dados

		$resultado->bindValue(1,"%".$termo."%");
		$resultado->bindValue(2,"%".$termo."%");
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