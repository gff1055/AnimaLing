<?php
require_once("ModelStatus.php");
require_once("Status.php");

$status = new Status();
$modelStatus = new ModelStatus();
?>

<html>
	<body>
<?php
$status->setCodigoAnimal(7);
$status->setDataStatus(Status::NOVO_STATUS);
$status->setConteudo("Com muito sono...");
		
echo $modelStatus->inserirStatus($status);
?>
	</body>
</html>