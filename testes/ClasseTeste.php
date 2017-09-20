<?php

require_once("C:/xampp/php/pear/PHPUnit/testcase.php");
require_once("../php/ModelDono.php");

class ClasseTeste extends PHPUnit_Framework_TestCase{

	public function testaExiste(){
		$teste = new ModelDono();
		$owner = new Dono();

		$owner->setCodigo(7);
		$owner->setNome("Miguel");
		$owner->setSobreNome("Matheus");
		$owner->setUsuario("MigMath");
		$owner->setSenha("miguelmatheus");
		$objAuxData = new DateTime('2017-09-20');
		$owner->setNascimento($objAuxData->format('y/m/d'));
		//$owner->setNascimento("2012-17-07");
		$owner->setSexo("M");
		$owner->setEmail("miguelmatheus@gmail.com");
				
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

		$this->assertEquals(0, $teste->verifica($owner,ModelDono::PARA_ATUALIZAR));

		$owner->setEmail("bia@gmail.com");
		$owner->setUsuario("4");
		$this->assertEquals("O EMAIL EXISTE", $teste->verifica($owner,ModelDono::PARA_ATUALIZAR));


		$owner->setEmail("bianovinha@gmail.com");
		$owner->setUsuario("bia");
		$this->assertEquals("O USUARIO EXISTE", $teste->verifica($owner,ModelDono::PARA_CADASTRAR));
		


//		$this->assertEquals(true, $teste->verifica("email","bia@gmail.com",5));
//
//		$this->assertEquals(false, $teste->verifica("usuario","z",6));
//		$this->assertEquals(true, $teste->verifica("usuario","bia",5));


		
		

	}


	

}

?>