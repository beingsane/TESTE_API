<? 
	if(isset($id_code)){
		echo "<input type=\"hidden\" value=\"$id_code\" name=\"code[]\" />";
	}
	

	/////Nome do carro
	$this->text_input->render_input(
		"text", 
		"Nome", 
		"nome", 
		"validateName", 
		$nome, 
		array(
			"style" => "width:300px;text-transform: uppercase;", 
			"codeJs"=> '',
			"error" 	=> "", 
			"class"		=> "",
			"placeHolder" =>""
		)
	);
	
	$this->pagination->persistPagination("list_marcas");
	
	
?>
