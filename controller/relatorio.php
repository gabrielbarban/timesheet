<?php

	include("../model/registroModel.php");
	ini_set('date.timezone', 'America/Sao_paulo');
	session_start();

	$mes_busca = $_GET["mes"];
	$ano_busca = $_GET["ano"];
	$valor_minuto = $_SESSION['valorMinuto'];
	$registro = new Registro();
	$data = $registro->relatorio_registros($mes_busca, $ano_busca);
	if(empty($data)){
		echo json_encode($data);
		exit;
	}

	$dados = array();
	$total_horas = 0;
	$total_minutos = 0;
	$i=0;
	foreach ($data as $d) {

		$dados[$i]['data_inicio'] = date("d/m/Y H:i:s", strtotime($d['data_inicio']));
		$dados[$i]['data_fim'] = date("d/m/Y H:i:s", strtotime($d['data_fim']));

		// variaveis data inicio
		$ano_inicio = substr($d['data_inicio'], 0, 4);
		$mes_inicio = substr($d['data_inicio'], 5, 2);
		$dia_inicio = substr($d['data_inicio'], 8, 2);

		$hora_inicio = substr($d['data_inicio'], 11, 2);
		$min_inicio = substr($d['data_inicio'], 14, 2);
		$seg_inicio = substr($d['data_inicio'], 17, 2);


		// variaveis data fim
		$ano_fim = substr($d['data_fim'], 0, 4);
		$mes_fim = substr($d['data_fim'], 5, 2);
		$dia_fim = substr($d['data_fim'], 8, 2);

		$hora_fim = substr($d['data_fim'], 11, 2);
		$min_fim = substr($d['data_fim'], 14, 2);
		$seg_fim = substr($d['data_fim'], 17, 2);


		$entrada = gmmktime($hora_inicio, $min_inicio, $seg_inicio, $mes_inicio, $dia_inicio, $ano_inicio);
		$saida   = gmmktime($hora_fim, $min_fim, $seg_fim, $mes_fim, $dia_fim, $ano_fim);

		$diferenca = abs( $saida - $entrada );
		$total_horas = $total_horas + $diferenca/3600;
		$total_minutos = $total_minutos + $diferenca/60%60;

		$i++;
	}

	$total_minutos = intval($total_minutos%60);

	$dados['total_horas'] = intval($total_horas);
	$dados['total_minutos'] = intval($total_minutos);
	$dados['valor_minuto'] = $valor_minuto;

	echo json_encode($dados);

?>