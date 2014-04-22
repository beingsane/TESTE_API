<?
	/*
		CLASSES DISPONIVEIS PARA O PARAMETRO $typeText:
		textAreaInputSmall		->
		textAreaInputMiddle		->
		textAreaInputBig		->
		
		
		VALIDAÇÕES DISPONIVEIS PARA O PARAMETRO $validate:
		validateText 		-> Preencha com no mínimo tres caracteres!
		
	*/
class Text_area_input
	{
		private $id=1;
		public function render_input($label,$name,$validate,$value,$other=array("style"=>"","codeJs"=>"","fileJs"=>"","error"=>"")) {
			$idValidate 	= ($validate!="" 	? $validate 		: $name);
			$classValidate	= ($validate!="" 	? "validate" 		: "");
			$errorField 	= $other["error"] 	? "errorField" 		: ""; 
			$style		 	= $other["style"] 	? $other["style"] 	: ""; 
			echo	"<div class=\"itenForm\">
        				<label class=\"labelForm\">$label</label>
        				<textarea style=\"$style\" id=\"$idValidate-".$this->id."\" class=\"form-control left $classValidate \" name=\"".$name."\">$value</textarea>
        				<span class=\"inputNotification left $errorField\">".$other["error"]."</span>
						<div class=\"clear\"></div>
    				</div>";
			$this->id++;
			
	
		}
		
	}	