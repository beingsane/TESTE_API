<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Jcrop_add
	{
		private $imgCrop=0;
		private $ci;   
		public function __construct(){
			$this->ci = &get_instance();      
			$this->ci->template_functions->setFile(_HTTP_CSSPATH_."/jcrop.css","CSS","BOTTOM");
			$this->ci->template_functions->setFile(_HTTP_JSPATH_."/jquery.Jcrop.js","JAVASCRIPT","BOTTOM");
			$this->ci->template_functions->setFile(_HTTP_JSPATH_."/ajaxupload.3.5.js","JAVASCRIPT","BOTTOM");
			$this->ci->template_functions->setFile(_HTTP_JSPATH_."/jcropPlugin.js","JAVASCRIPT","BOTTOM");
			$jsCrop =  " 
						$('.divImgCrop,#maskOpenImgCrop').click(function(){ 
						    if(openCrop == false) { 
						    	document.body.scrollTop = 0;
						     	openCrop		= true; 
						        namesHidden 	= this.id;
						        
						    	var divLargura	= $(\"#\"+namesHidden).css(\"width\");
						    	var divAltura	= $(\"#\"+namesHidden).css(\"height\");
						    	
						    	alturaVar		= Number(divAltura.split('px')[0]);
								larguraVar		= Number(divLargura.split('px')[0]);
						 		aspectRatioVar	= Number(larguraVar/alturaVar);
						 		jcrop_target	= namesHidden;
						     	$(\"#cropImage\").css(\"width\",divLargura);
						     	$(\"#cropImage\").css(\"height\",divAltura);
						      
						     	/////Limpa os status
						     	$('#status').html(''); 
						     	$('#files').removeClass('error'); 
						        $('#maskOpenImgCrop').show(); 
						        $('.crop').show(); 
						        
						        uploadImg();
						       
						    } else { 
						        openCrop = false; 
						        cropOk	 = false;
						        $('#maskOpenImgCrop').hide(); 
						        $('.crop').hide(); 
						    } 
						}); 
						
						
						$('.cancelCrop').click(function(){ 
						    openCrop = false; 
						    $('#maskOpenImgCrop').hide(); 
						    $('.crop').hide(); 
						    $('#preview').attr({'src':'','style':'display:none'}); 
						    $('#files').html(\"<img id='jcrop_target' alt='' style='display:none' src=''/>\"); 
						});";
				
				/////Cria a div que receberá os conteudos escondidos e adiciona os JS e CSS
				$divs =  "	<!-- Divs para o JCROP  -->
						<div id=\"divHidenField\"></div>
						<div id=\"maskOpenImgCrop\"></div>
						<div class=\"crop\">
						  <div class=\"imgCrop\">
						    <div class=\"previewAll\">
						      <div class=\"maskPhoto right\">
						        <div class=\"cropImageId\" id=\"cropImage\">
						         
						        </div>
						      </div>
						      <div class=\"buttons left\">
						        <div id=\"upload\" class=\"selectCrop btnsCrop\">Selecionar</div>
						        <div class=\"saveCrop btnsCrop\" onclick=\"saveDataHiden()\">Salvar</div>
						        <div class=\"cancelCrop btnsCrop\">Cancelar</div>
						      </div>
						    </div>
						    <div class=\"clear\"></div>
						    <div class=\"optionUpload\">
						      <span class=\"statusId\" id=\"status\"></span>
						      <div class=\"filesId\" id=\"files\">
						        <img id=\"jcrop_target\" alt=\"\" src=\"\" style=\"display:none\" />
						      </div>
						    </div>
						  </div>
						</div>"; 
				/////Coloca os inputs dentro do form
				$this->ci->template_functions->setFile($divs,"HTML_FORM","BOTTOM");
				$this->ci->template_functions->setFile($jsCrop,"CODEJS","BOTTOM");
		}
		function create($id,$label,$largura,$altura,$pathImage = "",$style="" ,$title="") {
			$this->imgCrop++;
			$imagemDefault= $pathImage == "" ? "" : "<img src=\"".$pathImage."\" alt=\"Imagem salva\" style=\"border-radius:10px\" title=\"Imagem cadastrada\" />"; 
			echo "<div class=\"divImgCrop\" id=\"imgCrop-{$this->imgCrop}\" style=\"".($imagemDefault ? "background:none;" : "")."width:{$largura}px;height:{$altura}px;padding:0;$style\" title=\"$title\" >$imagemDefault</div>";
				
		}
		
	}