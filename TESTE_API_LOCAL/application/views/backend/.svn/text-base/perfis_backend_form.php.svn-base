<? 
	if(isset($cod_perfil)){
		echo "<input type=\"hidden\" value=\"$cod_perfil\" name=\"cod_perfil[]\" />";
	}
	$this->text_input->render_input("text","Nome","nameSysPerfil","validateName",$nameSysPerfil,array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
	
	$this->text_area_input->render_input("Descrição","descSysPerfil","validated",$descSysPerfil,array("style"=>"width: 350px;height: 100px;resize: none;","codeJs"=>"","fileJs"=>"","error"=>""));
	
	$this->text_area_input->render_input("Atributos","attributesSysPerfil","validated",$descSysPerfil,array("style"=>"width: 350px;height: 100px;resize: none;","codeJs"=>"","fileJs"=>"","error"=>""));
	
?>

<h4 style="font-size: 20px;padding: 15px 0px 6px;">Metodos permitidos</h4>
	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"> <input type="checkbox" name="mark_all" class="mark_all_checkbox" value="" id="mark_all"/></th>
				<th>Descrição</th>
				<th>Módulo</th>
				<th>Caminho</th>
			</tr>
		</thead>
					
		<tbody>
		<?
		$modulesSel 	= (is_array($idSysMetodos) ? $idSysMetodos : array());
		$colorClass		= array("row_gren","");
    	$cont			= 0;
    	$moduloAtual	= "";
    	$colorClass		="row_gren";
		 foreach ($metodos as $key => $value) {
		 	$checked 	= (in_array($value->idSysMetodos, $modulesSel) ? "checked" : "");
		 	$id			= $value->idSysMetodos."#".strtolower($value->classeSysMetodos)."#".$value->metodoSysMetodos;
		 	if($moduloAtual!=$value->moduloSysMetodos){
		 		$moduloAtual=$value->moduloSysMetodos;
		 		$colorClass= $colorClass=="row_gren" ? "" : "row_gren";
		 	}
		 	
		 	
		 	echo "<tr class=\"".$colorClass."\">";
		 		echo "<td><input class=\"mark_all\"  type=\"checkbox\" name=\"cod_metodo[]\" value=\"{$id}\" $checked /> </td>";
		 		echo "<td>{$value->descSysMetodos}</td>";
		 		echo "<td>{$value->moduloSysMetodos}</td>";
		 		echo "<td>{$value->apelidoSysMetodos}</td>";
		 	echo "</tr>";
		 	$cont++;
		 }
		 ?>
		</tbody>
	</table>
