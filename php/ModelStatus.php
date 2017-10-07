<?php

require_once("Status.php");
require_once("conexao.php");

class ModelStatus
{
	private $conex;
	
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

	public function cadastrar($pStatus,$pCodigoAnimal){

		/*try*/
			/*prepare*/
			/*efetuar binsa*/
			/*execute*/
			
		/*catch*/

		try{

			$resultado=$this->conex->getconnection()->prepare("insert into status(codigoAnimal, conteudo, dataStatus) values (?,?,?)");
			$resultado->bindValue(1,$pCodigoAnimal);
			$resultado->bindValue(2,$pStatus->getConteudo());
			$resultado->bindValue(3,$pStatus->getDataStatus());

		}catch(PDOException $erro){

		}


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


?>