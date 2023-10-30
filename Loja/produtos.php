<!DOVTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<title>Teste</title>
</head>

	<body>
		<?php
		// incluindo arquivo
			include 'conexao.php';
			
			// criando variáveis para receber a $cn e para receber o resultado da consulta
			$consulta = $cn->query('select * from vwMusica');
			while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)){
			
				echo $exibe['NomeMusica'].'<br>';
				echo $exibe['Preco'].'<br>';
				echo $exibe['Genero'].'<br>';
				echo '<hr>';
			}
		?>
</body>
</html>