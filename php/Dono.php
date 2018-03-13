<?php
class Dono{
	
	private $codigo;
	private $usuario;
	private $senha;
	private $nome;
	private $sobrenome;
	private $nascimento;
	private $sexo;
	private $email;
	
	function __construct(){
		
		$usuario = "";
		$nome = "";
		$sobrenome = "";
		$nascimento = "";
		$email = "";
	}
	
	public function getCodigo(){
		return $this->codigo;
	}
	
	public function setCodigo($pCodigo){
		$this->codigo = $pCodigo;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	
	public function setUsuario($pUsuario){
		$this->usuario = $pUsuario;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	
	public function setSenha($pSenha){
		$this->senha = $pSenha;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($pNome){
		$this->nome = $pNome;
	}
	
	public function getSobrenome(){
		return $this->sobrenome;
	}
	
	public function setSobrenome($pSobrenome){
		$this->sobrenome = $pSobrenome;
	}
	
	public function getSexo(){
		return $this->sexo;
	}
	
	public function setSexo($pSexo){
		$this->sexo = $pSexo;
	}
	
	public function getNascimento(){
		return $this->nascimento;
	}
	
	public function setNascimento($pNascimento){

		$objAuxData = new DateTime($pNascimento);
		$this->nascimento = $objAuxData->format('y/m/d');
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($pEmail){
		$this->email = $pEmail;
	}
}
?>