<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="<?=_HTTP_BASEPATH_?>/favicon.ico" type="image/x-icon" />
		<title>Administração - <?=_NAME_EMPRESA_?></title>		
		<link rel="stylesheet" href="<?=_HTTP_CSSPATH_?>/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?=_HTTP_CSSPATH_?>/glyphicons.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?=_HTTP_CSSPATH_?>/backend/template.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?=_HTTP_CSSPATH_?>/jquery-ui-1.10.4.min.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?=_HTTP_JSPATH_?>/jquery-1.7.1.min.js"></script>	
        <script type="text/javascript" src="<?=_HTTP_JSPATH_?>/jquery-ui-1.10.4.min.js"></script>	
        <? $this->template_functions->getFileTop(); ?>
	</head>
	<body>
    	<div id="site">
    		<div id="menuLeft">
    			<div class="top">
    				<div id="logo"><h1>MIG <span>More Igniter</span></h1></div>
    				<div><?$this->template_functions->invalidBrowser_mig()?></div>
    			</div>
    			<div id="menuLat">
    				<div id="logo_site"><h1><img src="<?=_HTTP_IMGPATH_?>/logo.png" alt="<?=_NAME_EMPRESA_?>"/></h1></div>
    				<ul>
    				<?
						$index			= index_page()!="" ? _HTTP_BASEPATH_."/".index_page()."/" : _HTTP_BASEPATH_."/";
    					$classCurrent	= $this->router->class;
						$metodoCurrent	= $this->router->method;
						$activeUl		= "";
						$activeAba		= "glyphicons circle_plus";
						$openAba		= "style=\"display:none\"";
						$menuActive		= "";
    					foreach ($this->check_file_permitions->get_menu_lat() as $key_aba=> $value_aba) {
    						$menu 			= "";
    						foreach ($value_aba as $key_tarefa=>$value_tarefa) {
    							if($classCurrent==$value_tarefa[0]){
    								$activeAba		= "aba_active glyphicons circle_minus";
    								$menuActive		= "active_menu";
    								$openAba		= "style=\"display:block\"";
    								$activeUl		= "class=\"activeUl\"";
    							}
    							$menu.= "<li class=\"menu_sys $menuActive pointer\"><a href=\"{$index}{$value_tarefa[2]}\" title=\"\"> $key_tarefa </a></li>";
    							$menuActive ="";
    							
    						}
    						$aba =  "<li class=\"aba_sys $activeAba pointer \">$key_aba</li>";
    						
    						
    						echo $aba;
    						echo "<li class=\"li_menu_sys\" $openAba><ul $activeUl>";
    						echo $menu;
    						echo "</ul></li>";
    						$activeAba		= "glyphicons circle_plus";
    						$menuActive		= "";
    						$openAba		= "style=\"display:none\"";
    						$activeUl		= "";
    					}
    				?>
					</ul>
    			</div>
    		</div>
    		<div id="contentRight">
    			<div class="top">
    				<div id="actionMenu" class="left">
    					<span class="glyphicons justify"></span>
    				</div>
    				<div id="nameUserLoged" class="right">
    					<span id="nameUser" class="left"><?=$this->session->userdata('username')?></span>
    					<span class="glyphicons lock" id="actionUser" class="left"></span>
    				</div>
    				<div class="clear"></div>
    			</div>
    			<? $this->tollbar->getHtmlTollbar();?>
    			<div id="content">
    				<form id="formAdmin" action="#" method="post" name="adminForm" enctype="multipart/form-data">
    					<input type="hidden" value="<?=_HTTP_BASEPATH_?>" id="HTTP_BASEPATH" />
 						<? 
 						echo $contents;
 						$this->template_functions->getFileForm();
 						?>
 					</form>
    			</div>
    		</div>
    		<div class="clear"></div>
        	
        </div>
        <!-- Html para mensagens e alertas de erro e sucesso-->
        
        <div id="maskError"></div>
         <div id="errorContent">
         	<div id="topErrorContent">
         		<button type="button" id="closeError">×</button>
         		<h4><?=$this->template_functions->getTitleErro()?></h4>
         	</div>
         	<div id="centerErrorContent">
         		<?=$this->template_functions->getError()?>
         	</div>
         	<div id="bottomErrorContent">
         		<button type="button" id="btnCloseError" class="right">Fechar</button>
         	</div>
         </div>
         
         
        <script type="text/javascript" src="<?=_HTTP_JSPATH_?>/backend/template.js"></script>
        <? $this->template_functions->getFileBottom(); ?>
 	</body>  
</html>

