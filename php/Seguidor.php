<?php

class Seguidor{
	
	private $codigo;
	private $codigoAnimal;
	private $codigoSeguidor;
	private $situacao;

	function __construct(){
		
	}

	function setCodigoAnimal($pCodigoAnimal){
		$this->codigoAnimal = $pCodigoAnimal;
	}

	function getCodigoAnimal(){
		return $this->codigoAnimal;
	}

	function setCodigoSeguidor($pCodigoSeguidor){
		$this->codigoSeguidor = $pCodigoSeguidor;
	}

	function getCodigoSeguidor(){
		return $this->codigoSeguidor;
	}

	/*function setDataSolicitacao ($pDataSolicitacao){
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
	}*/

	function setSituacao ($pSituacao){
		$this->situacao = $pSituacao;
	}

	function getSituacao(){
		return $this->situacao;
	}
	
	
}
?>