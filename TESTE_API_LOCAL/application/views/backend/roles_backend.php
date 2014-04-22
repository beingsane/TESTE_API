	<table class="tableListDefault">
		<thead>
			<tr>
				<th style="width: 24px"></th>
				<th style="width: 150px">Classe</th>
				<th style="width: 150px">Método</th>
				<th style="width: 250px">Pasta/Classe/Método</th>
				<th style="width: 175px">Aba</th>
				<th style="width: 175px">Módulo</th>
				<th>Descrição</th>
				<th style="width: 80px">Acesso</th>
				<th style="width: 175px">Menu</th>
			</tr>
		</thead>
					
		<tbody>
		<?
			foreach ($result as $key => $value) {
				$notClass		= "";
				$classRemove 	= "<div id=\"action-{$value->idSysMetodos}\" class=\"glyphicons floppy_save pointer heightIcon\" title=\"Salva os dados!\"></div>";
				$type			= "";
				$id_remove		= "";
				if(!in_array($value->apelidoSysMetodos,$methodos)){
					$notClass 		= "notClassDir";
					$classRemove	= "<div id=\"action-{$value->idSysMetodos}\" class=\"glyphicons remove pointer heightIcon\"></div>";
					$id_remove		= "id=\"remove-{$value->idSysMetodos}\"";
				}
				switch ($value->privadoSysMetodos) {
					case -1	: $type ='<span class="glyphicons restart heightIcon" title="Não necessita estáo logado e nem permissão. Mas se estiver logado é redirecionado para o contoller default.">HTML</span>' ; break;
					case 0 	: $type ='<span class="glyphicons unlock heightIcon" title="Não necessita estáo logado e nem permissão."></span>' ; break;
					case 1	: $type ='<span class="glyphicons lock heightIcon" title="Necessita estar logado no sistema para acessar.Se não é redirecionado para o login."> HTML</span>' ; break;
					case 2	: $type ='<span class="glyphicons rotation_lock heightIcon" title="Necessita ter permição par acessar."> HTML</span>' ; break;
					case 3	: $type ='<span class="glyphicons lock heightIcon" title="Necessita apenas ter permição para acessar."> HTML</span>' ; break;
					case 4	: $type ='<span class="glyphicons lock heightIcon" title="Necessita estar logado para acessar.Se não estiver logado será exibido uma mensagem em JSON."> JS</span>' ; break;
					case 5	: $type ='<span class="glyphicons lock heightIcon" title="Necessita ter permição para acessar.Se não estiver logado será exibido uma mensagem em JSON"> JS</span>+' ; break;
					
					default	: "" ; break;
				}
				
				echo "<tr class=\"$notClass\" $id_remove>";
					echo "<td>$classRemove</td>";
					echo "<td>$value->classeSysMetodos</td>";
					echo "<td>$value->metodoSysMetodos</td>";
					echo "<td>$value->apelidoSysMetodos</td>";
					echo "<td><input type=\"text\" name=\"aba[]\" id=\"{$value->idSysMetodos}-aba\" class=\"form-control\" placeholder=\"Aba a qual pertence.\" value=\"$value->abaSysMetodos\"/> </td>";
					echo "<td><input type=\"text\" name=\"aba[]\" id=\"{$value->idSysMetodos}-modulo\" class=\"form-control\" placeholder=\"Nome do módulo\" value=\"$value->moduloSysMetodos\"/> </td>";
					echo "<td><input style=\"width:90%\" type=\"text\" name=\"aba[]\" id=\"{$value->idSysMetodos}-desc\" class=\"form-control\" placeholder=\"Descritivo da tarefa\" value=\"$value->descSysMetodos\"/> </td>";
					echo "<td style=\"\">".($type)."</td>";
					echo "<td><input type=\"text\" name=\"aba[]\" id=\"{$value->idSysMetodos}-menu\" class=\"form-control\" placeholder=\"Menu\" value=\"$value->linkMenu\"/></td>";
				echo "</tr>";
			}
			/////Carrega os java script especifico para essa tarefa
			$this->template_functions->setFile(_HTTP_JSPATH_."/backend/roles_backend.js","JAVASCRIPT","BOTTOM")
		?>
			
		</tbody>
	</table>
	