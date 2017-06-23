<?php
$testRegister=new DonoConBD();
?>

<html>
	<head>
	</head>
	<body>
		<form action="testebusca.php" method="GET">
			<input type="text" name="nome" />
			<!--input type="text" name="sobrenome" />
			<input type="text" name="usuario" /-->
			<input type="submit" />
		</form>
	</body>
	<?php
	$testFeedBack = $testRegister->checkEmail("b@eu.com.br");
		if($testFeedBack == DonoConBD::EMAIL_EXISTS)
			echo "<br>EMAIL EXISTE<br>";
		elseif($testFeedBack == DonoConBD::EMAIL_INVALID)
			echo "<br>O EMAIL INSERIDO ESTA INVALIDO<br>";
		elseif($testFeedBack == DonoConBD::EMAIL_ALLOWED)
			echo "<br>ESTE EMAIL PODE SER CADASTRADO<br>";
		else
			echo "<br>ERRO DESCONHECIDO<br>";
	?>
</html>