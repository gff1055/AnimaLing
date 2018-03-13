<?php
require_once("ModelStatus.php");

$statEncontr = new ModelStatus();
$statEncontr->busca("a");

if($statEncontr == ModelStatus::NO_RESULTS){
		echo "sem ocorrencia";
}
else{
	foreach($statEncontr as $status){
		echo 
	}
}


?>