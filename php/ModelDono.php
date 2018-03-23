<?php

require_once("Conexao.php");
require_once("Dono.php");

class ModelDono{
	// variavel para conexao com o banco de dados
	private $conex;
	

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_CADASTRO = -1;
	const ALTERACAO_DADOS = -2;
	const EXCLUSAO = -3;
	const NO_RESULTS = 0;
	const BLANK = 0;
	
	//construtor da classe
	function __construct(){
		$this->conex=new Conexao();
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function buscarUsuario($termo){	
					
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
			while($linha=$resultado->fetch(PDO::FETCH_ASSOC)){
				array_push($arr,$linha);
			}			
		}
		
		else{
			$arr = self::NO_RESULTS;
		}
		
		return $arr;
	}


	// Exibe dados de um usuario
	public function exibirDadosUsuario($usuario){

		//preparando a query do banco de dados
		$resultado=$this->conex->getConnection()->prepare("select * from dono where usuario=?");
		//RESULTADO=CONEXAO->prepare("SENTENCA SQL")
		
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		$resultado->bindValue(1,$usuario);
		
		//EXECUTANDO A QUERY
		$resultado->execute();
		
		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(PDO::FETCH_ASSOC)){
				return $linha;
			}			
		}
		
		else{
			return self::NO_RESULTS;
		}
	}

	
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
	private function verifica($dono, $operacao){

		if($operacao == ModelDono::ALTERACAO_DADOS){
			$operacao = $dono->getCodigo();
		}

		//existe o usuario
		if($this->existe("usuario", $dono->getUsuario(),$operacao)){
			return "Usuario existe";
		}

		//existe o email
		else if($this->existe("email", $dono->getEmail(),$operacao)){
			return "Emai existe";
		}
	
		else return false;
		
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

	public function inserirUsuario($dono){

		$dono->setUsuario($this->geraUsuario());
		$query = "insert into dono(usuario,senha,nome,sobrenome,nascimento,sexo,email)values(?,?,?,?,?,?,?)");
		$insercao=$this->gerUsuario($dono,$query,ModelDono::NOVO_CADASTRO);
		echo $insercao;
						
	}


	public function alterarDadosUsuario($dono){
		$query="update dono set usuario=?,senha=?,nome=?,sobrenome=?,nascimento=?,sexo=?,email=? where codigo=?";
	}


	private function gerUsuario($dono,$query,$op){
		try{
					
			$haErro = $this->verifica($dono, $op));

			if($haErro)
				return $haErro;

			else{
				$result = null;

				$result=$this->conex->getConnection()->prepare($query);

				if($op==ModelDono::ALTERACAO_DADOS){
					$result->bindValue(8,$dono->getCodigo());
				}

				$result->bindValue(1,$dono->getUsuario());
				$result->bindValue(2,$dono->getSenha());
				$result->bindValue(3,$dono->getNome());
				$result->bindValue(4,$dono->getSobrenome());
				$result->bindValue(5,$dono->getNascimento());
				$result->bindValue(6,$dono->getSexo());
				$result->bindValue(7,$dono->getEmail());
							
				$result->execute();

				return "Concluido";
			}

		}catch(PDOException $erro){
			return "erro: ".$erro->getMessage();
		}
	}


	/*public function inserirDadosUsuario($dono){
		
		try{
		
			//verifica se os dados passados estao certos ou duplicados
			$haErro = $this->verifica($dono, ModelDono::NOVO_CADASTRO);


			//no caso de haver erro
			if($haErro)
				return $haErro;

			else{

				$result = null;

				//gerando o usuario
				$dono->setUsuario($this->geraUsuario());

				//carrega a query de insercao se o tipo de alteracao for um novo cadastro
				$result=$this->conex->getConnection()->prepare("insert into dono(usuario,senha,nome,sobrenome,nascimento,sexo,email)values(?,?,?,?,?,?,?)");
						
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

				return "cadastro ok";
			}

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
			return "ocorreu um erro inesperado na aplicacao";

		}
	}*/

	public function alterarDadosUsuario($dono){
		
		try{
		
			//verifica se os dados passados estao certos ou duplicados
			$haErro = $this->verifica($dono, ModelDono::ALTERACAO_DADOS);


			//no caso de haver erro
			if($haErro)
				return $haErro;

			else{

				$result = null;

				//carrega a query de atualizacao
				$result=$this->conex->getConnection()->prepare("update dono set usuario=?,senha=?,nome=?,sobrenome=?,nascimento=?,sexo=?,email=? where codigo=?");
				
				// VALORES A SEREM PASSADOS PARA A QUERY
				$result->bindValue(1,$dono->getUsuario());
				$result->bindValue(2,$dono->getSenha());
				$result->bindValue(3,$dono->getNome());
				$result->bindValue(4,$dono->getSobrenome());
				$result->bindValue(5,$dono->getNascimento());
				$result->bindValue(6,$dono->getSexo());
				$result->bindValue(7,$dono->getEmail());
				$result->bindValue(8,$dono->getCodigo());
							
				//EXECUTANDO A QUERY DE ATUALIZACAO/CADASTRO
				$result->execute();

				return "Alteracao de dados OK";
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