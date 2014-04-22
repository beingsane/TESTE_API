<?
class Text_hidden{
		private $ci; 
		public function render_input($name, $value,	$id, $other = array("codeJs"=> "", "class"=>"")){
										
			$this->ci 		= &get_instance(); 
			$classValidate	= $other['class'] ? $other['class'] : "";    							
			echo	"<input id=\"$id\" class=\"$classValidate\" type=\"hidden\" name=\"".$name."\" value=\"".$value."\" >";
			
			if($other['codeJs']!=""){
				$this->ci->template_functions->setFile($other['codeJs'], "CODEJS", "BOTTOM");
			}
		}
		
	}	