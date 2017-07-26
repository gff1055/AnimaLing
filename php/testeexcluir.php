<?php
require_once("donoConBD.php");
require_once("dono.php");

$tabelaDono = new DonoConBD();
$dono = new Dono();
?>

<html>
	<body>
<?php
$tabelaDono->existe("usuario","user26");
?>
	</body>
</html>