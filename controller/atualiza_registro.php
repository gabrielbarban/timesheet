<?php

	include("../model/registroModel.php");
	ini_set('date.timezone', 'America/Sao_paulo');

	$d = new DateTime();
	$data_fim = $d->format('Y-m-d H:i:s');
	$id = $_GET["id"];
	$registro = new Registro();

	$registro->finaliza_registro($id, $data_fim);
	session_start();
	$_SESSION['id_registro'] = "";
	$_SESSION['data_inicio_registro'] = "";

?>