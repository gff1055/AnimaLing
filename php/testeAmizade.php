<?php
require_once("ModelSeguidor.php");
require_once("Seguidor.php");

$seguidor = new Seguidor();
$modelAmizade = new ModelSeguidor();
?>

<html>
	<body>
<?php
//$status->setCodigo(11);
//$status->setConteudo("desculpe...");
		
//echo $modelStatus->atualizarStatus($status);

$seguidor->setCodigoSeguidor(5);
$seguidor->setCodigoAnimal(1);
$seguidor->setSituacao("01");

echo $modelAmizade->adicionarSeguidor($seguidor);
echo $modelAmizade->seguirVolta($seguidor);


?>
	</body>
</html>