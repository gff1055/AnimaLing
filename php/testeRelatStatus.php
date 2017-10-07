<?php
require_once("ModelStatus.php");
require_once("Status.php");

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8">
</head>
<body>

	<?php

	$vModelStatus = new ModelStatus();
	$vStatus = new Status();
	$vetStatus = $vModelStatus->exibirTodosStatus(4);

	foreach($vetStatus as $indice){
		echo $indice->nome."<br>";
		echo $indice->conteudo."<br>";
		echo $indice->dataStatus."<br>";

	}

	?>

	isso é um teste


</body>
</html>

<?php ?>