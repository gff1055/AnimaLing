<?php
require_once("donoConBD.php");
require_once("dono.php");

//CRIACAO DE INSTANCIA DA CLASSE DonoConBD(Classe DAO)
$donoDao=new DonoConBD();
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
			$resultado=$donoDao->buscaUsuario($_GET["nome"]);
			
			//VERIFICANDO SE HOUVE RETORNO DE RESULTADOS
			switch($resultado){
							
				//VERIFICACAO NO CASO DE NAO HAVER OCORRENCIAS
				case DonoConBD::NO_RESULTS:
					echo "<br> USUARIO NAO ENCONTRADO";
					break;
					
				//VERIFICACAO NO CASO DE PESQUISA EM "BRANCO"
				case DonoConBD::BLANK:
					echo "<br> NADA A EXIBIR";
					break;
						
				default:
					//MOSTRANDO OS RESULTADOS
					foreach($resultado as $index){
						echo "<br>".$index->getCodigo();
						echo "<br>".$index->getUsuario();
						echo "<br>".$index->getSenha();
						echo "<br>".$index->getNome();
						echo "<br>".$index->getSobrenome();
						echo "<br>".$index->getNascimento();
						echo "<br>".$index->getEmail()."<br>";
						echo "<br>---------------------------------------------------------------<br>";
					}
					break;
			}
		}
		
		
			
		?>
	</body>
</html>