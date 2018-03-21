<?php

class Interacao{
	
	private $codigo;
	private $codigoSeguido;
	private $codigoSeguidor;
	private $situacao;

	function __construct(){
		
	}

	function setCodigoSeguido($pCodigoSeguido){
		$this->codigoSeguido = $pCodigoSeguido;
	}

	function getCodigoSeguido(){
		return $this->codigoSeguido;
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
}
?>