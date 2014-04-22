<?
	class Template_functions{
		private $file		= array("TOP"	=>array(),"BOTTOM"=>array());
		private $fileHTML	= array("FORM"=>array());
		private $fileSeleted= array();
		private $mensErro	= array("errorCode"=>"0","errors"=>array());
		private $titleErro	= "";
		
		function setFile($file,$fileType,$position) {
			/*
			Podese passar Arquivos: CSS,JAVASCRIPT,HTML e tambem funcoes em javascript
			Tipos:
			CSS 		= Carrega um arquivo css dentro da tags <link href="$file" rel="stylesheet" type="text/css" />
			JAVASCRIPT	= Carrega um arquivo JS dentro da tags  <script type="text/javascript" src="$file"></script>
			CODEJS		= Carrega um o código  JS dentro da tags <script type="text/javascript">$file</script>
			
			
			Position:
			TOP			= Carrega o arquivo entre as tags <head>$file</head>
			BOTTOM		= Carrega os arquivo antes do fecahamento da BODY
			
			*/
			if($fileType=="CSS"){
				$this->file[$position][]="<link href=\"$file\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
			}else if($fileType=="JAVASCRIPT"){
				$this->file[$position][]="<script type=\"text/javascript\" src=\"$file\"></script>\r\n";
			}else if($fileType=="CODEJS"){
				$this->file[$position][]="<script type=\"text/javascript\">$file</script>\r\n";
			}else if($fileType=="HTML"){
				$this->file['BOTTOM'][]="$file \r\n";
			}else if($fileType=="HTML_FORM"){
				$this->fileHTML['FORM'][]="$file \r\n";
			}
	
		}
		function getFileTop() {
			foreach($this->file['TOP'] as $file){
				if(!in_array($file, $this->fileSeleted)){
					echo $file;
					$this->fileSeleted[] = $file;
				}
			}
		}
		function getFileBottom() {
			foreach($this->file['BOTTOM'] as $file){
				if(!in_array($file, $this->fileSeleted)){
					echo $file;
					$this->fileSeleted[] = $file;
				}
			}
		}
		function getFileForm() {
			foreach($this->fileHTML['FORM'] as $file){
				if(!in_array($file, $this->fileSeleted)){
					echo $file;
					$this->fileSeleted[] = $file;
				}
			}
		}
		

		function setError($type = "",$desc, $title) {
			/////exeste 3 tipos de Types error,success,info
			
			switch ($type) {
				case "error": 	$type="glyphicons circle_remove"; break;
				case "info": 	$type="glyphicons circle_exclamation_mark"; break;
				case "success": $type="glyphicons circle_ok"; break;
			}
			$this->mensErro["errorCode"]	= "1";
			$this->mensErro["errors"][]		= array("errorType"=>$type,"errorDesc"=>$desc);
			$this->titleErro				= $title;
		}
		
		
		function getError() {
			if($this->mensErro["errorCode"]!="0"){
				$retval	= "";
				foreach($this->mensErro["errors"] as $error) {
					$retval.="<div class=\"$error[errorType]\">".$error["errorDesc"]."</div>";
				}
				echo  $retval;
			}
		}
		
		function getTitleErro() {
			if($this->mensErro["errorCode"]!="0"){
				$retval = $this->titleErro;
				echo  $retval;
			}
		}
		
		function getBrowser() {
			$useragent = $_SERVER['HTTP_USER_AGENT'];
 
			if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'IE';
			} elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'Opera';
			} elseif(preg_match('|Trident/([0-9\.]+)|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'IE_NEW';
			}elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'Firefox';
			}  elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'Chrome';
			} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
				$browser_version=$matched[1];
				$browser = 'Safari';
			} else {
		    	// browser not recognized!
				$browser_version = 0;
				$browser= 'other';
		  	}
		  	return array('browser' => $browser, 'browser_version' => $browser_version);
		}
		
		function invalidBrowser_mig() {
			$browser = $this->getBrowser();
			if(($browser["browser"]=="IE" && $browser["browser_version"]<9) || ($browser["browser"]=="other" && $browser["browser_version"]==0)){
				echo "Atualize o browser";
			}
		}
	}