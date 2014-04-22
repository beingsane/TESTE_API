<?
	class Check_file_permitions{
		protected $permitions;
		protected $menu_lat;
		
		protected  function getPathFile() {
			return _BASEPATH_."/application/permitionBackEnd/";
		}
		
		public function get_permitions(){
			return $this->permitions;
		}
		
		public function get_menu_lat(){
			return $this->menu_lat;
		}
		
		
		
		public function __construct() {
			$ci = &get_instance(); 
			/////Verifica se está logado
			if(!$ci->session->userdata('user_id')){
				return false;
			}
			if(file_exists($this->getPathFile()."alter_".$ci->session->userdata('user_id')."_".$ci->session->userdata('name_site').".txt")){
				$this->genereted_new_file();
				unlink($this->getPathFile()."alter_".$ci->session->userdata('user_id')."_".$ci->session->userdata('name_site').".txt");
			}
			if(!file_exists($this->getPathFile()."permitions".$ci->session->userdata('user_id')."_".$ci->session->userdata('name_site').".php")){
				$this->genereted_new_file();
			}
			require $this->getPathFile()."permitions".$ci->session->userdata('user_id')."_".$ci->session->userdata('name_site').".php";
		
		
			$this->permitions 	= ($this->permitions 	? $this->permitions : unserialize($permitionsClasseMetodo));
			$this->menu_lat 	= ($this->menu_lat		? $this->menu_lat 	: unserialize($menuLateral));
			/////Atualiza a data de acesso
			$ci->db->update('sys_usuarios', array("ultimoAcessoSysUsuarios"=> date("Y-m-d H:i:s")) ,array('idSysUsuarios'=>$ci->session->userdata('user_id')));
		}
		
		
		
		protected function genereted_new_file() {
			$ci = &get_instance(); 
			/////Carrega todas as pemições
			$ci->db->distinct();
			$ci->db->select('classeSysMetodos,metodoSysMetodos,abaSysMetodos,descSysMetodos,linkMenu,menuLat,apelidoSysMetodos');    
			$ci->db->from('sys_metodos');
			$ci->db->join('sys_permissoes', 'sys_metodos.idSysMetodos = sys_permissoes.idMetodoSysPermissoes ');
			$ci->db->join('sys_perfiluser', 'sys_perfiluser.idPerfilSysPerfilUser = sys_permissoes.idPerfilSysPermissoes ');
			$ci->db->join('sys_usuarios', 'sys_usuarios.idSysUsuarios = sys_perfiluser.idUserSysPerfil');
			$ci->db->order_by("classeSysMetodos", "ASC");
			$ci->db->order_by("metodoSysMetodos", "ASC");
			$ci->db->where('sys_usuarios.idSysUsuarios', $ci->session->userdata('user_id'));
			$query 		= $ci->db->get();
			$permitions	=array();
			$menuLateral=array();
			foreach ($query->result() as $value) {
				if($value->abaSysMetodos!="" && $value->linkMenu!=''){
					$menuLateral[$value->abaSysMetodos][$value->linkMenu]=array(strtolower($value->classeSysMetodos),strtolower($value->metodoSysMetodos),$value->apelidoSysMetodos);
				}
				$permitions[strtolower($value->classeSysMetodos)][strtolower($value->metodoSysMetodos)] = true;
				
			}
			////Cria o arquivo com as permições
			$pathFilePermition		= _BASEPATH_."/application/permitionBackEnd/";
			$fp 					= fopen($pathFilePermition."permitions".$ci->session->userdata('user_id')."_"._NAME_SITE_LOCAL_.".php", "w+");
			$escreve 				= fwrite($fp, '<? '."\r\n".'$permitionsClasseMetodo = \''.serialize($permitions).'\';'.
														"\r\n ".'$menuLateral=\''.serialize($menuLateral)."';");
			// Fecha o arquivo
			fclose($fp);
		}	
		
		
		
		public function check_permitions($classe,$metodo) {
			if(!isset($this->permitions[$classe][$metodo])){
				return false;
			}
			return true;
		}
		
		
		
		public function newFilePermition($id_user) {
			$pathFilePermition	= _BASEPATH_."/application/permitionBackEnd/";
			if(file_exists($pathFilePermition."permitions".$id_user."_"._NAME_SITE_LOCAL_.".php")){
				unlink($pathFilePermition."permitions".$id_user."_"._NAME_SITE_LOCAL_.".php");
			}
		}
	}