<?php
	// criando variáveis
	$servidor = "localhost";
	$usuario = "root";
	$senha = "3TH3ph4n1";
	$banco = "dbMusica";
	
	// variável para receber conexão
	$cn = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
?>