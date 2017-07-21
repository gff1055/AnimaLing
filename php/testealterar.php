<?php
require_once("donoConBD.php");
require_once("dono.php");

$tabelaDono = new DonoConBD();
$dono = new Dono();
?>

<html>
	<body>
<?php
$dono->setNome("henrique2");
$dono->setSobreNome("dourado2");
$dono->setUsuario("henri2");
$dono->setSenha("henrisenha");
$objAuxData = new DateTime('2017-07-17');
$dono->setNascimento($objAuxData->format('y/m/d'));
$dono->setSexo("M");
$dono->setEmail("henriquedourado2@hotmal.com");
		
$tabelaDono->atualizar($dono);
?>
	</body>
</html>