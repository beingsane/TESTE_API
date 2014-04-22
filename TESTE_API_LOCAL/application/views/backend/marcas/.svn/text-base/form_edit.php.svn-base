<? 
	echo "<input type=\"hidden\" value=\"$id_code\" name=\"id_code[]\" />";
?>
<?
	/////Campo nome do produto
	$this->text_input->render_input(
		"text", 
		"Nome", 
		"name", 
		"validateName", 
		$nome_produto, 
		array(
			"style" 	=> "width:300px;text-transform: uppercase;", 
			"codeJs"	=> '',
			"error" 	=> "", 
			"class"		=> "",
			"readOnly" 	=> true
		)
	);
	/////Campo Ean do produto
	$this->text_input->render_input(
		"text", 
		"Código de barras", 
		"ean_produto", 
		"validateName", 
		$ean_produto, 
		array(
			"style" => "width:300px;text-transform: uppercase;", 
			"codeJs"=> '',
			"error" => "", 
			"class"	=> "",
			"readOnly" 	=> true
		)
	);
	/////Campo Grupo do produto
	$this->text_input->render_input(
		"text", 
		"Grupo", 
		"nome_grupo", 
		"validateName", 
		$nome_grupo, 
		array(
			"style" => "width:300px;text-transform: uppercase;", 
			"codeJs"=> '',
			"error" => "", 
			"class"	=> "",
			"readOnly" 	=> true
		)
	);
	/////Campo Unidade do produto
	$this->text_input->render_input(
		"text", 
		"Unidade", 
		"nome_Unidade", 
		"validateName", 
		$nome_unidade, 
		array(
			"style" => "width:300px;text-transform: uppercase;", 
			"codeJs"=> '',
			"error" => "", 
			"class"	=> "",
			"readOnly" 	=> true
		)
	);
	/////Campo de data da compra
	$this->text_input->render_input(
					"date", 
					"Data da compra", 
					"data_compra", 
					"", 
					$data_compra, 
					array(
						"style" => "width:100px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
	/////Campo hora da compra
	$this->text_input->render_input(
					"hour", 
					"Hora da compra", 
					"hora_compra", 
					"", 
					$hora_compra, 
					array(
						"style" => "width:60px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
	/////Campo Quantidade
	$this->text_input->render_input(
					"text", 
					"Quantidade", 
					"qtd_compra", 
					"", 
					$qtd_compra, 
					array(
						"style" => "width:60px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);		
				
	/////Campo Valor
	$this->text_input->render_input(
					"text", 
					"Valor Unitário", 
					"valor_unitario", 
					"", 
					$valor_unitario, 
					array(
						"style" => "width:60px;text-transform: uppercase;", 
						"codeJs"=> '$("#valor_unitario-8").priceFormat({prefix: "R$ ",centsSeparator: ".",thousandsSeparator: "", clearPrefix: true});', 
						"error" => "",
						"class"	=> ""
					)
				);		
				
	$this->text_area_input->render_input(
		"Descritivo", 
		"obs_compra", 
		"", 
		$obs_compra, 
		array(
			"style"	=> "width: 400px;height: 100px;",
			"codeJs"=> '', 
			"error" => ""
		)
	);
	
	$this->template_functions->setFile(_HTTP_JSPATH_."/jquery.price_format.1.7.min.js", "JAVASCRIPT", "TOP");
	$this->pagination->persistPagination("list_prods");
	$this->text_hidden->render_input("data_inicial", $this->input->post("data_inicial"),"data_inicial", $other = array("codeJs"=> "", "class"=>""));
	$this->text_hidden->render_input("data_final", $this->input->post("data_final"),"data_final", $other = array("codeJs"=> "", "class"=>""));
?>
	