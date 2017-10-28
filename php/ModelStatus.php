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

	public function atualizar($pStatus,$pTipoRotina){
	
		$feedback = null;

		try{

			//em caso de adicao de um novo status
			if($pTipoRotina == ModelStatus::NOVO_STATUS){

				//preparacao da query de insercao
				$resultado=$this->conex->getconnection()->prepare("insert into status(conteudo, codigoAnimal, dataStatus) values (?,?,?)");

				//fazendo o binding do codigo e da data de status
				$resultado->bindValue(2,$pStatus->getCodigoAnimal());
				$resultado->bindValue(3,$pStatus->getDataStatus());

				$feedback = "novo status";
			}

			//no caso da edicao de um status existente
			elseif($pTipoRotina == ModelStatus::EDITANDO_STATUS){

				//preparacao da query de atualizacao
				$resultado=$this->conex->getconnection()->prepare("update status set conteudo=? where codigo=?");

				//fazendo o binding do codigo do Status
				$resultado->bindValue(2,$pStatus->getCodigo());

				$feedback="alteracao";
			}

			//no caso da operacao ser inexistente
			else $feedback = "erro desconhecido";

			//fazendo o binding do conteudo
			$resultado->bindValue(1,$pStatus->getConteudo());
			
			//executando a query
			$resultado->execute();
			$feedback = $feedback." ok";



		}catch(PDOException $erro){
			$feedback = "Erro:".$erro->getMessage();
			return "erro";
		}

		return $feedback;
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
	
	public function busca()
	{
		
	}
}


?>