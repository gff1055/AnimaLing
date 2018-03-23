<?php
require_once("ModelInteracao.php");
require_once("Interacao.php");

$seguidor = new Interacao();
$modelSeguidor = new ModelInteracao();
?>

<html>
	<body>
<?php

$seguidor->setCodigoSeguido(1);
$seguidor->setCodigoSeguidor(2);

echo $modelSeguidor->excluirSeguidor($seguidor);


?>
</body>
</html>