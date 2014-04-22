	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 24px"></th>
				<th>Nome</th>
				<th>Nome Usuário</th>
				<th>Email</th>
				<th style="width: 50px">Ativo</th>
				<th>Ultimo Acesso</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		
		$index	= index_page()!="" ? index_page()."/" :"";
    	$href	= "/".$index."backend/user_mig/edit";
		 foreach ($users as $key => $value) {
		 	echo "<tr>";
		 		echo "<td><input class=\"checkbox_clear\" type=\"checkbox\" name=\"cod_user[]\" value=\"{$value->idSysUsuarios}\" id=\"cod_user-{$value->idSysUsuarios}\"> </td>";
		 		echo "<td><span id=\"cod_user-$value->idSysUsuarios-img\" class=\"glyphicons edit pointer heightIcon submitFormEdit\" title=\"Edita esse usuário.\" href=\"$href\"></span> </td>";
		 		echo "<td>{$value->nomeSysUsuarios}</td>";
		 		echo "<td>{$value->userNameSysUsuarios}</td>";
		 		echo "<td>{$value->emailSysUsuarios}</td>";
		 		echo "<td  style=\"text-align: center;\">".($value->ativoSysUsuarios==1 ? '<span style="margin-top: 2px;height: 26px;" class="glyphicons ok_2 heightIcon" title="Ativo"></span>' : '<span style="margin-top: 2px;height: 26px;" class="glyphicons remove_2 heightIcon" title="Desativado"></span>')."</td>";
		 		echo "<td>{$value->date}</td>";
		 	echo "</tr>";
		 }
		 ?>
		</tbody>
	</table>
