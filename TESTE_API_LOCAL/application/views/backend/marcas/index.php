	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 24px"></th>
				<th>Nome</th>
				<th>Data cadastro</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index	= index_page()!="" ? index_page()."/" :"";
		
    	$href	= "/".$index."backend/marcas/edit_form";
    	
		 foreach ($marcas as $key => $value) {
		 	echo "<tr>";
		 		echo "<td><input class=\"checkbox_clear\" type=\"checkbox\" name=\"code[]\" value=\"{$value->id_marca}\" id=\"code-{$value->id_marca}\"> </td>";
		 		echo "<td><span id=\"code-$value->id_marca-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita essa marca.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->name_marca}</td>";
		 		echo "<td>{$value->date_cad}</td>";
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
