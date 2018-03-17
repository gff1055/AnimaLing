<?php
require_once("ModelAmizade.php");
require_once("Amizade.php");

$amizade = new Amizade();
$modelAmizade = new ModelAmizade();
?>

<html>
	<body>
<?php
//$status->setCodigo(11);
//$status->setConteudo("desculpe...");
		
//echo $modelStatus->atualizarStatus($status);

$amizade->setCodigoAnimal(3);
$amizade->setCodigoAmigo(5);
$amizade->setSituacao("01");

echo $modelAmizade->adicionarAmizade($amizade);


?>
	</body>
</html>