<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<head>
	<title>Inicial</title>

	<script type="text/javascript">

		function atualiza_registro(id_registro)
      	{
	        $.ajax({
	                url: "../controller/atualiza_registro.php",
	                dataType: "json",
	                data: {
	                id: id_registro
	            },
	                success: function(data)
	                {
	                 	if(data=="OK"){
	                 		document.location.reload(true);
	                 	}
 	                }
	          });
      	}


      	function novo_registro()
      	{
	        $.ajax({
	                url: "../controller/novo_registro.php",
	                dataType: "json",
	                success: function(data)
	                {
	                 	if(data=="OK"){
	                 		document.location.reload(true);
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
	<h2><i><center>Timesheet</center></i></h2>
	<br><br><br>Olá, <b><?=$_SESSION['nome_usuario']?></b><span style='float: right; text-align: right;'><?=$data_atual?></span><hr>
	<br><br>Valor/hora: R$ <?=$_SESSION['valorHora']?><hr>

	<?php
		if(($registro_ativo) !== ""){
			$data = date("d/m/Y", strtotime($_SESSION['data_inicio_registro']));
			$horario = date("H:i:s", strtotime($_SESSION['data_inicio_registro']));
			echo "<br>Existe um registro iniciado as ".$horario.", do dia ".$data."<a href='#' onclick='atualiza_registro(".$_SESSION['id_registro'].");'><br>Finalizar registro</a>";
		} else{
			echo "<br>Nenhum registro ativo no momento.";
		}
	?>
<br><br><hr><br><br>
<a onclick="novo_registro()" href="#">Inserir registro</a>
<br><br><br>
<span style="float: right; text-align: right;"><a href="sair.php">Sair</a></span>
</body>
</html>