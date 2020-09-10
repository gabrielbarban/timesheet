<?php  

class usuario
{
	function __construct()
	{
		require_once("../database/crud.php");
	}

	public function login($usuario, $senha)
	{
		$crud = new Crud();
		$query = "SELECT * FROM usuario WHERE username='".$usuario."' AND senha='".$senha."';";
		$data = $crud->find($query);
		if(count($data) > 0){
			return $data[0];			
		} else{
			return 0;
		}
	}
}

?>