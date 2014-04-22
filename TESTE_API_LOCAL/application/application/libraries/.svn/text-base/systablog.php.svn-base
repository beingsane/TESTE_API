<?
class Systablog{
	private $idModule;
	private $idUser;
	private $nameUser;
	
	public function putLog($type=0,$module,$desc){
		$ci = &get_instance();      
		$data = array(
		'idUserSysLog'		=> $ci->session->userdata('user_id'),
		'userDescSysLog'	=> $ci->session->userdata('username'),
		'moduleSysLog'		=> $module,
		'dateTimeSysLog'	=> date("Y-m-d H:i:s"),
		'infoSysLog' 		=> $desc,
		'type_log' 			=> $type
		);
		$ci->db->insert('sys_log', $data); 
	}
			
}
	