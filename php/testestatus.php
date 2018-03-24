<?php
require_once("ModelStatus.php");
require_once("Status.php");

$status = new Status();
$modelStatus = new ModelStatus();
?>

<html>
	<body>
<?php
$status->setCodigo(12);
$status->setConteudo("Porcaria de sono ja foi embora :(...");
		
echo $modelStatus->atualizarStatus($status);
?>
	</body>
</html>