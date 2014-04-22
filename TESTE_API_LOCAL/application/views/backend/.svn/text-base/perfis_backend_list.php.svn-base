	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 24px"></th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Atributos</th>
				<th style="width: 50px">Ativo</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index	= index_page()!="" ? index_page()."/" :"";
    	$href	= "/".$index."backend/perfis_mig/edit";
		 foreach ($perfis as $key => $value) {
		 	echo "<tr>";
		 		echo "<td><input class=\"checkbox_clear\" type=\"checkbox\" name=\"cod_perfil[]\" value=\"{$value->idSysPerfil}\" id=\"cod_perfil-{$value->idSysPerfil}\"> </td>";
		 		echo "<td><span id=\"cod_perfil-$value->idSysPerfil-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita esse perfil.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->nameSysPerfil}</td>";
		 		echo "<td>{$value->descSysPerfil}</td>";
		 		echo "<td>{$value->attributesSysPerfil}</td>";
		 		echo "<td  style=\"text-align: center;\">".($value->ativoSysPerfil==1 ? '<span style="margin-top: 2px;height: 26px;" class="glyphicons ok_2 heightIcon" title="Ativo"></span>' : '<span style="margin-top: 2px;height: 26px;" class="glyphicons remove_2 heightIcon" title="Desativado"></span>')."</td>";
		 	echo "</tr>";
		 }
		 ?>
		</tbody>
	</table>
