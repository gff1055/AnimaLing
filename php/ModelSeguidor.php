<?php

require_once("Conexao.php");

class ModelSeguidor{

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

	private function jaSegue($pSeguidor){

		try{
			$resultado = $this->conex->getConnection()->prepare("
				select * from seguidor where codSeguido=? and codSeguidor=?");

			$resultado->bindValue(1,$pSeguidor->getCodigoSeguido());
			$resultado->bindValue(2,$pSeguidor->getCodigoSeguidor());
			
			$resultado->execute();

			if($resultado->rowCount()>0)
				return true;
			else
				return false;
		
		}catch(PDOException $e){
			return "erro: ".$e->getMessage();
		}

	}

	public function adicionarSeguidor($pSeguidor){
		
		$resultado = null;

		if($this->jaSegue($pSeguidor)){
			return "<br>voce ja segue o ".$pSeguidor->getCodigoSeguido();
		}

		else{
			try{
				$resultado = $this->conex->getConnection()->prepare("insert into seguidor(codSeguido, codSeguidor) values(?,?)");

				$resultado->bindValue(1,$pSeguidor->getCodigoSeguido());
				$resultado->bindValue(2,$pSeguidor->getCodigoSeguidor());
			
				$resultado->execute();

				return "Seguidor adicionado";
		
			}catch(PDOException $e){
				return "erro: ".$e->getMessage();
			}
		}
	}


	public function listarSeguidores(){}

	public function excluirSeguidores(){}

	
}

?>