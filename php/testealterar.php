<?php
require_once("donoConBD.php");
require_once("dono.php");

$tabelaDono = new DonoConBD();
$dono = new Dono();
?>

<html>
	<body>
<?php
$dono->setNome("Guilherme26");
$dono->setSobreNome("Ferreira26");
$dono->setUsuario("gff10526");
$dono->setSenha("senha26");
$objAuxData = new DateTime('2017-07-26');
$dono->setNascimento($objAuxData->format('y/m/d'));
$dono->setSexo("M");
$dono->setEmail("guilhermeferreira26@hotmal.com");
		
$tabelaDono->alteracao($dono,11);
?>
	</body>
</html>