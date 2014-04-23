<? 
class Pagination {
	private $opcao = array("limit"=>50,"offset_records"=>0,"limitPrev"=>0,"offset"=>0,"offsetPrev"=>0,"name"=>"","filterReceived"=>"","filterCompar"=>"","name"=>"","submitPagination"=>"");
	private $ci;   
	public function __construct(){
		 $this->ci = &get_instance();       
	}
	public function prepare($other = array()) {
		$this->opcao["limit"]			= isset($other["limit"])			== true ? $other["limit"]			: $this->opcao["limit"];
		$this->opcao["filterCompar"]	= isset($other["filterCompar"])		== true ? $other["filterCompar"]	: $this->opcao["filterCompar"];
		$this->opcao["name"]			= isset($other["name"])				== true ? $other["name"]			: $this->opcao["name"];
		$this->opcao["submitPagination"]= isset($other["submitPagination"])	== true ? $other["submitPagination"]: $this->opcao["submitPagination"];
		$this->opcao["filterReceived"]	= $this->ci->input->post($this->opcao["name"].'filterReceived');
		
	    
		
		$this->opcao["limit"]			= $this->ci->input->post($this->opcao["name"].'pagination_limit')!=null ? $this->ci->input->post($this->opcao["name"].'pagination_limit') : $this->opcao["limit"];
		$this->opcao["limitPrev"]		= $this->ci->input->post($this->opcao["name"].'pagination_limitprev');
		$this->opcao["offset"]			= $this->ci->input->post($this->opcao["name"].'pagination_offset');
		$this->opcao["offsetPrev"]		= $this->ci->input->post($this->opcao["name"].'pagination_offsetprev');

		$this->opcao["offset_records"]	= ($this->opcao["offset"]*$this->opcao["limit"]);
		
		if($this->opcao["filterCompar"]!=$this->opcao["filterReceived"]){
			$this->opcao["offset"]= 0;
			$this->opcao["offset_records"]= 0;
		}
	}



	public function setTotal($total) {
		$this->opcao["total"] = $total;
	}
	
	public function setName($name) {
		$this->opcao["name"] = $name;
	}
	
	public function setOffset($offSet) {
		$this->opcao["offset_records"]=$offSet;
	}
	public function getLimit() {
		return $this->opcao["limit"];
	}

	public function getOffset() {
		return $this->opcao["offset_records"];
	}
	
	
	public function render($other = array()) {
		$retVal 		= "";
		$link			= "";
		$limit 			= (int)$this->opcao["limit"];
		$limitPrev		= (int)$this->opcao["limitPrev"];
		$offset			= (int)$this->opcao["offset"];
		$offsetPrev		= (int)$this->opcao["offsetPrev"];
		$total 			= (int)$this->opcao["total"];
		$filterCompar	= $this->opcao["filterCompar"];
		
		$limitValues	= isset($other["limitValues"])	== true ? $other["limitValues"]		: 0;
		$showTotal		= isset($other["showTotal"])	== true ? $other["showTotal"]		: 0;
		$length			= isset($other["showTotal"])	== true ? (int)$other["showTotal"]	: 0; 
		$length			= ($length > 1?$length:20);


		///// calcula valores
		$pages          = ceil($total / $limit);
		$tmpL           = 0;
		$tmpR           = 0;
		$pivot          = 0;
		$start          = 0;
		$end            = 0;

		$length         = (((int)$length & 1) == 1?(int)$length:(int)$length+1);
		$prePart        = $length - 1;
		$part           = $prePart / 2;

		$tmpL           = $offset - $part;
		$tmpR           = $offset + $part;
		$pivot          = $offset;

		/**
		if ($limit != $limitPrev) {
			$pos	= $limitPrev * $offsetPrev;
			$pivot	= (int)($pos /$limit);

			$pos 	= $offset - $offsetPrev;
			$pivot	= $pivot + $pos;
			$pivot	= ($pivot < 0?0:$pivot);
			$pivot	= ($pivot > ($pages-1)?($pages-1):$pivot);
		}
		**/

		if ($pages > $length) {
			if ($tmpL >= 0 && $tmpR <= $pages) {
				$start  = $tmpL;
				$end    = $start + $prePart;
			} else if ($tmpR >= $pages) {
				$end    = $pages - 1;
				$start  = $end - $prePart;
			} else {
				$start  = 0;
				$end    = $prePart;
			}
		} else {
			$start  = 0 ;
			$end    = $pages -1;
			$length = $pages;
		}


		if ($pages > 1) {
			///// desenha paginação
			$retVal = "\r\n<!-- Inicio Pagination -->";
			$retVal .= "\r\n<div id=\"Pagination_externaldiv\"><table  cellpadding=\"0\" cellspacing=\"0\" style=\"margin:0 auto;\"><tr><td>\r\n";
			$this->ci->template_functions->setFile(_HTTP_CSSPATH_."/pagination.css","CSS","BOTTOM");
			$this->ci->template_functions->setFile(_HTTP_JSPATH_."/pagination.js","JAVASCRIPT","BOTTOM");
			
			$retVal .= "<div id=\"Pagination_Pagination\">";

			///// desenha seta dupla para a esquerda
			if (($pivot - $prePart) > 0) {
				$nextOffset	 = $pivot-$length;
				$nextOffset	 = ($nextOffset > 0?$nextOffset:0);
				$this->ci->template_functions->setFile("$(\"#Pagination_arrowLeftDouble\").bind('click',function(){pagination_changePage($nextOffset)})","CODEJS","BOTTOM");

				$linkS  = $link.($pivot-$prePart);
				$retVal .= ("<a class=\"img_link\" id=\"Pagination_arrowLeftDouble\" href=\"javascript:void(0)\"><img src=\""._HTTP_IMGPATH_."/backend/template/seta2_left.png\" /></a>\r\n");
			}

			///// desenha seta simples para a esquerda
			if ($pivot > 0) {
				$nextOffset	= $pivot-1;
				$nextOffset	= ($nextOffset > 0?$nextOffset:0);
				$this->ci->template_functions->setFile("$(\"#Pagination_arrowLeftSingle\").bind('click',function(){pagination_changePage($nextOffset)})","CODEJS","BOTTOM");
				$linkS  	= $link.($pivot-1);
				
				$retVal .= ("<a class=\"img_link\" id=\"Pagination_arrowLeftSingle\" href=\"javascript:void(0)\"><img src=\""._HTTP_IMGPATH_."/backend/template/seta_pagination_left.png\" /></a>\r\n");
			}


			///// desenha a paginação
			$this->ci->template_functions->setFile("$(\".n_link\").click(function(){var offset =this.id.split('-')[1]; pagination_changePage(offset);})","CODEJS","BOTTOM");
			for ($i=0;$i<$length;$i++) {
				$pageNumber = $i+$start;
				$linkS      = $link.$pageNumber;

				$retVal .= ($i>0?" ":"");
				if ($pageNumber == $pivot) {
					$selected = "CurrentPage_pagination";
				}else{
					$selected = "";
				}
				$pageLink = $pageNumber+1;
				$retVal .= "<a class=\"n_link $selected\" id=\"PaginationPage-$pageNumber\" href=\"javascript:void(0)\" title=\"Página - $pageLink\">&nbsp;$pageLink&nbsp;</a>\r\n";
			}


			///// desenha seta simples para a direita
			if ($pivot < $pages-1) {
				$nextOffset	 = $pivot+1;
				$nextOffset	 = ($nextOffset > ($pages-1)?($pages-1):$nextOffset);
				$this->ci->template_functions->setFile("$(\"#Pagination_arrowRightSingle\").bind('click',function(){pagination_changePage($nextOffset)})","CODEJS","BOTTOM");

				$linkS		 = $link.($pivot+1);
				$retVal		.= ("<a class=\"img_link\" id=\"Pagination_arrowRightSingle\" href=\"javascript:void(0)\"><img src=\""._HTTP_IMGPATH_."/backend/template/seta_pagination_right.png\" /></a>\r\n");
			}

			///// desenha seta dupla para a direita
			if (($pivot + $prePart) < $pages-1) {
				$nextOffset = $pivot + $length;
				$nextOffset	 = ($nextOffset > ($pages-1)?($pages-1):$nextOffset);
				$this->ci->template_functions->setFile("$(\"#Pagination_arrowRightDouble\").bind('click',function(){pagination_changePage($nextOffset)})","CODEJS","BOTTOM");
				$linkS  = $link.($pivot+$prePart);
				$retVal .= ("<a class=\"img_link\" id=\"Pagination_arrowRightDouble\" href=\"javascript:void(0)\"><img src=\""._HTTP_IMGPATH_."/backend/template/seta2_right.png\" /></a>\r\n");
			}

			if (($limitValues && is_array($limitValues)) || $showTotal) {

				//$this->ci->template_functions->setFile("$(\"#Pagination_DetailsButton\").bind('click',function(){pagination_toggleDetails()})","CODEJS");
				//$retVal .= "<a class=\"img_link\" id=\"Pagination_DetailsButton\" href=\"javascript:void(0)\"><img src=\""._HTTP_IMGPATH_."/default/pagination_details.png\" /></a>";
				$retVal	.= "<div id=\"Pagination_DetailsOuter\"><div id=\"Pagination_Details\"><div id=\"Pagination_DetailsInner\">";

				///// exibe o total de páginas e o total de valores
				if ($showTotal) {
					$retVal .= " [$pages páginas / $total registros]\r\n";
				}

				///// adiciona os valores dos parâmetros necessários
				if ($limitValues && is_array($limitValues)) {
					$this->ci->template_functions->setFile("$(\"#pagination_limit\").change(function(){pagination_changePage()})","CODEJS","BOTTOM");
					$retVal .= "&nbsp;Paginação:<select name=\"".$this->opcao["name"]."pagination_limit\" id=\"pagination_limit\">\r\n";
					foreach ($limitValues as $value) {
						$selected = ($value == $limit? "selected":"");
						$retVal .= "<option value=\"$value\" $selected>$value</option>\r\n";
					}
				}
				$retVal .= "</div></div></div>";
			}

			$retVal .= "<input type=\"hidden\" name=\"submitPagination\" id=\"submitPagination\" value=\"".$this->opcao["submitPagination"]."\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_offset\" id=\"pagination_offset\" value=\"$offset\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_offsetprev\" id=\"pagination_offsetprev\" value=\"$offsetPrev\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_limitprev\" id=\"pagination_limitprev\" value=\"$limit\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."filterReceived\"  value=\"$filterCompar\" />\r\n";

			$retVal .= "</div>";

			$retVal .= "<!-- FIM Pagination -->\r\n";

			///// finaliza a div de paginação
			$retVal .= "</td></tr></table></div>\r\n";
		} else {
			switch ($total) {
				case 0	: $str = "Nenhum registro encontrado"; break;
				case 1	: $str = "1 registro"; break;
				default	: $str = "<div style=\"text-align:center;display:block;margin-top:10px;\">$total registros</div>";
 			}
			echo($str);
		}

		echo($retVal);
		
	}
	
	public function persistPagination($nane) {
		$retVal							= "";
		
		$this->opcao["limit"]			= $this->ci->input->post($nane.'pagination_limit')!=null ? $this->ci->input->post('pagination_limit') : $this->opcao["limit"];
		$this->opcao["limitPrev"]		= $this->ci->input->post($nane.'pagination_limitprev');
		$this->opcao["offset"]			= $this->ci->input->post($nane.'pagination_offset');
		$this->opcao["offsetPrev"]		= $this->ci->input->post($nane.'pagination_offsetprev');
		$this->opcao["filterReceived"]	= $this->ci->input->post($this->opcao["name"].'filterReceived');
		
		
		if($this->opcao["offset"]!=null){
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_offset\" id=\"pagination_offset\" value=\"$this->opcao[offset]\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_offsetprev\" id=\"pagination_offsetprev\" value=\"$this->opcao[offsetPrev]	\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."pagination_limitprev\" id=\"pagination_limitprev\" value=\"$this->opcao[limit]\" />\r\n";
			$retVal .= "<input type=\"hidden\" name=\"".$this->opcao["name"]."filterReceived\"  value=\"$this->opcao[filterReceived]\" />\r\n";
		}
		
		
		echo($retVal);
	}
}
?>