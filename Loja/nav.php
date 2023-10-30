<nav class="navbar navbar-inverse">		<!-- default inverse -->
		
	<div class="container-fluid">
  
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
					
			<a class="navbar-brand" href="#">Mewzics</a>
		</div>
	
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<!-- class="active" coloca cor atrás das palavras -->
				<li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
				<li><a href="lanc.php">Lançamentos</a></li>
				<li class="dropdown">
						
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gêneros<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="categ.php?cat=Pop rock">Pop rock</a></li>
						<li><a href="categ.php?cat=Rock">Rock</a></li>
						<li><a href="categ.php?cat=New wave">New wave</a></li>
						<li><a href="categ.php?cat=Soul">Soul</a></li>
						
						<!-- <li role="separator" class="divider"></li> -->
						<li><a href="categ.php?cat=MPB">MPB</a></li>
						
						<!-- <li role="separator" class="divider"></li> -->
						<li><a href="categ.php?cat=Arena rock">Arena rock</a></li>
					</ul>
				</li>
			</ul>
	  
			<form class="navbar-form navbar-left" role="search" name="pesq" method="get" action="busca.php">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Buscar" name="txtPesq" />
				</div>
						
				<button type="submit" class="btn btn-default">Pesquisar</button>
			</form>
	  
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Contato</a></li>
					
				<?php if(empty($_SESSION['ID'])){ ?>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Log-in</a></li>	<!-- indica caso a sessão esteja vazia -->
				<?php } else{	// se não verificar se...
				
					if($_SESSION['Status'] == 0){	// o status estiver com valor 0, mostrar o nome do usuário e o logoff
						$consultaUsu = $cn->query("select NomeUsu from tbUsuario where CodUsu = '$_SESSION[ID]'");
						$exibeUsu = $consultaUsu->fetch(PDO::FETCH_ASSOC);
						?>
				
						<li><a href="#"><span class="glyphicon glyphicon-user"> <?php echo $exibeUsu['NomeUsu'];?></a></li>				
						<li><a href="logoff.php"><span class="glyphicon glyphicon-log-out"> Logoff</a></li>
						
					<?php } else{ ?>	<!-- o status estiver com o valor 1, mostrar o também o botão de admin -->
					
						<li><a href="menuAdmin.php"><button class="btn btn-sm btn-danger">Admin</button></a></li>				
						<li><a href="logoff.php"><span class="glyphicon glyphicon-log-out"> Logoff</a></li>
				<?php } } ?>
				
				<!-- <li class="dropdown">
						
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>	
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li> -->
			</ul>
		</div>		<!-- /.navbar-collapse -->
	</div>		<!-- /.container-fluid -->
</nav>