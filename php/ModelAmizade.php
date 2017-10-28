<?php

require_once("conexao.php");

class ModelAmizade{

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

	public function adicionar($solicitante,$solicitado){
		
		$resultado = null;


		try{
			$resultado = $this->conex->getConnection()->prepare("insert into amizade(codAnimal,codAmigo,dataSolicitacao,dataConfirmacao,situacao) values(?,?,?,?,?)");
		}
	}

	public function listar(){}

	public function excluir(){}

	
}

?>