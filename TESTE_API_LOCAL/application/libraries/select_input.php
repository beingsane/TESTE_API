<?	/*
		CLASSES DISPONIVEIS PARA O PARAMETRO $typeText:
		textInputMiddle		->
		textInputBig		->
		textInputSmall		->
		
		VALIDAÇÕES DISPONIVEIS PARA O PARAMETRO $validate:
		validateSelect		-> É obrigatório selecinar um item!
	*/
class Select_input{
		private $id=1;
		private $ci; 
		public function render_input($label,
									$name, 
									$validate, 
									$values = array(), 
									$selected,
									$other = array(
										"style"		=>"",
										"codeJs"	=>"",
										"fileJs"	=>"",
										"error"		=>"",
										"class"		=>"",
										"disabled" =>false)
									){
			$this->ci 		= &get_instance();  							
										
										
										
			$idValidate 	= ($validate!="" 			? $validate 		: $name);
			$classValidate	= ($validate!="" 			? "validate" 		: "");
			$errorField 	= $other["error"] 			? "errorField" 		: ""; 
			$error			= $other["error"] 			? $other["error"] 	: ""; 
			$class			= $other["class"] 			? $other["class"] 	: ""; 
			$style			= $other["style"] 			? $other["style"] 	: ""; 
			$disabled		= isset($other["disabled"]) && $other["disabled"]	? "disabled" 		: ""; 
			$options		= "<option value=\" \">Selecione</value>";
			foreach ($values as $option){
				$sell	= ("$option[value]"=="$selected"  ? "selected" : ""); 
				$options.="<option value=\"".$option['value']."\" $sell>".$option['label']."</value>";
			}
			echo	"<div class=\"itenForm\">
        				<label class=\"labelForm\">$label</label>
        				<select id=\"$idValidate-".$this->id."\" class=\"form-control select left $classValidate\" name=\"".$name."\" style=\"$style\" $disabled>
        					$options
        				</select>
        				<span class=\"inputNotification left $errorField\">".$error."</span>
						<div class=\"clear\"></div>
    				</div>";
			$this->id++;
			
			if($other['codeJs']!=""){
				$this->ci->template_functions->setFile($other['codeJs'], "CODEJS", "BOTTOM");
			}
			
		}
		
	}	