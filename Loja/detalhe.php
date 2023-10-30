<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Mewzics</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
	<style>
		.navbar{
			margin-bottom: 0;
		}
	</style>
</head>

<body>	
	
	<?php
		session_start();
	
		include 'conexao.php';	
		include 'nav.php';
		include 'cabecalho.php';
		
		if(!empty($_GET['cd'])){	// caso a variável cd não esteja vazia
			// variáveis para chamar as informações das músicas
			$codMusica = $_GET['cd'];
			$consulta = $cn->query("select * from vwMusica where IdMusica = '$codMusica'");
			$exibir = $consulta->fetch(PDO::FETCH_ASSOC);
		}
		
		else{
			header('location:index.php');
		}
	?>
	
	<div class="container-fluid">
	
		<div class="row">
		
			<div class="col-sm-4 col-sm-offset-1">
				<h1>Detalhes do Produto</h1>
			
				<img src="img/<?php echo $exibir['Capa'];?>.jpeg" class="img-responsive" style="width:100%;">
			</div>
		</div>
		
 		<div class="col-sm-7"><h1><?php echo $exibir['NomeMusica'];?></h1>
			<p>Gênero musical: <?php echo $exibir['Genero'];?></p>
			<p>Album: <?php echo $exibir['Album'];?></p>
			<p>Nome do cantor: <?php echo $exibir['NomeCantor'];?></p>
			<p>R$ <?php echo number_format($exibir['Preco'], 2, ',', '.');?></p>
			
			<button class="btn btn-lg btn-success">Comprar</button>
		</div>		
	</div>
	
	<?php
		include 'rodape.php';
	?>
	
</body>
</html>