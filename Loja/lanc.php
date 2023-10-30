<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Minha loja</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width-device-width, initial-scale=1" />
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery livraria -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- JavaScript compilado-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style type="text/css">
		.navbar{margin-bottom: 0;}
	</style>
</head>

	<body>
	
		<?php
			// inicia uma sessão de cadastro do usuário
			session_start();
			
			// inclusão de arquivos
			include 'conexao.php';
			include 'nav.php';
			include 'cabecalho.php';
			
			// criando variáveis para receber a $cn e para receber o resultado da query
			$consulta = $cn->query('select IdMusica, NomeMusica, Preco, Capa, QtdEstoque from vwMusica where DispoEstoque = "S"');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<?php
					while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)){
				?>
				
				<!-- o butstrap divide a tela em 12 colunas -->
				
				<div class="col-sm-3">	<!-- coloca em uma linha 4 colunas -->
					<img src="img/<?php echo $exibe['Capa'];?>.jpeg" class="img-responsive" style="width: 100%; height: 220px;">
					
					<!-- limitação de caracteres -->
					<div><h4><b><?php echo mb_strimwidth($exibe['NomeMusica'], 0, 30, '...');?></b></h4></div>
					
					<!-- Formatação de números -->
					<div><h3>R$ <?php echo number_format($exibe['Preco'], 2, ',', '.');?></h3></div>
					
					<!-- criando botões de info e compra -->
					<div class="text_center">
						<a href="detalhe.php?cd=<?php echo $exibe['IdMusica'];?>">
							<button class="btn btn-lg btn-block btn-default">
								<span class="glyphicon glyphicon-info-sign" style="color: cadetblue;"> Detalhes</span>
							</button>
						</a>
					</div>
					
					<!-- criando botões de compra -->
					<div class="text_center" style="margin-top: 5px; margin-bottom: 5px;">
						<?php if($exibe['QtdEstoque'] > 0){?>
							<a href="carrinho.php?cd=<?php echo $exibe['IdMusica'];?>">
								<button class="btn btn-lg btn-block btn-info">
									<span class="glyphicon glyphicon-usd"> Comprar</span>
								</button>
							</a>
						<?php } else{ ?>
						
							<button class="btn btn-lg btn-block btn-danger" disabled>
								<span class="glyphicon glyphicon-remove-cicle"> Indisponivel</span>
							</button>
							
						<?php }?>
					</div>
				</div>
				
				<?php
					}
				?>
			</div>
		</div>
		
		<?php
			include 'rodape.php';
		?>
	</body>
</html>