<?php

require_once("C:/xampp/php/pear/PHPUnit/testcase.php");
require_once("../php/DonoConBD.php");

class ClasseTeste extends PHPUnit_Framework_TestCase{

	public function testaExiste(){
		$teste = new DonoConBD();
		$owner = new Dono();

		$owner->setCodigo("4");
		$owner->setUsuario("c");
				
		//um usuario nao cadastrado tenta colocar um email ja existente
		//$this->assertEquals(true,$teste->existe("email","c@c.com.br",DonoConBD::PARA_CADASTRO));

		
		

	}


	

	}
}
?>