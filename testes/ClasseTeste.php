<?php

require_once("C:/xampp/php/pear/PHPUnit/testcase.php");
require_once("../php/ModelDono.php");
require_once("../php/ModelAnimal.php");
require_once("../php/Animal.php");

class ClasseTeste extends PHPUnit_Framework_TestCase{

	public function testaExiste(){
		$donoDao = new ModelDono();
		$owner = new Dono();
		$animalDao = new ModelAnimal();
		$animal = new Animal();
		

		$owner->setCodigo(19);
///*
		$owner->setNome("Henrique");
		$owner->setSobreNome("Rodrigo");
		$owner->setUsuario("henro");
		$owner->setSenha("henriquerodrigo");
		$objAuxData = new DateTime('2013-06-18');
		$owner->setNascimento($objAuxData->format('y/m/d'));
		//$owner->setNascimento("2012-17-07");
		$owner->setSexo("M");
		$owner->setEmail("henriquerodrigo@gmail.com");
//*/
/*
		$animal->setNome("Bustica");
		$animal->setEspecie("Rato");
		$animal->setSexo("M");
		$objAuxData = new DateTime('2015-12-07');
		$animal->setNascimento($objAuxData->format('y/m/d'));

				
		//um usuario nao cadastrado tenta colocar um email ja existente
		//$this->assertEquals(true,$teste->existe("email","c@c.com.br",DonoConBD::PARA_CADASTRO));

		/*$this->assertEquals(false, $teste->existe("email","teste1909@gmail.com",ModelDono::NOVO_CADASTRO));
		$this->assertEquals(true, $teste->existe("email","bia@gmail.com",ModelDono::NOVO_CADASTRO));
		$this->assertEquals(true, $teste->existe("usuario","bia",ModelDono::NOVO_CADASTRO));
		$this->assertEquals(false, $teste->existe("usuario","bia@gmail.com",ModelDono::NOVO_CADASTRO));
		$this->assertEquals(true, $teste->existe("codigo","2",ModelDono::NOVO_CADASTRO));
		$this->assertEquals(false, $teste->existe("codigo","1000",ModelDono::NOVO_CADASTRO));
*/

		/*$this->assertEquals(0, $teste->verifica($owner,ModelDono::PARA_CADASTRAR));

		$owner->setEmail("bia@gmail.com");
		$owner->setUsuario("4");
		$this->assertEquals("O EMAIL EXISTE", $teste->verifica($owner,ModelDono::PARA_CADASTRAR));


		$owner->setEmail("bianovinha@gmail.com");
		$owner->setUsuario("bia");
		$this->assertEquals("O USUARIO EXISTE", $teste->verifica($owner,ModelDono::PARA_CADASTRAR));

*/

		//$this->assertEquals("alteracao de dados efeituada", $donoDao->atualizar($owner,ModelDono::ALTERACAO_DADOS));
		$this->assertEquals("alteracao de dados efeituada", $animalDao->excluir(5));
		//$this->assertEquals("alteracao de dados efeituada", $donoDao->gerausuario());
		
		//$this->assertEquals("...", $donoDao->excluir("0; Drop Table animal;"));
		//$this->assertEquals("atualizacao feita", $teste->excluir(1500));


//		$this->assertEquals(true, $teste->verifica("email","bia@gmail.com",5));
//
//		$this->assertEquals(false, $teste->verifica("usuario","z",6));
//		$this->assertEquals(true, $teste->verifica("usuario","bia",5));


		
		

	}


	

}

?>