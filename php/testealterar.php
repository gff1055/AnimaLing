<?php
require_once("ModelDono.php");
require_once("Dono.php");

$tabelaDono = new ModelDono();
$dono = new Dono();
?>

<html>
	<body>
<?php
$dono->setNome("Anthony");
$dono->setSobreNome("Alessandro");
$dono->setUsuario("antales");
$dono->setSenha("s@antale");
$dono->setNascimento("2018-02-23");
$dono->setSexo("M");
$dono->setEmail("anthonyalessandro@gmail.com");
$dono->setCodigo(25);
		
echo $tabelaDono->alterarDadosUsuario($dono);
?>
	</body>
</html>