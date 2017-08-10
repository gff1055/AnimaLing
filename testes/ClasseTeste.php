<?php

require_once("C:/xampp/php/pear/PHPUnit/testcase.php");
require_once("../php/DonoConBD.php");

class ClasseTeste extends PHPUnit_Framework_TestCase{

	public function testaExiste(){
		$teste = new DonoConBD();
		$owner = new Dono();

		$owner->setCodigo(4);
		$owner->setNome("firstName27");
		$owner->setSobreNome("lastName27");
		$owner->setUsuario("4");
		$owner->setSenha("password27");
		$objAuxData = new DateTime('2017-07-27');
		$owner->setNascimento($objAuxData->format('y/m/d'));
		//$owner->setNascimento("2012-17-07");
		$owner->setSexo("M");
		$owner->setEmail("email031@email.com");
				
		//um usuario nao cadastrado tenta colocar um email ja existente
		//$this->assertEquals(true,$teste->existe("email","c@c.com.br",DonoConBD::PARA_CADASTRO));

		$this->assertEquals(false, $teste->existe("codigo", $owner->getCodigo(), DonoConBD::PARA_EXCLUSAO));

		
		

	}


	

}

?>