<?php
require_once("ModelAnimal.php");
require_once("Dono.php");

$tabelaAnimal = new ModelAnimal();
$animal = new Animal();
?>

<html>
	<body>
<?php
//$animal->setCodigo(12);
$animal->setCodigoDono(27);
$animal->setNome("Fido");
$animal->setEspecie("Porquinho da India");
$animal->setNascimento("2012-08-02");
$animal->setSexo("M");
		
echo $tabelaAnimal->inserirAnimal($animal);
?>
	</body>
</html>