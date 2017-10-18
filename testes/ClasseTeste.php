<?php

require_once("C:/xampp/php/pear/PHPUnit/testcase.php");
require_once("../php/ModelDono.php");
require_once("../php/ModelAnimal.php");
require_once("../php/Animal.php");
require_once("../php/ModelStatus.php");

class ClasseTeste extends PHPUnit_Framework_TestCase{

	public function testaExiste(){
		$donoDao = new ModelDono();
		
		$owner = new Dono();
		$owner2 = new Dono();
		
		$animalDao = new ModelAnimal();
		
		$animal = new Animal();
		$animal2 = new Animal();
		
		$statusDao = new ModelStatus();
		$status = new Status();
		

	

	$status->setCodigo(3);
	$status->setConteudo("Gnt! Isso é necessário!");

	$this->assertEquals(
		"alteracao ok",
		$statusDao->atualizar($status,ModelStatus::EDITANDO_STATUS)
	);
	


	/*	$this->assertEquals(
			"D",
			$donoDao->excluir(4)
		);*/

		/*$this->assertEquals(
			"Animal excluido",
			$animalDao->excluir(2)
		);

		$owner2->setCodigo(14);
		$owner2->setUsuario("incognito");
		$owner2->setSenha("password27");
		$owner2->setNome("firstName27");
		$owner2->setSobrenome("php");
		$owner2->setNascimento("2016-05-24");
		$owner2->setSexo("M");
		$owner2->setEmail("email271@email271.com");

		$this->assertEquals(
			"Alteracao de dados ok",
			$donoDao->atualizar($owner2,ModelDono::ALTERACAO_DADOS)
		);


	/*	$owner2->setCodigo(4);
		$owner2->setUsuario("henri2");
		$owner2->setSenha("henrisenha");
		$owner2->setNome("henrique2");
		$owner2->setSobrenome("dourado2");
		$owner2->setNascimento("2017-07-17");
		$owner2->setSexo("M");
		$owner2->setEmail("novo_henriquedourado2@hotmal.com");

		$this->assertEquals(
			"Alteracao de dados ok",
			$donoDao->atualizar($owner2,ModelDono::ALTERACAO_DADOS)
		);
*/
	/*	$animal->setCodigo(3);
		$animal->setCodigoDono(16);
		$animal->setNome("Bustica");
		$animal->setEspecie("Esquilo");
		$animal->setNascimento("2015-12-07");
		$animal->setSexo("M");

		$this->assertEquals(
			"Alteracao de dados ok",
			$animalDao->atualizar($animal,ModelAnimal::ALTERACAO_DADOS)
		);

	




	/*	$owner2->setCodigo(20);
		$owner2->setUsuario("user20");
		$owner2->setSenha("iurysantos");
		$owner2->setNome("Iury");
		$owner2->setSobrenome("Santos");
		$owner2->setNascimento("2013-06-18");
		$owner2->setSexo("M");
		$owner2->setEmail("iurysantos@gmail.com");

		$this->assertEquals(
			"Alteracao de dados OK!",
			$donoDao->atualizar($owner2,ModelDono::ALTERACAO_DADOS)
		);
*/
/*
		$animal2->setCodigoDono(4);
		$animal2->setNome("Alf");
		$animal2->setEspecie("Elefante");
		$animal2->setSexo("M");
		$animal2->setNascimento("2015-12-25");

		$this->assertEquals(
			"Cadastro de animal ok",
			$animalDao->atualizar($animal2,ModelDono::NOVO_CADASTRO)
		);
*/

		
		


		/*$owner->setNome("Daniel");
		$owner->setSobrenome("Lacerda");
		$owner->setNascimento("1994-10-20");
		$owner->setEmail("DaviLacerda@gmail.com");
		$owner->setSenha("davilacerda");
		$owner->setSexo("M");

		$this->assertEquals(
			"Cadastro de usuario OK!",
			$donoDao->atualizar($owner,ModelDono::NOVO_CADASTRO)
		);*/


	


		






		

	}

}

?>