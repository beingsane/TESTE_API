<? 
	if(isset($id_code)){
		echo "<input type=\"hidden\" value=\"$id_code\" name=\"id_code[]\" />";
	}
	$prodSelArrayJavascript = "[";
	if(is_array($prodSell)){
		foreach ($prodSell as $key => $value) {
			$prodSelArrayJavascript .="'$value',";
		}
	}
	$prodSelArrayJavascript .= "]";
?>
<?
	echo "<div class=\"left\">";
	/////Campos para controle de para adição de produtos ao HTML
	$this->text_hidden->render_input("id_prod_sel", "", "id_prod_sel", $other = array("codeJs"=> "", "class"=>""));
	$this->text_hidden->render_input("ean_prod_sel", "", "ean_prod_sel", $other = array("codeJs"=> "", "class"=>""));
	
	
	/////Campo de busca por produto
	$this->text_input->render_input(
		"text", 
		"Nome", 
		"name", 
		"validateName", 
		"", 
		array(
			"style" => "width:300px;text-transform: uppercase;", 
			"codeJs"=> '
				function formatNumber(number){
				    number = number.toFixed(2) + "";
				    x = number.split(".");
				    x1 = x[0];
				    x2 = x.length > 1 ? "." + x[1] : "";
				    var rgx = /(\d+)(\d{3})/;
				    while (rgx.test(x1)) {
				        x1 = x1.replace(rgx, "$1" + "." + "$2");
				    }
				    return x1 + x2;
				}
				var avaliabledProd='.$produtos.';
				$( "#validateName-1" ).autocomplete({
					source: avaliabledProd,
					select: function( event, ui ) {
						$( "#validateName-1" ).val( ui.item.label );
        				$( "#id_prod_sel" ).val( ui.item.valueProd );
        				$( "#ean_prod_sel" ).val( ui.item.eanProd );
        				return false;
      				} 
      			});
				var prodAdd = '.$prodSelArrayJavascript.';
				$( "#add_prod" ).click(function(){
					var prodSell	= $("#validateName-1").val();
					if(prodSell<1){
						openErrorModal("Alerta","<div class=\"glyphicons circle_remove\">Selecione um produto para adicionar</div>",true);
						return;
					}
					
					for(var i = 0; i < prodAdd.length; i++) {
						if(prodAdd[i] == prodSell){
							openErrorModal("Alerta","<div class=\"glyphicons circle_remove\">Esse produto já foi adicionado</div>",true);
							return;
						}
					}
					
					prodAdd.push(prodSell);
					$("#validateName-1").val( "" );
					var EAN 	= $("#ean_prod_sel").val();
					var idProd	= $("#id_prod_sel").val();
					htmlPrepend = "<tr id=\"line-"+idProd+"\">"+
									"<td><span id=\"remove-"+idProd+"\" class=\"glyphicons remove pointer heightIcon redIcon\" title=\"Remove da lista esse produto\"></span> <input type=\"hidden\" value=\""+idProd+"\" name=\"idProdAdded[]\" /></td>"+
									"<td id=\"prodSel-"+idProd+"\"><input type=\"hidden\" value=\""+prodSell+"\" name=\"prodSell[]\" /><span>"+prodSell+"</span></td>"+
									"<td><input type=\"hidden\" value=\""+EAN+"\" name=\"eanSell[]\" />"+EAN+"</th>"+
									"<td><input id=\"qtd-"+idProd+"\" class=\"form-control qtd\" type=\"text\" name=\"qtd[]\" value=\"\" style=\"width:90px;text-transform: uppercase;border: solid 1px #d9534f;\" /></td>"+
									"<td><input id=\"valor-"+idProd+"\" class=\"form-control valor\" type=\"text\" name=\"valor[]\" value=\"\" style=\"width:90px;text-transform: uppercase;border: solid 1px #d9534f;\" /></td>"+
									"<td id=\"total-"+idProd+"\"></td>"+
								"</tr>";
					$("#prodAdd").prepend(htmlPrepend);
					$("#valor-"+idProd+",#qtd-"+idProd).unbind();
					$("#valor-"+idProd).priceFormat({prefix: "R$ ",centsSeparator: ".",thousandsSeparator: "", clearPrefix: true});
					$(".qtd,.valor").blur(function(){
						var idSeparate = this.id.split("-")[1];
						var qtd 	= Number($("#qtd-"+idSeparate).val());
						var valor 	= Number($("#valor-"+idSeparate).val());
						 if(qtd && valor){
						 	$("#total-"+idSeparate).html("R$ "+formatNumber(qtd * valor));
						 	$("#qtd-"+idSeparate+",#valor-"+idSeparate).css("border","solid 1px white");
						 }else{
						 	$("#total-"+idSeparate).html("");
						 	$("#qtd-"+idSeparate+",#valor-"+idSeparate).css("border","solid 1px #d9534f");
						 }
					});
					
					$(".remove").unbind();
					$(".remove").click(function(){
						var idSeparate = this.id.split("-")[1];
						var prodSellremove = $("#prodSel-"+idSeparate+" span").html();
						for(var i = 0; i < prodAdd.length; i++) {
							if(prodAdd[i] == prodSellremove){
								prodAdd[i]="";
								$("#line-"+idSeparate).remove();
								return;
							}
						}
					});
					
				});
				
				$(".valor").priceFormat({prefix: "R$ ",centsSeparator: ".",thousandsSeparator: "", clearPrefix: true});
				$(".remove").click(function(){
					var idSeparate = this.id.split("-")[1];
					var prodSellremove = $("#prodSel-"+idSeparate+" span" ).html();
					for(var i = 0; i < prodAdd.length; i++) {
						if(prodAdd[i] == prodSellremove){
							prodAdd[i]="";
							$("#line-"+idSeparate).remove();
							return;
						}
					}
				});
				
				$(".qtd,.valor").blur(function(){
					var idSeparate = this.id.split("-")[1];
					var qtd 	= Number($("#qtd-"+idSeparate).val());
					var valor 	= Number($("#valor-"+idSeparate).val());
					 if(qtd && valor){
					 	$("#total-"+idSeparate).html("R$ "+formatNumber(qtd * valor));
					 	$("#qtd-"+idSeparate+",#valor-"+idSeparate).css("border","solid 1px white");
					 }else{
					 	$("#total-"+idSeparate).html("");
					 	$("#qtd-"+idSeparate+",#valor-"+idSeparate).css("border","solid 1px #d9534f");
					 }
				});
			',
			"error" 	=> "", 
			"class"		=> "",
			"placeHolder" =>"Digite o nome ou código de barras para buscar."
		)
	);
	/////Campo de data da compra
	$this->text_input->render_input(
					"date", 
					"Data da compra", 
					"data_compra", 
					"", 
					$data_compra, 
					array(
						"style" => "width:100px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
	/////Campo hora da compra
	$this->text_input->render_input(
					"hour", 
					"Hora da compra", 
					"hora_compra", 
					$hora_compra, 
					$this->input->post("hora_compra"), 
					array(
						"style" => "width:60px;text-transform: uppercase;", 
						"codeJs"=> '', 
						"error" => "",
						"class"	=> ""
					)
				);
				
	/////Campo descrição
	$this->text_area_input->render_input(
		"Descritivo", 
		"desc", 
		"", 
		$desc, 
		array(
			"style"	=> "width: 400px;height: 100px;",
			"codeJs"=> "", 
			"error" => ""
		)
	);
	echo "</div>"
?>
	<div id="add_prod" class="left glyphicons inbox_plus" style="margin-top: 40px;margin-left: 17px;cursor: pointer;height: 15px;" title="Adicionar produto selecionado">
	
	</div>
	<div  class="clear" style="height: 30px"></div>
	<div>
		<table class="tableListDefault">
			<thead>
				<tr>
					<th style="width: 24px"></th>
					<th>Produto Comprado</th>
					<th style="width: 170px">Código de Barras</th>
					<th style="width: 90px">Quantidade</th>
					<th style="width: 100px">Valor</th>
					<th style="width: 100px">Total</th>
				</tr>
			</thead>
						
			<tbody id="prodAdd">
			<?
				if(!is_array($idProdAdded)){
					$idProdAdded= array();
				}
				foreach ($idProdAdded as $key => $value) {
						echo "<tr id=\"line-$value\">
								<td>
									<span id=\"remove-$value\" class=\"glyphicons remove pointer heightIcon redIcon\" title=\"Remove da lista esse produto\"></span> 
									<input type=\"hidden\" value=\"$value\" name=\"idProdAdded[]\">
								</td>
								<td id=\"prodSel-$value\">
									<input type=\"hidden\" value=\"{$prodSell[$key]}\" name=\"prodSell[]\"><span>{$prodSell[$key]}</span>
								</td>
								<td>
									<input type=\"hidden\" value=\"{$eanSell[$key]}\" name=\"eanSell[]\">{$eanSell[$key]}
								</td>
								<td>
									<input id=\"qtd-$value\" class=\"form-control qtd\" type=\"text\" name=\"qtd[]\" value=\"{$qtd[$key]}\" style=\"width:90px;text-transform: uppercase;border: solid 1px #d9534f;\">
								</td>
								<td>
									<input id=\"valor-$value\" class=\"form-control valor\" type=\"text\" name=\"valor[]\" value=\"{$valor[$key]}\" style=\"width:90px;text-transform: uppercase;border: solid 1px #d9534f;\">
								</td>
								<td id=\"total-$value\">
									".($valor[$key] && $qtd[$key] ? "R$ ".number_format($valor[$key] * $qtd[$key], 2, ',', '.') : "")."
								</td>
							</tr>";
				}
			?>
			</tbody>
		</table>
	</div>
<?
	$this->template_functions->setFile(_HTTP_JSPATH_."/jquery.price_format.1.7.min.js", "JAVASCRIPT", "TOP");
	$this->pagination->persistPagination("list_prods");
	$this->text_hidden->render_input("data_inicial", $this->input->post("data_inicial"),"data_inicial", $other = array("codeJs"=> "", "class"=>""));
	$this->text_hidden->render_input("data_final", $this->input->post("data_final"),"data_final", $other = array("codeJs"=> "", "class"=>""));
?>
