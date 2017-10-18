<?php

require_once("Status.php");
require_once("conexao.php");

class ModelStatus
{
	private $conex;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_STATUS = -1;
	const EDITANDO_STATUS = -2;
	const EXCLUSAO = -3;
	
	
	function __construct()
	{
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function exibirTodosStatus($codigoAnimal){

		try{
			$resultado=$this->conex->getconnection()->prepare("select a.nome, s.conteudo, s.dataStatus from animal as a inner join status as s on a.codigo=s.codigoAnimal and s.codigoAnimal=?");
			$resultado->bindValue(1,$codigoAnimal);
			$resultado->execute();

			$todosStatus=array();

			//verifica se foi encontrado algum status associado ao animal
			if($resultado->rowCount()>0 ){
				while($linha=$resultado->fetch(PDO::FETCH_OBJ)){
					array_push($todosStatus,$linha);
				}
			}
			else
				$todosStatus="Nada a exibir";
		}catch(PDOException $e){
			$todoStatus =  "ERRO: ".$erro->getmessage();
		}

		return $todosStatus;

	}

	public function cadastrar($pStatus){

		$feedback = null;

		try{

			$resultado=$this->conex->getconnection()->prepare("insert into status(codigoAnimal, conteudo, dataStatus) values (?,?,?)");

			$pStatus->setDataStatus();

			$resultado->bindValue(1,$pStatus->getCodigoAnimal());
			$resultado->bindValue(2,$pStatus->getConteudo());
			$resultado->bindValue(3,$pStatus->getDataStatus());
			$resultado->execute();
			$feedback = "Envio de mensagem ok";

		}catch(PDOException $erro){
			$feedback = "erro:".$erro->getMessage();
		}

		return $feedback;
	
	}
	
	public function alteracao($pStatus)
	{
		$feedback = null;

		try{

			$resultado=$this->conex->getconnection()->prepare("update status set conteudo=? where codigo=?");

			$resultado->bindValue(1,$pStatus->getConteudo());
			$resultado->bindValue(2,$pStatus->getCodigo());
			$resultado->execute();
			$feedback = "Alteracao ok";

		}catch(PDOException $erro){
			$feedback = "Erro:".$erro->getMessage();
		}

		return $feedback;
	}

	public function atualizar($pStatus,$pTipoRotina){
		
		$feedback = null;

		try{

			//em caso de adicao de um novo status
			if($pTipoRotina == ModelStatus::NOVO_STATUS){

				//preparacao da query de insercao
				$resultado=$this->conex->getconnection()->prepare("insert into status(codigoAnimal, conteudo, dataStatus) values (?,?,?)");

				//gerando a hora que o Status foi digitado
				$pStatus->setDataStatus();
				$resultado->bindValue(3,$pStatus->getStatus());

				$feedback = "novo status";
			}

			//no caso da edicao de um status existente
			elseif($pTipoRotina == ModelStatus::EDITANDO_STATUS){

				//preparacao da query de atualizacao
				$resultado=$this->conex->getconnection()->prepare("update status set conteudo=? where codigo=?");

				$feedback="alteracao";
			}

			else $feedback = "erro desconhecido";

			$resultado->bindValue(1,$pStatus->getConteudo());
			$resultado->bindValue(2,$pStatus->getCodigo());
			$resultado->execute();
			$feedback = $feedback." ok";



		}catch(PDOException $erro){
			$feedback = "Erro:".$erro->getMessage();
			return "erro";
		}

		return $feedback;
	}

	
	public function excluir()
	{
		
	}
	
	public function busca()
	{
		
	}
}


?>