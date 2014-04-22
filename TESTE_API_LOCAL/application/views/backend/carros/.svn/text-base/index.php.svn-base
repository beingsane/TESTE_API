	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 24px"></th>
				<th>Nome</th>
				<th>Marca</th>
				<th>Imagem</th>
				<th>Valor</th>
				<th>Total Parcelas</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index	= index_page()!="" ? index_page()."/" :"";
		
    	$href	= "/".$index."backend/car/edit";
    	
		 foreach ($cars as $key => $value) {
		 	echo "<tr>";
		 		echo "<td><input class=\"checkbox_clear\" type=\"checkbox\" name=\"cod_user[]\" value=\"{$value->id_car}\" id=\"cod_user-{$value->id_car}\"> </td>";
		 		echo "<td><span id=\"cod_user-$value->id_car-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita esse carro.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->name_car}</td>";
		 		echo "<td>{$value->name_brand}</td>";
		 		echo "<td>{$value->img}</td>";
		 		echo "<td>{$value->value_car}</td>";
		 		echo "<td>{$value->parc_number}</td>";
		 	echo "</tr>";
		 }
		 ?>
		</tbody>
	</table>
