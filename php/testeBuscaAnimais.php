<?php
require_once("ModelDono.php");
require_once("Dono.php");
require_once("Conexao.php");
require_once("ModelAnimal.php");


$animal = new ModelAnimal();

$buscaF = $animal->busca("zzz");

if ($buscaF == ModelAnimal::NO_RESULTS){
	echo "erro";
}
else
foreach($buscaF as $indice){
	echo "Pet: ".$indice["nomeAnimal"]."<br>";
	echo "Especie: ".$indice["especie"]."<br>";
	echo "Dono: ".$indice["nomeDono"]."<br><br>";
}



?>