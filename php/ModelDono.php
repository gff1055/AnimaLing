<?php

require_once("conexao.php");
require_once("dono.php");

class ModelDono
{
	// variavel para conexao com o banco de dados
	private $conex;
	

	//constante usada para verificar se a alteracao a ser feita no banco � um cadastro
	const PARA_CADASTRAR = -1;
	const PARA_ATUALIZAR = -2;
	const PARA_EXCLUIR = -3;
	
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
		//cada linha � tratada como um objeto
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

	// FUNCAO PARA VERIFICAR SE UM DADO EXISTE NO BANCO
	public function existe($campo,$dado,$codOcorrencia){

		$query = "select * from dono where $campo=?";
		try{

			
			if($codOcorrencia == ModelDono::PARA_CADASTRAR){
				$result=$this->conex->getConnection()->prepare($query);
			}

			else{
				$query = $query." and codigo<>?";
				$result=$this->conex->getConnection()->prepare($query);
				$result->bindValue(2,$codOcorrencia);
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
	public function verifica($dono, $codOcorrencia){

		if($codOcorrencia == ModelDono::PARA_ATUALIZAR){
			$codOcorrencia = $dono->getCodigo();
		}

		//existe o email
		if($this->existe("email", $dono->getEmail(),$codOcorrencia)){
			return "O EMAIL EXISTE";
		}
	
		//existe o usuario
		elseif($this->existe("usuario", $dono->getUsuario(),$codOcorrencia)){
			return "O USUARIO EXISTE";
		}
	
		else return 0;
		
	}
	
	//funcao que efetua alguma alteracao no banco (cadastro, atualizacao ou exclusao)
	public function cadastrar($pDados){

		try{

			//verifica se os dados passados estao certos ou duplicados
			$haErro = $this->verifica($pDados, ModelDono::PARA_CADASTRAR);

			//no caso de haver erro
			if($haErro)
				return $haErro;
			
			//carrega a query de insercao se o tipo de alteracao for um novo cadastro
			$result=$this->conex->getConnection()->prepare("insert into dono(usuario,senha,nome,sobrenome,nascimento,sexo,email)values(?,?,?,?,?,?,?)");
			
			// VALORES A SEREM PASSADOS PARA A QUERY
			$result->bindValue(1,$pDados->getUsuario());
			$result->bindValue(2,$pDados->getSenha());
			$result->bindValue(3,$pDados->getNome());
			$result->bindValue(4,$pDados->getSobrenome());
			$result->bindValue(5,$pDados->getNascimento());
			$result->bindValue(6,$pDados->getSexo());
			$result->bindValue(7,$pDados->getEmail());
			
			//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
			$result->execute();

			return "cadastro feito";

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
		}
	}


	//funcao que efetua alguma alteracao no banco (cadastro, atualizacao ou exclusao)
	public function atualizar($pDados){

		try{

			//verifica se os dados passados estao certos ou duplicados
			$haErro = $this->verifica($pDados, self::PARA_ATUALIZAR);

			//no caso de haver erro
			if($haErro)
				return $haErro;
			
			$result=$this->conex->getConnection()->prepare("update dono set usuario=?,senha=?,nome=?,sobrenome=?,nascimento=?,sexo=?,email=? where codigo=?");
			
		

			// VALORES A SEREM PASSADOS PARA A QUERY
			$result->bindValue(1,$pDados->getUsuario());
			$result->bindValue(2,$pDados->getSenha());
			$result->bindValue(3,$pDados->getNome());
			$result->bindValue(4,$pDados->getSobrenome());
			$result->bindValue(5,$pDados->getNascimento());
			$result->bindValue(6,$pDados->getSexo());
			$result->bindValue(7,$pDados->getEmail());
			$result->bindValue(8,$pDados->getCodigo());

			//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
			$result->execute();

			return "atualizacao feita";

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
		}
	}
		
	//
	public function excluir($codigo)
	{
		$excluido = false;
		if($this->existe("codigo", $codigo, ModelDono::PARA_EXCLUIR)){

			try{
				$resultado=$this->conex->getConnection()->prepare("delete from dono where codigo = ?");
				$resultado->bindValue(1,$codigo);
				$resultado->execute();
				$excluido = true;
			}catch(PDOException $erro){
				return "Erro inesperado da aplicacao";
			}
		}
		else return "usuario nao existe";

		if($excluido){
			return "usuario excluido";
		}
		
		else{
			return "usuario nao foi excluido";
		}
	}
}
?>