<?
class Roles_mig extends CI_Controller_Auth_Permition {
	public function index()	{
		$data =array();
		//CI_Controller_Auth_Permition
		/////Lê todas as classes do backend
		$path 			= _BASEPATH_."/application/controllers/backend/";
   		$diretorio 		= dir($path);
    	$MethodoName	= array();
		//echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";    
		while($arquivo = $diretorio -> read()){ 
			if($arquivo=="." || $arquivo==".."){
				continue;
			}
			include_once "$path".$arquivo;
			$className		= explode(".",$arquivo);
			$nameClass		= ucwords($className[0]);
			$api 			= new ReflectionClass($nameClass);
			$insertData		= array();
        	$permissao		= 0;
        	$classCurrent 	= null;
        	
			foreach($api->getMethods() as $key => $method){
			 	/////Verifica o tipo de permição
			 	if(!$permissao){
					switch ($method->class) {
						case "CI_Controller_Auth_Login"			: $permissao = -1; break;
						case "CI_Controller_Auth"				: $permissao = 1; break;
						case "CI_Controller_Auth_Permition"		: $permissao = 2; break;
						case "CI_Controller_Permition"			: $permissao = 3; break;
						case "CI_Controller_Auth_JSON"			: $permissao = 4; break;
						case "CI_Controller_Auth_Permition_JSON": $permissao = 5; break;
						
					}	
				}
				
				if($method->class==$nameClass){
					$MethodoName[]	= 'backend/'.strtolower($nameClass)."/".$method->name;
					$insertData	[]	= $method->name;
				}
			}
			
			/////Faz a inserção dos metodos
			foreach ($insertData as  $valueInsert) {
				
				$linkUrl 	= 'backend/'.strtolower($nameClass)."/".$valueInsert;
				$dataInsert = array(
					'classeSysMetodos' 		=> $nameClass ,
					'metodoSysMetodos' 		=> $valueInsert ,
					'apelidoSysMetodos' 	=> $linkUrl,
					'privadoSysMetodos'		=> $permissao,
					'abaSysMetodos' 		=> '',
					'moduloSysMetodos' 		=> '',
					'descSysMetodos' 		=> '',
					'menuLat' 				=> 0,
					'linkMenu' 				=> ""
				);
				$this->db->where('apelidoSysMetodos', $linkUrl);
				$query = $this->db->get('sys_metodos');
				if($query->num_rows() == 0){
				 	$this->db->insert('sys_metodos', $dataInsert);
				    $this->systablog->putLog(0,"backend/Roles_backend","o Método[$valueInsert] da classe[$nameClass]  foi criada com sucesso!");   
				}else{
					/////Faz o update 
					$update = array(
						'privadoSysMetodos'		=> $permissao
					);
					$this->db->update('sys_metodos', $update ,array('apelidoSysMetodos'=>'backend/'.strtolower($nameClass)."/".$valueInsert));
					if($this->db->affected_rows()>0){
						$this->systablog->putLog(0,"backend/Roles_backend","o Método[$valueInsert] da classe[$nameClass] foi alterado com sucesso!");
					}   
				}
			}
			
		}
		$diretorio -> close();
		
		/////Seleciona todos os métodos cadastrados
		$this->db->from("sys_metodos");
		$this->db->order_by("classeSysMetodos", "ASC");
		$this->db->order_by("metodoSysMetodos", "ASC");
		$query = $this->db->get(); 
		
		
		$data['methodos']	= $MethodoName;
		$data['result']		= $query->result();
		$this->tollbar->setTextTollbar('glyphicons git_private','Regras para o menu lateral!');
		$this->template->load('template/backEndTemplate','backend/roles_backend',$data);
	}
}