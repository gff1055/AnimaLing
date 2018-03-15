<?php
require_once("ModelDono.php");
require_once("Dono.php");

$tabelaDono = new ModelDono();
$dono = new Dono();
?>

<html>
	<body>
<?php
$dono->setNome("temp");
$dono->setSobreNome("Bellucci3");
$dono->setUsuario("temporario");
$dono->setSenha("abelbellucci");
$dono->setNascimento('2015-05-24');
$dono->setSexo("M");
$dono->setEmail("temporario@hotmal.com");
$dono->setCodigo(896);
		
echo $tabelaDono->alterarDadosUsuario($dono);
?>
	</body>
</html>