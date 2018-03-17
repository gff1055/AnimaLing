<?php

require_once("Conexao.php");

class ModelAmizade{

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

	public function adicionarAmizade($pAmizade){
		
		$resultado = null;

		try{
			$resultado = $this->conex->getConnection()->prepare("insert into amizade(codAnimal,codAmigo,situacao) values(?,?,?)");

			$resultado->bindValue(1,$pAmizade->getCodigoAnimal());
			echo $pAmizade->getCodigoAnimal();
			$resultado->bindValue(2,$pAmizade->getCodigoAmigo());
			echo $pAmizade->getCodigoAmigo();
			$resultado->bindValue(3,$pAmizade->getSituacao());
			echo $pAmizade->getSituacao();

			$resultado->execute();

			return "Convite enviado";
		
		}catch(PDOException $e){
			return "erro: ".$e->getMessage();
		}
	}


	/*public function confirmarAmizade($pAmizade){
		
		$resultado = null;


		try{
			$resultado = $this->conex->getConnection()->prepare("insert into amizade(codAnimal,codAmigo,dataSolicitacao,dataConfirmacao,situacao) values(?,?,?,?,?)");

			$resultado->bindValue(1,$pAmizade->getCodigoAnimal());
			$resultado->bindValue(2,$pAmizade->getCodigoAmigo());
			$resultado->bindValue(3,$pAmizade->getSituacao());
		}
	}*/

	public function listar(){}

	public function excluir(){}

	
}

?>