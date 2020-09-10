<?php

include("../model/usuarioModel.php");
include("../model/registroModel.php");
ini_set('date.timezone', 'America/Sao_paulo');

$usuario = new Usuario();
$registro = new Registro();
$username = $_POST["username"];
$senha = $_POST["senha"];

$data = $usuario->login($username, $senha);
if($data != 0){
	session_start();
	$_SESSION['id_usuario'] = $data["id"];
	$_SESSION['nome_usuario'] = $data["nome"];
	$_SESSION['valorMinuto'] = $data["valorMinuto"];
	$_SESSION['valorHora'] = floatval($_SESSION['valorMinuto']) * 60;

	// pegando o registro do usuário
	$registros = $registro->pega_registro($_SESSION['id_usuario']);
	if(!empty($registros)){
		$_SESSION['id_registro'] = $registros["id"];
		$_SESSION['data_inicio_registro'] = $registros["data_inicio"];
	}
	header ("location: ../view/inicial.php");
} else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Usuário e/ou senha incorreto.')
	window.location.href='../index.php';
	</SCRIPT>");
}

?>