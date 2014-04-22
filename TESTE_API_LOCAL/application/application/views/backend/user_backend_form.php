<? 
	if(isset($cod_user)){
		echo "<input type=\"hidden\" value=\"$cod_user\" name=\"cod_user[]\" />";
	}
	$this->text_input->render_input("text","Nome","name","validateName",$name,array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
	$this->text_input->render_input("text","Nome Usuário","name_user","validateName",$name_user,array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
	$this->text_input->render_input("text","Email","email","validateEmail",$email,array("style"=>"width:350px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
	$this->text_input->render_input("password","Senha","pass_1","validateSenha","",array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
	$this->text_input->render_input("password","Confirmação da Senha","pass_2","validateSenha","",array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
?>
<h4 style="font-size: 20px;padding: 15px 0px 6px;">Perfis</h4>
	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"><input type="checkbox" name="mark_all" class="mark_all_checkbox" value="" id="mark_all"></th>
				<th>Nome</th>
				<th>Desc</th>
				<th style="width: 50px">Ativo</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		 foreach ($perfis as $key => $value) {
		 	$checked = (in_array($value->idSysPerfil, $cod_perfil) ? "checked" : "");
		 	
		 	echo "<tr>";
		 		echo "<td><input class=\"mark_all\" type=\"checkbox\" name=\"cod_perfil[]\" value=\"{$value->idSysPerfil}\" $checked /> </td>";
		 		echo "<td>{$value->nameSysPerfil}</td>";
		 		echo "<td>{$value->descSysPerfil}</td>";
		 		echo "<td  style=\"text-align: center;\">".($value->ativoSysPerfil==1 ? '<span style="margin-top: 2px;height: 26px;" class="glyphicons ok_2 heightIcon" title="Ativo"></span>' : '<span style="margin-top: 2px;height: 26px;" class="glyphicons remove_2 heightIcon" title="Desativado"></span>')."</td>";
		 	echo "</tr>";
		 }
		 ?>
		</tbody>
	</table>
