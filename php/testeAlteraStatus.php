<?php
require_once("ModelStatus.php");
require_once("Status.php");

$status = new Status();
$modelStatus = new ModelStatus();
?>

<html>
	<body>
<?php
//$status->setCodigo(11);
//$status->setConteudo("desculpe...");
		
//echo $modelStatus->atualizarStatus($status);

$linhaTempo = $modelStatus->exibirTodosStatus(18888);
if(!$linhaTempo)
	echo "Sem atividade";

else

	foreach($linhaTempo as $linha){
		echo "<br><b>".$linha["nomeAnimal"]."</b>";
		echo "<br><b>".$linha["dataStatus"].": </b>";
		echo $linha["conteudo"];
	}


?>
	</body>
</html>