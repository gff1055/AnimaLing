<?php
$testRegister=new DonoConBD();
?>

<html>
	<head>
		<link rel="stylesheet" href="/js/jquery-ui.css" />
		<script src="/js/jquery-1.8.2.js"></script>
		<script src="/js/jquery-ui.js"></script>
	</head>
	<body>
		<form action="cadastro_usuario.php" method="POST">
			<label for="firstName">Nome:</label><input type="text" name="firstName" id="firstName"/><br>
			<label for="lastName">Sobrenome:</label><input type="text" name="lastName" id="lastName"/><br>
			<label for="user">Usuario:</label><input type="text" name="user" id="user"/><br>
			<label for="password">Senha:</label><input type="text" name="password" id="password"/><br>
			<label for="birthday">Nascimento:</label>
			<input type="text" name="birthday" id="birthday"/><br>
			<label for="email">Email:</label><input type="text" name="email" id="email"/><br><br>
			<input type="submit" />
		</form>
	</body>
	<?php
	if(!empty($_POST)){
		
		switch($testFeedBack){
			
			case DonoConBD::EMAIL_EXISTS:
				echo "<br>EMAIL EXISTE<br>";
				break;
			case DonoConBD::EMAIL_INVALID:
				echo "<br>O EMAIL INSERIDO ESTA INVALIDO<br>";
				break;
			case DonoConBD::EMAIL_ALLOWED:
				echo "<br>ESTE EMAIL PODE SER CADASTRADO<br>";
				break;
			default:
				echo "<br>ERRO DESCONHECIDO<br>";
				break;
				
		}
	}
	?>
</html>