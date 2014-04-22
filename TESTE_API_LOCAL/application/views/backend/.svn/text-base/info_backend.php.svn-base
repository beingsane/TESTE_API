<fieldset class="filter">
<?
	function folder_proteted($path){
		$proteted 	= array("<span style=\"color:#d9534f\">Desprotegida</span>","<span style=\"color:#d9534f\">Proteger está pasta com Deny from all do apache</span>");
		if(file_exists($path)){
			$f 			= fopen($path, "r");
			while(!feof($f)) { 
			    if(fgets($f)=="Deny from all"){
			    	$proteted[0] 	= "<span style=\"color:#609450\">Protedida</span>";
			    	$proteted[1] 	= "";
			    }
			}
			fclose($f);
		}
		return $proteted;
	}
?>
<legend>Versão</legend>
<table class="tableListDefault">
	<thead>
		<tr>
			<th width="20%">Sistema</th>
			<th width="10%">Versão</th>
			<th>Realesed</th>
		</tr>
	</thead>
				
	<tbody>
		<tr>
			<td>MIG - Frame Work</td>
			<td>1.0.1</td>
			<td>10/03/2014 21:20</td>
		</tr>
	</tbody>
</table>
</fieldset>


<fieldset class="filter">
	<legend>Segurança</legend>
	<table class="tableListDefault">
		<thead>
			<tr>
				<th width="20%">Área</th>
				<th width="10%">Status</th>
				<th>Recomendação</th>
			</tr>
		</thead>
					
		<tbody>
			<tr>
				<td>Application</td>
				<td><?
					$rec= folder_proteted(_BASEPATH_."/application/.htaccess");
					echo $rec[0]
					?>
				</td>
				<td><?=$rec[1]?></td>
			</tr>
			<tr>
				<td>System</td>
				<td><?
					$rec= folder_proteted(_BASEPATH_."/system/.htaccess");
					echo $rec[0]
					?>
				</td>
				<td><?=$rec[1]?></td>
			</tr>
			<tr>
				<td>Public</td>
				<td><span style="color:#609450">Acesso Público</span></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset class="filter">
	<legend>Usuários Logados</legend>
	<table class="tableListDefault">
		<thead>
			<tr>
				<th>Nome</th>
				<th>UserName</th>
				<th>Email</th>
				<th>Último Acesso</th>
			</tr>
		</thead>
					
		<tbody>
			<?
				foreach ($loged as $key => $value) {
					echo "<tr>
						<td>{$value->nomeSysUsuarios}</td>
						<td>{$value->userNameSysUsuarios}</td>
						<td>{$value->emailSysUsuarios}</td>
						<td>{$value->date}</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</fieldset>
