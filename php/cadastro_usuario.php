<?php
require_once("donoConBD.php");
require_once("dono.php");

$testRegister=new DonoConBD();
$owner=new Dono();
?>

<html>
	<head>
		<link rel="stylesheet" href="../js/jquery-ui.css" />
		<script src="../js/jquery-1.8.2.js"></script>
		<script src="../js/jquery-ui.js"></script>
		<script src="../js/cadastro_usuario.js"></script>
	</head>
	<body>
	<!--	<form action="cadastro_usuario.php" method="POST">
			<label for="firstName">Nome:</label><input type="text" name="firstName" id="firstName"/><br>
			<label for="lastName">Sobrenome:</label><input type="text" name="lastName" id="lastName"/><br>
			<label for="user">Usuario:</label><input type="text" name="user" id="user"/><br>
			<label for="password">Senha:</label><input type="text" name="password" id="password"/><br>
			<label for="birthday">Nascimento:</label>
			<input type="text" name="birthday" id="birthday"/><br>
			<label for="genre">Nascimento:</label>
			<select id="genre">
				<option value="M"> Masculino </option>
				<option value="F"> Feminino </option>
			</select>
			<label for="email">Email:</label><input type="text" name="email" id="email"/><br><br>
			<input type="submit" />
		</form>-->
	</body>
	<?php
	
		
	$owner->setNome("firstName");
	$owner->setSobreNome("lastName");
	$owner->setUsuario("user");
	$owner->setSenha("password");
	$objAuxData = new DateTime('2017-07-17');
	$owner->setNascimento($objAuxData->format('y/m/d'));
	$owner->setNascimento("2012-17-07");
	$owner->setSexo("F");
	$owner->setEmail("email@email.com");
		
	$testRegister->cadastrar($owner);
		
		/*switch($testFeedBack){
			
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
				
		}*/
	
	?>
</html>