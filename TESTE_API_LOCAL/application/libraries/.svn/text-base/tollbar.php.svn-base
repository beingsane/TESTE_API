<?
class Tollbar {
	private $itensToolbar	= array();
	private $textTollbar	= "";
	private $ci;   
	public function __construct(){
		 $this->ci = &get_instance();       
	}
	
	public function setTollbar($text,$glyphicons="circle_ok",$pasta="backend",$classe,$metodo,$extra_parans=""){
		$index				= index_page()!="" ? index_page()."/" :"";
    	$href				= _HTTP_BASEPATH_."/".$index.$pasta."/".$classe."/".$metodo;
    	if($this->ci->check_file_permitions->check_permitions($classe,$metodo)){
    		$this->itensToolbar[] = '<span type="submit" href="'.$href.'" class="btnTollbar glyphicons '.$glyphicons.' right">'.$text.'</span>';
    	}
		
    }
	public function getTollbar(){
		foreach($this->itensToolbar as $value){
			echo $value;
		}
	}
	
	
	
	public function setTextTollbar($icon="glyphicons sort",$text=""){
		$this->textTollbar	= '<span class="'.$icon.'">'.$text.'</span>';
    }
    public function getTextTollbar(){
		return $this->textTollbar;
	}
	
	
	
	public function getHtmlTollbar() {
		echo "<div id=\"tollbar\">
                	<div id=\"mensTollbar\" class=\"left\">{$this->getTextTollbar()}</div>
                	<div id=\"iconTollbar\" class=\"right\">
						{$this->getTollbar()}
                	</div>
                	<div class=\"clear\"></div>
              </div>";
	}
}