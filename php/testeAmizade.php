<?php
require_once("ModelInteracao.php");
require_once("Interacao.php");

$seguidor = new Interacao();
$modelAmizade = new ModelInteracao();
?>

<html>
	<body>
<?php
//$status->setCodigo(11);
//$status->setConteudo("desculpe...");
		
//echo $modelStatus->atualizarStatus($status);

$seguidor->setCodigoSeguidor(4);
$seguidor->setCodigoSeguido(1);

echo $modelAmizade->adicionarSeguidor($seguidor);


$seguidor->setCodigoSeguidor(1);
$seguidor->setCodigoSeguido(4);

echo $modelAmizade->adicionarSeguidor($seguidor);
//echo $modelAmizade->seguirVolta($seguidor);


?>
	</body>
</html>