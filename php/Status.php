<?php
class Status{
	
	private $codigo;
	private $codigoAnimal;
	private $conteudo;
	private $dataStatus;
	
	function Animal()
	{
		
	}
	

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($pCodigo){
		$this->codigo = $pCodigo;
	}

	public function getCodigoAnimal(){
		return $this->codigoAnimal;
	}
	
	public function setCodigoAnimal($pCodigoAnimal){
		$this->codigoAnimal = $pCodigoAnimal;
	}
	
	public function getConteudo(){
		return $this->conteudo;
	}
	
	public function setConteudo($pConteudo){
		$this->conteudo = $pConteudo;
	}
	
	public function getDataStatus(){
		return $this->dataStatus;
	}
	
	public function setDataStatus(){
		date_default_timezone_set("America/Sao_Paulo");
		$this->dataStatus = date('Y-m-d H:i');

	}
}
?>