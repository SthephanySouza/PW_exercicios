<?php
	// inserindo conexão com o banco de dados
	include 'conexao.php';
	
	// criando variáveis
	$nome = $_POST['txtNome'];
	$email = $_POST['txtEmail'];
	$senha = $_POST['txtSenha'];
	$endereco = $_POST['txtEndereco'];
	$cidade = $_POST['txtCidade'];
	$CEP = $_POST['txtCep'];
	
	/* testando exibição dos dados das variáveis
	echo $nome.'<br>';
	echo $email.'<br>';
	echo $senha.'<br>';
	echo $endereco.'<br>';
	echo $cidade.'<br>';
	echo $CEP.'<br>'; */
	
	$consulta = $cn->query("select Email from tbUsuario where Email = '$email'");
	$exibe = $consulta->fetch(PDO::FETCH_ASSOC);
	
	// verificando se o usuário já existe
	if($consulta->rowCount() == 1){
		// echo 'Email já cadastrado';
		
		header('location: error1.php');
	}
	
	else{
		// echo 'Usuário pode ser cadastrado';
		
		$incluir = $cn->query(
			"insert into tbUsuario(NomeUsu, Email, Senha, DsStatus, Endereco, Cidade, CEP) values ('$nome', '$email', '$senha', 0, '$endereco', '$cidade', '$CEP')"
		);
		
		header('location: cadastrado.php');
	}
	
?>