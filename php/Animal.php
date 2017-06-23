<?php
class Animal{
	
	private $codigoUsuario;
	private $codigo;
	private $nome;
	private $especie;
	private $nascimento;
	
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
	
	public function getCodigo()
	{
		return $this->codigo;
	}
	
	public function setCodigo($pCodigo)
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