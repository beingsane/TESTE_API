	<fieldset class="filter">
		<legend>Filtros</legend>
		<div class="left" style="margin-right: 10px">
			<?
				$this->text_input->render_input(
					"date", 
					"Data Inicial", 
					"data_inicial", 
					"", 
					$this->input->post("data_inicial"), 
					array(
						"style" => "width:100px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
			?>
		</div>
		<div class="left" style="margin-right: 10px">
			<?
				$this->text_input->render_input(
					"date", 
					"Data Final", 
					"data_final", 
					"", 
					$this->input->post("data_final"), 
					array(
						"style" => "width:100px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
			?>
		</div>
		<div class="clear"></div>
	</fieldset>
	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 24px"></th>
				<th>Produto Comprado</th>
				<th style="width: 170px">Data da compra</th>
				<th style="width: 90px">Quantidade</th>
				<th style="width: 100px">Valor</th>
				<th style="width: 110px">Total</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index		= index_page()!="" ? index_page()."/" :"";
    	$href		= "/".$index."backend/compras/edit_form";
    	$totalGeral	= 0;
		 foreach ($compras as $key => $value) {
		 	echo "<tr>";
		 		echo "<td><input class=\"mark_all checkbox_clear\" type=\"checkbox\" name=\"id_code[]\" value=\"{$value->id_compra}\" id=\"id_code-{$value->id_compra}\"> </td>";
		 		echo "<td><span id=\"id_code-$value->id_compra-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita essa compra.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->nome_grupo} {$value->nome_produto} - {$value->nome_unidade}</td>";
		 		echo "<td>{$value->data_compra}</td>";
		 		echo "<td>{$value->qtd_compra}</td>";
		 		echo "<td>R$ {$value->valor_unitario}</td>";
		 		echo "<td>R$ ".number_format($value->qtd_compra*$value->valor_unitario, 2, ',', '.')."</td>";
		 	echo "</tr>";
		 	$totalGeral += $value->qtd_compra*$value->valor_unitario;
		 }
		 
		 echo "<tr>";
		 		echo "<th colspan=\"5\"></th>";
		 		echo "<th colspan=\"2\" style=\"text-align:center\">Total Geral</th>";
		 echo "</tr>";
		 echo "<tr>";
		 		echo "<td colspan=\"5\"></td>";
		 		echo "<td colspan=\"2\" style=\"text-align:center\">R$ ".number_format($totalGeral, 2, ',', '.')."</td>";
		 echo "</tr>";
		 ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="7" style="text-align: center;">
				 <? $this->pagination->render(array("showTotal"=>true,"limitValues"=>array(10,25,40,60)));?>    
			</td>
		</tr>
	</tfoot>
	</table>
	<?
	/////Carrega o script para gerar o calendario
	?>
