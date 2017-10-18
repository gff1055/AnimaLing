<?php

require_once("conexao.php");
require_once("dono.php");

class ModelDono{
	// variavel para conexao com o banco de dados
	private $conex;
	

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_CADASTRO = -1;
	const ALTERACAO_DADOS = -2;
	const EXCLUSAO = -3;
	
	//construtor da classe
	function __construct(){
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function buscaUsuario($termo){	
					
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

	// FUNCAO PARA VERIFICAR SE UM DADO EXISTE NO BANCO
	public function existe($campo,$dado,$codOcorrencia){

		$query = "select * from dono where $campo=?";
		try{

			
			if($codOcorrencia == ModelDono::NOVO_CADASTRO || $codOcorrencia == ModelDono::EXCLUSAO){
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
	private function verifica($dono, $codOcorrencia){


		if($codOcorrencia == ModelDono::ALTERACAO_DADOS){
			$codOcorrencia = $dono->getCodigo();
			//existe o usuario
			if($this->existe("usuario", $dono->getUsuario(),$codOcorrencia)){
				return "O USUARIO EXISTE";
			}
		}

		//existe o email
		if($this->existe("email", $dono->getEmail(),$codOcorrencia)){
			return "O EMAIL EXISTE";
		}
	
		else return 0;
		
	}

	private function geraUsuario(){

		//preparando e executando a query
		$result = $this->conex->getConnection()->prepare("select max(codigo) as maiorCodigo from dono");
		$result->execute();
		
		//recebendo o resultado
		$linha=$result->fetch(PDO::FETCH_OBJ);

		//gerando o ID do usuario disponivel
		$userDisp=$linha->maiorCodigo+1;
		
		return "user".$userDisp;
	}


	public function atualizar($dono,$operacao){
		
		$feedback = null;
		
		try{
		
			//verifica se os dados passados estao certos ou duplicados
			$haErro = $this->verifica($dono, $operacao);


			//no caso de haver erro
			if($haErro)
				$feedback = $haErro;

			else{

				$result = null;

				//se nao houver erro e a operacao for um cadastro
				if($operacao == ModelDono::NOVO_CADASTRO){

					//gerando o usuario
					$dono->setUsuario($this->geraUsuario());

					//carrega a query de insercao se o tipo de alteracao for um novo cadastro
					$result=$this->conex->getConnection()->prepare("insert into dono(usuario,senha,nome,sobrenome,nascimento,sexo,email)values(?,?,?,?,?,?,?)");
					$feedback = "Cadastro de usuario";
				}

				//se nao houver erro e a operacao for uma atualizacao
				elseif($operacao == ModelDono::ALTERACAO_DADOS){
					
					//carrega a query de atualizacao
					$result=$this->conex->getConnection()->prepare("update dono set usuario=?,senha=?,nome=?,sobrenome=?,nascimento=?,sexo=?,email=? where codigo=?");
					$result->bindValue(8,$dono->getCodigo());
					$feedback = "Alteracao de dados";
				}

				// VALORES A SEREM PASSADOS PARA A QUERY
				$result->bindValue(1,$dono->getUsuario());
				$result->bindValue(2,$dono->getSenha());
				$result->bindValue(3,$dono->getNome());
				$result->bindValue(4,$dono->getSobrenome());
				$result->bindValue(5,$dono->getNascimento());
				$result->bindValue(6,$dono->getSexo());
				$result->bindValue(7,$dono->getEmail());
			
				//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
				$result->execute();

				$feedback = $feedback." ok";
			}

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
			return "ocorreu um erro inesperado na aplicacao";

		}

		return $feedback;
	}
	
		
	//
	public function excluir($codigo){
		$excluido = false;
		if($this->existe("codigo", $codigo, ModelDono::EXCLUSAO)){

			try{
				$resultado=$this->conex->getConnection()->prepare("delete from dono where codigo=?");
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
		
	}
}
?>