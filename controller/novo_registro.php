<?php

	include("../model/registroModel.php");
	ini_set('date.timezone', 'America/Sao_paulo');

	session_start();
	$d = new DateTime();
	$data_inicio = $d->format('Y-m-d H:i:s');
	$usuario_id = $_SESSION['id_usuario'];
	$registro = new Registro();

	$data = $registro->novo_registro($usuario_id, $data_inicio);
	$data = split("---", $data);
	$_SESSION['id_registro'] = $data[0];
	var_dump($data[1]);
	$_SESSION['data_inicio_registro'] = $data[1];

?>