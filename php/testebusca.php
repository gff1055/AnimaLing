<?php
require_once("ModelDono.php");
require_once("Dono.php");

//CRIACAO DE INSTANCIA DA CLASSE DonoConBD(Classe DAO)
$donoDao=new ModelDono();
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
				
			//FAZENDO BUSCA POR USUARIO
			$resultado=$donoDao->buscarUsuario($_GET["nome"]);
			
			//VERIFICANDO SE HOUVE RETORNO DE RESULTADOS
			switch($resultado){
							
				//VERIFICACAO NO CASO DE NAO HAVER OCORRENCIAS
				case ModelDono::NO_RESULTS:
					echo "<br> USUARIO NAO ENCONTRADO";
					break;
					
				//VERIFICACAO NO CASO DE PESQUISA EM "BRANCO"
				case ModelDono::BLANK:
					echo "<br> NADA A EXIBIR";
					break;
						
				default:
					//MOSTRANDO OS RESULTADOS
					foreach($resultado as $index){
						echo "<br> <b>codigo</b>: ".$index["codigo"];
						echo "<br> <b>usuario</b>: ".$index["usuario"];
						echo "<br> <b>senha</b>: ".$index["senha"];
						echo "<br> <b>nome</b>: ".$index["nome"];
						echo "<br> <b>sobrenome</b>: ".$index["sobrenome"];
						echo "<br> <b>nascimento</b>: ".$index["nascimento"];
						echo "<br> <b>sexo</b>: ".$index["sexo"];
						echo "<br> <b>email</b>: ".$index["email"];
						
						echo "<br>---------------------------------------------------------------<br>";
					}
					break;
			}
		}

		echo "<h1>USUARIO BUSCADO POR MIM</h1>";
		
		$index = $donoDao->exibirDadosUsuario("user2");
		if($index==ModelDono::NO_RESULTS)
			echo "ERRO 404: NAO ENCONTRADO";
		else{

			echo "<br> <b>codigo</b>: ".$index["codigo"];
			echo "<br> <b>usuario</b>: ".$index["usuario"];
			echo "<br> <b>senha</b>: ".$index["senha"];
			echo "<br> <b>nome</b>: ".$index["nome"];
			echo "<br> <b>sobrenome</b>: ".$index["sobrenome"];
			echo "<br> <b>nascimento</b>: ".$index["nascimento"];
			echo "<br> <b>sexo</b>: ".$index["sexo"];
			echo "<br> <b>email</b>: ".$index["email"];
			echo "<br>---------------------------------------------------------------<br>";
		}
		
		
			
		?>
	</body>
</html>