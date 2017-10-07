<?php
class Status{
	
	private $codigoAnimal;
	private $conteudo;
	private $dataStatus;
	
	function Animal()
	{
		
	}
	
	public function getCodigoAnimal(){
		return $this->codigo;
	}
	
	public function setCodigoAnimal($pCodigo){
		$this->codigo = $pCodigo;
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
		return $this->dataStatus = date('Y-m-d H:i');

	}
}
?>