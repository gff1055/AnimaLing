<?php
require_once("ModelAnimal.php");
require_once("Dono.php");

$tabelaAnimal = new ModelAnimal();
$animal = new Animal();
?>

<html>
	<body>
<?php
$animal->setCodigo(12);
$animal->setCodigoDono(6);
$animal->setNome("Cumbuquinha");
$animal->setEspecie("Coelho");
$animal->setNascimento("2013-09-03");
$animal->setSexo("M");
		
echo $tabelaAnimal->alterarDadosAnimal($animal);
?>
	</body>
</html>