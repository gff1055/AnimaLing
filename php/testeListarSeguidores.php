<?php
require_once("ModelInteracao.php");
require_once("Animal.php");
require_once("Interacao.php");

$seguidor = new Interacao();
$modelAmizade = new ModelInteracao();
$animal = new Animal();

?>

<html>
	<body>
<?php
//$status->setCodigo(11);
//$status->setConteudo("desculpe...");
		
//echo $modelStatus->atualizarStatus($status);

//echo $modelAmizade->seguirVolta($seguidor);

$animal->setCodigo(2);
$animal->setCodigoDono(8);
$animal->setNome("Fido");
$animal->setEspecie("Cão");
$animal->setSexo("F");
$animal->setNascimento("2015-11-15");

$id=5;

echo "<h3>Seguidores</h3>";

$seguidores = $modelAmizade->listarSeguidores($id);
if(!$seguidores){
	echo "<br> nao ha animigos";
}
else{
	foreach($seguidores as $seguidor){
		echo "<br>".$seguidor['nomeSeguidor']."<br>";
	}
}

echo "<h3>Voce segue</h3>";

$seguidos = $modelAmizade->listarSeguidos($id);
if(!$seguidos){
	echo "<br> nao segue ninguem";
}
else{
	foreach($seguidos as $seguido){
		echo "<br>".$seguido['nomeSeguido']."<br>";
	}
}


?>
	</body>
</html>