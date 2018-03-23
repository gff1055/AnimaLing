<?php
require_once("ModelDono.php");
require_once("Dono.php");

$tabelaDono = new ModelDono();
$dono = new Dono();
?>

<html>
	<body>
<?php
$dono->setNome("Alex");
$dono->setSobreNome("Alison");
$dono->setSenha("s@aleali");
$dono->setNascimento('2014-04-23');
$dono->setSexo("M");
$dono->setEmail("alexalison@gmal.com");

		
echo $tabelaDono->inserirUsuario($dono);
?>
	</body>
</html>