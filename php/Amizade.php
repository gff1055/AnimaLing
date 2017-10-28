<?php

class Amizade{
	
	private $codigo;
	private $codigoAnimal;
	private $codigoAmigo;
	private $dataSolicitacao;
	private $dataConfirmacao;
	private $situacao;

	function __construct(){
		$this->dataSolicitacao = 
		$this->situacao = "P";
	}

	function setCodigoAnimal($pCodigoAnimal){
		$this->codigoAnimal() = $pCodigoAnimal;
	}

	function getCodigoAnimal(){
		return $this->codigoAnimal();
	}

	function setCodigoAmigo($pCodigoAmigo){
		$this->codigoAmigo() = $pCodigoAmigo;
	}

	function getCodigoAmigo(){
		return $this->codigoAmigo();
	}

	function setDataSolicitacao ($pDataSolicitacao){
		$this->dataSolicitacao = $pDataSolicitacao;
	}

	function getDataSolicitacao(){
		return $this->dataSolicitacao;
	}

	function setDataConfirmacao (){
		date_default_timezone_set("America/Sao_Paulo");
		$this->dataStatus = date('Y-m-d H:i');
	}

	function getDataConfirmacao(){
		return $this->dataConfirmacao;
	}

	function setSituacao ($pSituacao){
		$this->situacao = $pSituacao;
	}

	function getSituacao(){
		return $this->situacao;
	}
	
	
}
?>