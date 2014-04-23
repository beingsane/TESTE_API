<?php
class Exec_login extends CI_Model {
	function efutua_login($user_name,$senha) {
		$this->db->select('nomeSysUsuarios, emailSysUsuarios, ,idSysUsuarios, metodoPadraoSysUsuarios');
		$where = array('userNameSysUsuarios' => $user_name, 'passwordSysUsuarios' => md5($senha), 'ativoSysUsuarios' => 1);
		$this->db->where($where); 
		$query = $this->db->get('sys_usuarios');
		if($query->num_rows<1){
			return false;
		}
		/////Seta as variavies para a sessão
		$data = array(
				'user_id' 	=> $query->row()->idSysUsuarios,
				'username' 	=> $query->row()->nomeSysUsuarios,
				'name_site' => _NAME_SITE_LOCAL_,
			);
		$this->session->set_userdata($data);
		$this->systablog->putLog(0,"backend/login/exec_login","O usuário [{$query->row()->nomeSysUsuarios}] ID[{$query->row()->idSysUsuarios}] se logou no sistema!");
		return true;
    }
}