<?
	/*
		CLASSES DISPONIVEIS PARA O PARAMETRO $typeText:
		textInputMiddle		->
		textInputBig		->
		textInputSmall		->
		
		VALIDAÇÕES DISPONIVEIS PARA O PARAMETRO $validate:
		validateName 		-> Preencha com no mínimo tres caracteres!
		validateEmail 		-> Preencha um e-mail válido!!
		validateData 		-> Preencha com uma data valida! ex(10/10/2000)!
		validateURL 		-> Preencha uma url válida. Exemplo(http://www.google.com.br)!!
		validateText 		-> Preencha com no mínimo dez caracteres!
		validateNumber 		-> Digite apenas números!
		validateSenha 		-> Preencha com no mínimo cinco caracteres!
		
		
		TIPOS SUPORTADOS
		text				-> Campo de texto normal
		password			-> Campo de Senha
		date				-> Campo com o datepiker
		hour				-> campo com mascara de hora
	*/
class Text_input{
		private $id=1;
		private $ci; 
		public function render_input($type = "text",
									$label,
									$name, 
									$validate, 
									$value, 
									$other = array(
										"style"=>"",
										"codeJs"=>"",
										"error"=>"",
										"class"=>"",
										"readOnly"=>"",
										"placeHolder"=>"")
									){
										
										
										
			$this->ci 		= &get_instance();    			
			/////Verifica se o campo é date para tratamento
			$idValidate 	= ($validate!="" 	? $validate 		: $name);
			if($type=="date"){
				$type="text";
				/////Adiciona o datepiker + a mascara
				$this->ci->template_functions->setFile(_HTTP_JSPATH_."/jquery.maskedinput-1.1.4.js", "JAVASCRIPT", "TOP");
				$other['codeJs'].= '
					$( "#'.$idValidate.'-'.$this->id.'" ).datepicker(
						{
							showOn: "button", 
							buttonImage: "'._HTTP_IMGPATH_.'/img_jquery_ui/calendar.png", 
							buttonImageOnly: true, 
							buttonText:"Abrir calendário"
						}
					);
					$("#'.$idValidate.'-'.$this->id.'").mask("99/99/9999");';
				
			}else if($type=="hour"){
				$type="text";
				/////Adiciona a mascara
				$other['codeJs'].= '
					$("#'.$idValidate.'-'.$this->id.'").mask("99:99");';
			}				
			
			$classValidate	= ($validate!="" 				? "validate" 								: "");
			$errorField 	= $other["error"] 				? "errorField" 								: ""; 
			$class			= $other["class"] 				? $other["class"] 							: ""; 
			$style			= $other["style"] 				? $other["style"] 							: ""; 
			$readOnly		= isset($other["readOnly"]) 	? "readonly"								: "";
			$placeHolder	= isset($other["placeHolder"])	? 'placeholder="'.$other["placeHolder"].'"'	: "";
			echo	"<div class=\"itenForm\">
        				<label class=\"labelForm\">$label</label>
        				<input id=\"$idValidate-".$this->id."\" class=\"form-control left $classValidate $class\" type=\"$type\" name=\"".$name."\" value=\"".$value."\" style=\"$style\" $readOnly $placeHolder/>
        				<span class=\"inputNotification left $errorField\">".$other["error"]."</span>
						<div class=\"clear\"></div>
    				</div>";
			$this->id++;
			
			if($other['codeJs']!=""){
				$this->ci->template_functions->setFile($other['codeJs'], "CODEJS", "BOTTOM");
			}
		}
		
	}	