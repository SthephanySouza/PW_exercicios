<div class="container-fluid">
	
	<div class="row text-center" style="margin-top: 15px;">
		<h1>Carrinho de Compras</h1>
	</div>
	
	
	<?php
	
	$total = null; // variavel total que recebe valor nulo

    // criando um loop para sessão carrinho recebe o $cd e a quantidade
    foreach ($_SESSION['carrinho'] as $cd => $qnt)  {
    $consulta = $cn->query("SELECT * FROM tbMusica WHERE IdMusica='$cd'");
    $exibe = $consulta->fetch(PDO::FETCH_ASSOC);

    $musica = $exibe['NomeMusica'];  // variável que recebe o livro
    $preco = number_format(($exibe['Preco']),2,',','.'); // variável que recebe o preço
    $total += $exibe['Preco'] * $qnt; // variável que recebe preço * quantidade
	
	?>
	
	
	
	
	
	<div class="row" style="margin-top: 15px;">
		
		
		
		<div class="col-sm-1 col-sm-offset-1">
			<img src="img/<?php echo $exibe['Capa']; ?>" class="img-responsive">
		</div>
		
		
		<div class="col-sm-4">
			<h4 style="padding-top:20px"><?php echo $musica; ?></h4>
		</div>	
		
		
		<div class="col-sm-2">
			<h4 style="padding-top:20px">R$ <?php echo $preco; ?></h4>
		</div>		
		<div class="col-sm-2" style="padding-top:20px">
			<h4><?php echo $qnt; ?> </h4>
		</div>
		
		<div class="col-sm-1 col-xs-offset-right-1" style="padding-top:20px">
		
		<!--remove o item do carrinho pelo id -->
		<a href="removeCarrinho.php?cd=<?php echo $cd;?>">	
		<button class="btn btn-lg btn-block btn-danger">
		<span class="glyphicon glyphicon-remove"></span>		
		</button>
			</a>
		</div> 
				
	</div>	
	
	
	<?php } ?>