<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<head>
	<title>Relatorio</title>

	<script type="text/javascript">

		function relatorio(id_registro)
      	{
      		var mes = $("#mes").val();
      		var ano = $("#ano").val();
      		var i = 0;

	        $.ajax({
	                url: "../controller/relatorio.php",
	                dataType: "json",
	                data: {
	                mes: mes,
	                ano: ano
	            },
	                success: function(data)
	                {
						response = Object.entries(data);

						if(response.length == 0){
							console.log("caiu aqui");
							$("#resultado").html("Não existe nenhum registro nesse periodo.");
							$("#total").html("");
						} else{
							total_horas = response[response.length-3][1];
							total_minutos = response[response.length-2][1];
							valor_minuto = response[response.length-1][1];
		                	
		                	total_trabalhado = (total_horas*60) + total_minutos;
		                	valor_total = total_trabalhado * valor_minuto;
		                 	
		                 	for(i=0 ; i<(response.length-3) ; i++){
		                 		$("#resultado").append("Registro "+(i+1)+":<br><b>Entrada: </b>"+response[i][1]['data_inicio']+" - <b>Saída: </b>"+response[i][1]['data_fim']+"<br><br>");
		                 	}

		                	$("#total").append("Total: "+total_horas+" horas e "+total_minutos+" minutos.<br><br><b>Valor: R$ "+valor_total+"</b><br><br><input type='button' value='Imprimir' onClick='window.print()'/>");
						}	                 	
 	                }
	        });
      	}

	</script>
</head>
<body>
	<?php
		session_start();
		$registro_ativo = empty($_SESSION['id_registro']) ? "" : $_SESSION['id_registro'];
		ini_set('date.timezone', 'America/Sao_paulo');
		$d = new DateTime();
		$data_atual = $d->format('d/m/Y H:i:s');
	?>
	<h2><i><center>Relatórios - Timesheet</center></i></h2>
	<br><br>Olá, <b><?=$_SESSION['nome_usuario']?></b><span style='float: right; text-align: right;'><?=$data_atual?></span><hr>
	
	<br><br>

<select name="mes" id="mes">
	<option value="01">Janeiro</option>
	<option value="02">Fevereiro</option>
	<option value="03">Março</option>
	<option value="04">Abril</option>
	<option value="05">Maio</option>
	<option value="06">Junho</option>
	<option value="07">Julho</option>
	<option value="08">Agosto</option>
	<option value="09">Setembro</option>
	<option value="10">Outubro</option>
	<option value="11">Novembro</option>
	<option value="12">Dezembro</option>
</select>

<select name="ano" id="ano">
	<option value="2020">2020</option>
	<option value="2019">2019</option>
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
</select> <button onclick='relatorio()'>Buscar registros</button>

<br><br><br>

<div id="resultado"></div>
<br><br>
<div id="total"></div>

<br><br><br>
<a href="inicial.php">Voltar</a>
<br><br>
<span style="float: right; text-align: right;"><a href="sair.php">Sair</a></span>
</body>
</html>