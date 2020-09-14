<?php


class registro
{
	function __construct()
	{
		require_once("../database/crud.php");
	}

	public function pega_registro($id_usuario)
	{
		$crud = new Crud();
		$query = "SELECT * FROM registro WHERE usuario_id='".$id_usuario."' AND data_fim='0000-00-00 00:00:00';";
		$data = $crud->find($query);
		if(count($data) > 0){
			return $data[0];			
		} else{
			return 0;
		}
	}

	public function finaliza_registro($id, $data_fim)
	{
		$crud = new Crud();
		$query = "UPDATE registro SET data_fim='".$data_fim."' WHERE id='".$id."';";
		$crud->change($query);
	}

	public function novo_registro($usuario_id, $data_inicio, $id_projeto)
	{
		$data_fim = "0000-00-00 00:00:00";
		$crud = new Crud();
		$query = "INSERT INTO registro (data_inicio, data_fim, usuario_id, projeto_id) VALUES('".$data_inicio."', '".$data_fim."', '".$usuario_id."', '".$id_projeto."')";
		$crud->change($query);

		$query2 = "SELECT MAX(id) as 'id' FROM registro";
		$data = $crud->find($query2);
		return $data[0]['id']."---".$data_inicio;
	}

	public function relatorio_registros($mes, $ano, $usuario_id)
	{
		$periodo = $ano."-".$mes."-%";
		$crud = new Crud();
		$query = "SELECT * FROM registro WHERE usuario_id = '".$usuario_id."' AND data_inicio LIKE '".$periodo."' AND data_inicio LIKE '".$periodo."' AND data_fim != '0000-00-00 00:00:00';";
		$data = $crud->find($query);
		if(count($data) > 0){
			return $data;			
		} else{
			return 0;
		}
	}
}


?>
