<?php
class Status{
	
	private $codigoDono;
	private $codigoAnimal;
	private $conteudo;
	private $dataStatus;
	
	function Animal()
	{
		
	}
	
	public function getCodigoDono()
	{
		return $this->codigoDono;
	}
	
	public function setCodigoDono($pCodigoDono)
	{
		$this->codigoDono = $pCodigoDono;
	}
	
	public function getCodigoAnimal()
	{
		return $this->codigo;
	}
	
	public function setCodigoAnimal($pCodigo)
	{
		$this->codigo = $pCodigo;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function setNome($pNome)
	{
		$this->nome = $pNome;
	}
	
	public function getEspecie()
	{
		return $this->especie;
	}
	
	public function setEspecie($pEspecie)
	{
		$this->especie = $pEspecie;
	}
	
	public function getNascimento()
	{
		return $this->nascimento;
	}
	
	public function setNascimento($pNascimento)
	{
		$this->nascimento = $pNascimento;
	}
}
?>