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



$seguidores = $modelAmizade->listarSeguidores($animal);
if(!$seguidores){
	echo "<br> nao ha inimigos";
}
else{
	foreach($seguidores as $seguidor){
		echo "<br>".$seguidor['seguidor']."<br>";
	}
}


?>
	</body>
</html>