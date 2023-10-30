<?php
	// incluindo a conexão comn o banco de dados
	include 'conexao.php';
	
	// inicia uma sessão de cadastro do usuário
	session_start(); 
	
	// variáveis para receber valores das text box
	$email = $_POST['txtEmail'];
	$senha = $_POST['txtSenha'];
	
	/* echo $email.'<br>';
	echo $senha.'<br>'; */
	
	// vvalidando se o usuário já está cadastrado
	$consulta = $cn->query("select CodUsu, NomeUsu, Email, Senha, DsStatus from tbUsuario where Email = '$email' and Senha = '$senha'");
	
	if($consulta->rowCount() == 1){		// rowCount - verifica se o usuário existe ou não
		// echo 'Usuário está cadastrado';
		$exibeUsu = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($exibeUsu['DsStatus'] == 0){
			$_SESSION['ID'] = $exibeUsu['CodUsu'];
			$_SESSION['Status'] = 0;
			
			// redirecionando usuário para página inicial
			header('location: index.php');
		}
		
		else{
			$_SESSION['ID'] = $exibeUsu['CodUsu'];
			$_SESSION['Status'] = 1;
			
			// redirecionando usuário para página inicial
			header('location: index.php');
		}
	}
	
	else{
		// echo 'Usuário não cadastrado';
		header('location: error.php');
	}
?>