<?php

require_once("Conexao.php");

class ModelInteracao{

	private $conex;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_STATUS = -1;
	const EDITANDO_STATUS = -2;
	const EXCLUSAO = -3;
		
	function __construct(){
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	private function jaSegue($seguidor, $seguido){

		try{
			$resultado = $this->conex->getConnection()->prepare("
				select * from interacao where codSeguidor=? and codSeguido=?");

			$resultado->bindValue(1,$seguidor);
			$resultado->bindValue(2,$seguido);

			
			$resultado->execute();

			if($resultado->rowCount()>0)
				return true;
			else
				return false;
		
		}catch(PDOException $e){
			return "erro: ".$e->getMessage();
		}

	}

	public function adicionarSeguidor($pInteracao){
		
		$resultado = null;

		if($this->jaSegue($pInteracao->getCodigoSeguidor(),$pInteracao->getCodigoSeguido())){
			return "<br>voce ja segue o ".$pInteracao->getCodigoSeguido();
		}

		else{
			try{
				$resultado = $this->conex->getConnection()->prepare("insert into interacao(codSeguido, codSeguidor) values(?,?)");

				$resultado->bindValue(1,$pInteracao->getCodigoSeguido());
				$resultado->bindValue(2,$pInteracao->getCodigoSeguidor());
			
				$resultado->execute();

				return "Seguidor adicionado";
		
			}catch(PDOException $e){
				return "erro: ".$e->getMessage();
			}
		}
	}


	public function listarSeguidores($codigoAnimal){
			$query = "
				select i.codSeguidor as seguidor, a.nome as nomeSeguidor
				from interacao as i
				inner JOIN animal as a
				on i.codSeguido=? and a.codigo=i.codSeguidor";

			$seguidores = $this->listar($query,$codigoAnimal);
			
			return $seguidores;

	}


	public function listarSeguidos($codigoAnimal){


		$query = "
				select i.codSeguido as seguido, a.nome as nomeSeguido
				from interacao as i
				inner JOIN animal as a
				on i.codSeguidor=? and a.codigo=i.codSeguido";

		$seguidos = $this->listar($query,$codigoAnimal);
			
		return $seguidos;
	}


	private function listar($query,$codigoAnimal){
		try{

			$resultado=$this->conex->getConnection()->prepare($query);

			$resultado->bindValue(1,$codigoAnimal);
			$resultado->execute();

			$todosSeguidores=array();

			if($resultado->rowCount()>0){
				while($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
					array_push($todosSeguidores,$linha);
				}
				return $todosSeguidores;
			}

			else return 0;

		}catch(PDOException $e){
			return "<br> ERRO:".$e->getMessage();
		}	
	}



	public function excluirSeguidor($pInteracao){

		try{

			$query = "
			delete from
				interacao
			where
				codSeguido=? and codSeguidor=?";

			$resultado = $this->conex->getConnection()->prepare($query);

			$resultado->bindValue(1,$pInteracao->getCodigoSeguido());
			$resultado->bindValue(2,$pInteracao->getCodigoSeguidor());

			$resultado->execute();

			return "seguidor excluido";

		}catch(PDOException $e){
			return "<br>ERRO: ".$e->getMessage();
		}

	}

	
}

?>