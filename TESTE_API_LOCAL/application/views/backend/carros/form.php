<? 
	if(isset($id_code)){
		echo "<input type=\"hidden\" value=\"$id_code\" name=\"code[]\" />";
	}
	

	/////Nome do carro
	$this->text_input->render_input(
		"text", 
		"Modelo", 
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
	/////Crop para a imagem
	$this->jcrop_add->create("image","Imagem",300,200,($image ? $image : ""),"margin-top:10px","Selecione uma imagem para o modelo do Veículo");
	
	
	/////Campo Marcas
	$this->select_input->render_input(
		"Marca", 
		"marca", 
		"validateSelect", 
		$marcas, 
		$marca, 
		array(
			"style" => "", 
			"codeJs"=> "", 
			"error" => "", 
			"class" => ""
		)
	);
	
	/////Campo ano
	$this->text_input->render_input(
					"year", 
					"Ano", 
					"ano", 
					"", 
					$ano, 
					array(
						"style" => "width:100px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);

	if(!isset($alter_value) || $alter_value){
		/////Campo Valor de de venda
		$this->text_input->render_input(
				"text", 
				"Valor de Venda", 
				"valor", 
				"validateNumber", 
				$valor, 
				array(
					"style" => "width:200px", 
					"codeJs" => '$("#validateNumber-3").priceFormat({prefix: "R$ ",centsSeparator: ".",thousandsSeparator: "", clearPrefix: true});', 
					"error"=>"", 
					"class"=>""
				)
		);
	}
	/////MAX de parcelas
	$parcelas 	= array();
	$parcelas[] = array("label" => "3x", 	"value" => 3);
	$parcelas[] = array("label" => "6x",	"value" => 6);
	$parcelas[] = array("label" => "12x",	"value" => 12);
	$this->select_input->render_input(
		"Max de Pareclas", 
		"parcela", 
		"validateSelect", 
		$parcelas, 
		$parcela, 
		array(
			"style" => "", 
			"codeJs"=> "", 
			"error" => "", 
			"class" => ""
		)
	);
	$this->template_functions->setFile(_HTTP_JSPATH_."/jquery.price_format.1.7.min.js", "JAVASCRIPT", "TOP");
	$this->pagination->persistPagination("list_carros");
	
	
?>
