<?php
require_once("ModelStatus.php");

$statEncontr = new ModelStatus();
$resultado = $statEncontr->busca(" ");

if($resultado == ModelStatus::NO_RESULTS){
		echo "sem ocorrencia";
}
else{
	foreach($resultado as $status){
		echo "<b>".$status["nomeAnimal"]." :</b> ".$status["acontAgora"]."<br>";
	}
}


?>