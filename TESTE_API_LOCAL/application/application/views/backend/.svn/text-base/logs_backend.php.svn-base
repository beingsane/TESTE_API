<?
$tipoLogs	= array();
$tipoLogs[0]= array("value"=>0,"label"=>"BackEnd");
$tipoLogs[1]= array("value"=>1,"label"=>"FrontEnd");
?>
<fieldset class="filter">
	<legend>Filtros</legend>
	<div class="left" style="margin-right: 10px">
		<?
			$this->select_input->render_input("Tipo","type","",$tipoLogs,$this->input->post("type"),array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
		?>
	</div>
	<div class="left">
		<?
			$this->select_input->render_input("Usuário","user","",$users,$this->input->post("user"),array("style"=>"width:200px", "codeJs"=>"", "fileJs"=>"", "error"=>"", "class"=>""));
		?>
	</div>
	<div class="clear"></div>
</fieldset>
<table class="tableListDefault">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Metodo</th>
			<th>Descrição</th>
			<th>Data</th>
			<th>Tipo</th>
		</tr>
	</thead>
	<tbody>
	<?
		
		foreach ($logs as $value) {
			echo "<tr>
				<td>{$value->userDescSysLog}</td>
				<td>{$value->moduleSysLog}</td>
				<td>{$value->infoSysLog}</td>
				<td>{$value->data}</td>
				<td>{$tipoLogs[$value->type_log]['label']}</td>
			</tr>";
		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5">
				 <? $this->pagination->render(array("showTotal"=>true,"limitValues"=>array(10,25,40,60)));?>    
			</td>
		</tr>
	</tfoot>
</table>