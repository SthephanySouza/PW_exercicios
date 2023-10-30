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
		
		if(empty($_GET['txtPesq'])){
			echo "<html><script>location.href = 'index.php'</script></html>";
		}
		// criando variável para recuperar dado digitado no navbar
		$pesquisa = $_GET['txtPesq'];
		$consulta = $cn->query("select * from vwMusica where NomeMusica like concat('%','$pesquisa','%') or NomeCantor like concat('%','$pesquisa','%')");
		
		if($consulta->rowCount() == 0){
			echo "<html><script>location.href = 'error2.php'</script></html>";
		}
	?>
	
	<div class="container-fluid">
	
		<?php while($exibir = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
	
			<div class="row" style="margin-top: 15px;">
				<div class="col-sm-1 col-sm-offset-1"><img src="img/<?php echo $exibir['Capa'];?>.jpeg" class="img-responsive"></div>
				<div class="col-sm-5"><h4 style="padding-top:20px"><?php echo $exibir['NomeMusica'];?></h4></div>
				<div class="col-sm-2"><h4 style="padding-top:20px">R$ <?php echo number_format($exibir['Preco'], 2, ',', '.');?></h4></div>
			
				<div class="col-sm-2 col-xs-offset-right-1" style="padding-top:20px">
					<a href="detalhe.php?cd=<?php echo $exibir['IdMusica'];?>">
						<button class="btn btn-lg btn-block btn-default">
							<span class="glyphicon glyphicon-info-sign" style="color: cadetblue;"> Detalhes</span>
						</button>
					</a>
				</div> 
			</div>	
			
		<?php }?>
		
	</div>
	
	<?php
		include 'rodape.php';
	?>
</body>
</html>