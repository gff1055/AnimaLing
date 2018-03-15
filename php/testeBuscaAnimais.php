<?php
require_once("ModelDono.php");
require_once("Dono.php");
require_once("Conexao.php");
require_once("ModelAnimal.php");


$animal = new ModelAnimal();

$buscaF = $animal->buscarAnimal("a");

if ($buscaF == ModelAnimal::NO_RESULTS){
	echo "erro";
}
else
foreach($buscaF as $indice){
	echo "Pet: ".$indice["nomeAnimal"]."<br>";
	echo "Especie: ".$indice["especie"]."<br>";
	echo "Dono: ".$indice["nomeDono"]."<br><br>";
}

echo "<br>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br>";

$indice2 = $animal->exibirDadosAnimal(7);

if($indice2==ModelAnimal::NO_RESULTS){
	echo "<b>Erro<br>";

}

else
//foreach($perfil as $indice2)
{
	echo "Pet: ".$indice2["nomeAnimal"]."<br>";
	echo "Especie: ".$indice2["especie"]."<br>";
	echo "Sexo: ".$indice2["sexo"]."<br>";
	echo "Dono: ".$indice2["dataNascimento"]."<br>";
	echo "Dono: ".$indice2["usuario"]."<br><br>";
}


?>