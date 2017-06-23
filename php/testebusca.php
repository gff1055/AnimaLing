<?php
require_once("donoConBD.php");
require_once("dono.php");



//VARIAVEL DE ACESSO AO BANCO
$donoDao=new DonoConBD();
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
		<?php
			
		//VERIFICA SE GET ESTA VAZIO
		if(!empty($_GET)){
				
			//RETPRNANDO BUSCA DO USUARIO
			$resultado=$donoDao->buscaUsuario($_GET["nome"]);

			//VERIFICANDO SE HOUVE RETORNO DE RESULTADOS
			if($resultado!=0 && $resultado!=-1){
					
				//PERCORRENDO O VETOR
				foreach($resultado as $index){
					echo "<br>".$index->getUsuario();
				}
				
			}
			
			//VERIFICACAO NO CASO DE PESQUISA EM "BRANCO"
			elseif($resultado==-1){
				echo "<br> USUARIO NAO ENCONTRADO";
			}
			
			//VERIFICACAO NO CASO DE NAO HAVER OCORRENCIAS
			else{
				echo "<br> NADA A EXIBIR";
			}
		}
		
		$testFeedBack = $testRegister->checkEmail($_GET["nome"]);
		if($testFeedBack == DonoConBD::EMAIL_EXISTS)
			echo "<br>EMAIL EXISTE<br>";
		elseif($testFeedBack == DonoConBD::EMAIL_INVALID)
			echo "<br>O EMAIL INSERIDO ESTA INVALIDO<br>";
		elseif($testFeedBack == DonoConBD::EMAIL_ALLOWED)
			echo "<br>ESTE EMAIL PODE SER CADASTRADO<br>";
		else
			echo "<br>ERRO DESCONHECIDO<br>";
			
		?>
	</body>
</html>