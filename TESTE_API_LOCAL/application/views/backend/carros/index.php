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
				<th>Valor Total (Taxa de 0,7% am)</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index	= index_page()!="" ? index_page()."/" :"";
		
    	$href	= "/".$index."backend/carros/edit_form";
    	
		 foreach ($cars as $key => $value) {
		 	$totalJuros = $value->parc_number*0.7;
		 	$valorJuros	= $value->value_car*($totalJuros/100);
		 	echo "<tr>";
		 		echo "<td><input class=\"checkbox_clear\" type=\"checkbox\" name=\"code[]\" value=\"{$value->id_car}\" id=\"code-{$value->id_car}\"> </td>";
		 		echo "<td><span id=\"code-$value->id_car-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita esse carro.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->name_car}</td>";
		 		echo "<td>{$value->name_marca}</td>";
		 		echo "<td><img src="._HTTP_IMGPATH_."/carros/{$value->img} width=\"100\"/></td>";
		 		echo "<td>R$ ".number_format($value->value_car, 2, ',', '.')."</td>";
		 		echo "<td>{$value->parc_number}</td>";
		 		echo "<td>R$ ".number_format(($value->value_Total_interest), 2, ',', '.')."</td>";
		 	echo "</tr>";
		 }
		 ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="8" style="text-align: center;">
				 <? $this->pagination->render(array("showTotal"=>true,"limitValues"=>array(10,25,40,60)));?>    
			</td>
		</tr>
	</tfoot>
	</table>
