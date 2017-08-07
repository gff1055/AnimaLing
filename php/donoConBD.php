<?php

require_once("conexao.php");
require_once("dono.php");

class DonoConBD
{
	// variavel para conexao com o banco de dados
	private $conex;
	

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const PARA_CADASTRO = -1;
	const PARA_ATUALIZACAO = -2;
	
	//construtor da classe
	function __construct()
	{
		$this->conex=new Conexao();
	}

	
	public function buscaUsuario($termo)
	{	
		
			
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

	//private function existe($campo, $dado, $tipo, $codigo){
	//private function existe($campo, $dado, $tipo){

	public function existe($campo,$dado,$codigoAlteracao){

		try{

			if($codigoAlteracao == self::PARA_CADASTRO){
				//PREPARACAO DA QUERY DE BUSCA
				$result=$this->conex->getConnection()->prepare("select * from dono where $campo=?");
			}

			else{
				$result=$this->conex->getConnection()->prepare("select * from dono where $campo=? and codigo<>?");
				$result->bindValue(2,$codigoAlteracao);
			}

			//EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(1,$dado);

			//EXECUCAO DA QUERY COM OS VALORES
			$result->execute();
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}

		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			return true;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return false;
		}
	}


	// verifica se ja tem usuarios com o mesmo nome/email
	public function verifica($dono, $codigoAlteracao){

		if($codigoAlteracao == self::PARA_ATUALIZACAO){
			$codigoAlteracao=$dono->getCodigo();
		}

		if($this->existe("email", $dono->getEmail(),$codigoAlteracao)){
			return "O EMAIL EXISTE";
		}
	
		elseif($this->existe("usuario", $dono->getUsuario(),$codigoAlteracao)){
			return "O USUARIO EXISTE";
		}
	
		else return 0;
		
	}
	

	public function alteracao($pOwner, $tipo){

		try{

			$haErro = $this->verifica($pOwner, $tipo);

			if($haErro)
				return $haErro;
			
			if($tipo == self::PARA_CADASTRO)
				$result=$this->conex->getConnection()->prepare("insert into dono(usuario,senha,nome,sobrenome,nascimento,sexo,email)values(?,?,?,?,?,?,?)");
			

			//NO CASO DE ATUALIZACAO DE DADOS
			elseif($tipo == self::PARA_ATUALIZACAO){
				$result=$this->conex->getConnection()->prepare("update dono set usuario=?,senha=?,nome=?,sobrenome=?,nascimento=?,sexo=?,email=? where codigo=?");
				$result->bindValue(8,$pOwner->getCodigo());
			}

			// VALORES A SEREM PASSADOS PARA A QUERY
			$result->bindValue(1,$pOwner->getUsuario());
			$result->bindValue(2,$pOwner->getSenha());
			$result->bindValue(3,$pOwner->getNome());
			$result->bindValue(4,$pOwner->getSobrenome());
			$result->bindValue(5,$pOwner->getNascimento());
			$result->bindValue(6,$pOwner->getSexo());
			$result->bindValue(7,$pOwner->getEmail());
			
			//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
			$result->execute();

			return "alteracao feita";

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
		}
	}
		

	public function excluir($codigo)
	{
		$resultado=$this->conex->getConnection()->prepare("delete from dono where codigo = ?");
		$resultado->bindValue(1,$codigo);
		$resultado->execute();
		echo "<br>Usuario excluido<br>";
	}
}
?>