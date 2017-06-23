<?php

require_once("conexao.php");
require_once("dono.php");

class DonoConBD
{
	// variavel para conexao com o banco de dados
	private $conex;
	
	const NO_RESULTS = -1;
	const BLANK = 0;
	
	const EMAIL_EXISTS = 0;
	const EMAIL_INVALID = -1;
	const EMAIL_ALLOWED = 1;
	
	const USER_EXISTS = 0;
	const USER_SUCCESS = 1;
	
	//construtor da classe
	function __construct()
	{
		$this->conex=new Conexao();
	}
	
	public function buscaUsuario($termo)
	{	
		
		if($termo=="") return self::BLANK;
		
		//preparando a query do banco de dados
		$resultado=$this->conex->getConnection()->prepare("select * from dono where nome like ? or sobrenome like ?");
		//RESULTADO=CONEXAO->prepare("SENTENCA SQL")
		
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		$resultado->bindValue(1,"%".$termo."%");
		$resultado->bindValue(2,"%".$termo."%");
		//RESULTADO->bindValue(INDICE, VALOR)
		
		//EXECUTANDO A QUERY
		$resultado->execute();
		//RESULTADO->execute();

		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		$arr = array();
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(PDO::FETCH_OBJ)){
				
				$donoPopula = new Dono();
				
				//PREENCHENDO O OBJETO
				$donoPopula->setCodigo($linha->codigo);
				$donoPopula->setUsuario($linha->usuario);
				$donoPopula->setSenha($linha->senha);
				$donoPopula->setNome($linha->nome);
				$donoPopula->setSobrenome($linha->sobrenome);
				$donoPopula->setNascimento($linha->nascimento);
				$donoPopula->setEmail($linha->email);
				
				//ADICIONANDO O REGISTRO NO ARRAY DE OBJETOS
				array_push($arr,$donoPopula);
			}			
		}
		
		else{
			$arr = self::NO_RESULTS;
		}
		
		return $arr;
	}
	
	
	public function isThereUser($login){
		
		//PREPARACAO DA QUERY DE BUSCA
		$result=$this->conex->getConnection()->prepare("select * from dono where usuario=?");
		
		//EFETUANDO BIND DE VALORES NA QUERY
		$result->bindValue(1,$login);

		//EXECUCAO DA QUERY COM OS VALORES
		$result->execute();
		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			return self::USER_EXISTS;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return self::USER_NOT_EXISTS;
		}
	}
	
	
	public function checkEmail($pEmail){
		
		//VERIFICA SE O EMAIL FOI PREENCHIDO CORRETAMENTE
		$hasPoint = strrpos($pEmail,'.');
		$hasAt = strrpos($pEmail,'@');
		if($hasPoint == false || $hasAt == false){
			return self::EMAIL_INVALID;	
		}
		
		//PREPARACAO DA QUERY DE BUSCA
		$result=$this->conex->getConnection()->prepare("select * from dono where email=?");
		
		//EFETUANDO BIND DE VALORES NA QUERY
		$result->bindValue(1,$pEmail);

		//EXECUCAO DA QUERY COM OS VALORES
		$result->execute();
		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		//SE HOUVER OCORRENCIA, O EMAIL EXISTE
		if($result->rowCount()>0){
			return self::EMAIL_EXISTS;
		}
		
		//RETORNA SE O EMAIL NAO EXISTIR
		else{
			return self::EMAIL_ALLOWED;
		}
	}
		
	public function cadastrar()
	{
	/*	$conexao = new PDO("mysql:host = localhost; dbname = bdanimalnet","root","");
		$stmt = $conexao->prepare("INSERT INTO dono(nome,sobrenome, email) VALUES(?,?,?)");
		$stmt->bindParam(1,”Nome 20105041555”);
		$stmt->bindParam(2,”sobrenome 20105041555”);
		$stmt->bindParam(3,”email@email.com”);
		$stmt->execute();*/
	}
	
	public function atualizar()
	{
		
	}
	
	public function excluir($codigo)
	{
		$resultado=$this->conex->getConnection()->prepare("delete from dono where codigo = ?");
		$resultado->bindParam(1,$codigo);
		$resultado->execute();
		echo "<br>Usuario excluido<br>";
	}
	
	

/*	public function lista()
	{	
		//efetuando consulta sem passagem de parametro
		//variavel $resultado será populada
		$resultado=$this->conex->getConnection()->query('select * from dono');				

		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		while($linha=$resultado->fetch(PDO::FETCH_OBJ)){
			echo $linha->codigo."<br>";
			echo $linha->nome."<br>";
			echo $linha->sobrenome."<br>";
			echo $linha->email."<br>";
			echo "<br>----<br>";
		}
	}*/
}

//$testeDono = new Dono();

//$teste = new DonoConBD();
//$teste->lista();
//$search = "b";
//$teste->buscaUsuario($search);
//$teste->lista();
?>