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

	public function adicionarSeguidor($pSeguidor){
		
		$resultado = null;

		try{
			$resultado = $this->conex->getConnection()->prepare("insert into seguidor(codSeguidor,codAnimal,situacao) values(?,?,?)");

			$resultado->bindValue(1,$pSeguidor->getCodigoSeguidor());
			$resultado->bindValue(2,$pSeguidor->getCodigoAnimal());
			$resultado->bindValue(3,$pSeguidor->getSituacao());
			
			$resultado->execute();

			return "Convite enviado";
		
		}catch(PDOException $e){
			return "erro: ".$e->getMessage();
		}
	}


	public function seguirVolta($pSeguidor){
		
		$resultado = null;

		try{
			$resultado = $this->conex->getConnection()->prepare("update seguidor set situacao='11' where codAnimal=? and codSeguidor=?");

			$resultado->bindValue(1,$pSeguidor->getCodigoAnimal());
			$resultado->bindValue(2,$pSeguidor->getCodigoSeguidor());
			//$resultado->bindValue(3,$pSeguidor->getCodigo());
			
			$resultado->execute();

			return "<br>Seguindo de volta";
		
		}catch(PDOException $e){
			return "erro: ".$e->getMessage();
		}
	}


	public function listarSeguidores(){}

	public function excluirSeguidores(){}

	
}

?>