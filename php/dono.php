<?php
class Dono{
	
	private $codigo;
	private $usuario = "usuario";
	private $senha;
	private $nome = "nome";
	private $sobrenome = "sobrenome";
	private $nascimento = "";
	private $email = "";
	
	function __construct()
	{
		
		$usuario = "usuario";
		$nome = "nome";
		$sobrenome = "sobrenome";
		$nascimento = "";
		$email = "";
	}
	public function getCodigo()
	{
		return $this->codigo;
	}
	
	public function setCodigo($pCodigo)
	{
		$this->codigo = $pCodigo;
	}
	
	public function getUsuario()
	{
		return $this->usuario;
	}
	
	public function setUsuario($pUsuario)
	{
		$this->usuario = $pUsuario;
	}
	
	public function getSenha()
	{
		return $this->senha;
	}
	
	public function setSenha($pSenha)
	{
		$this->senha = $pSenha;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function setNome($pNome)
	{
		$this->nome = $pNome;
	}
	
	public function getSobrenome()
	{
		return $this->sobrenome;
	}
	
	public function setSobrenome($pSobrenome)
	{
		$this->sobrenome = $pSobrenome;
	}
	
	public function getNascimento()
	{
		return $this->nascimento;
	}
	
	public function setNascimento($pNascimento)
	{
		$this->nascimento = $pNascimento;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($pEmail)
	{
		$this->email = $pEmail;
	}
}
?>