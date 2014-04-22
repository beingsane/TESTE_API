<?
class Roles_mig_json extends CI_Controller_Auth_JSON {
	public function edit()	{
		$data 	= array("errorCode"=>0,"errorDesc"=>"sucesso");
		$id		= $this->input->post("id");
		$aba	= $this->input->post("aba");
		$modulo	= $this->input->post("modulo");
		$desc	= $this->input->post("desc");
		$menu	= $this->input->post("menu");
		$menuLat= 1;
		if(!is_numeric($id)){
			$data 	= array("errorCode"=>1002,"errorDesc"=>"Erro na validação dos parametros.");
			echo json_encode($data);
			return;
			
		}
		if($menu==null || $menu==""){
			$menuLat = 0;
		}
		
		$update = array(
            'abaSysMetodos' 	=> $aba,
            'moduloSysMetodos' 	=> $modulo,
            'descSysMetodos' 	=> $desc,
			'menuLat' 			=> $menuLat,
			'linkMenu' 			=> $menu
        );
		if(!$this->db->update('sys_metodos', $update ,array('idSysMetodos'=>$id))){
			$data 	= array("errorCode"=>1001,"errorDesc"=>"Erro ao atualizar dados.<br/>Entre em contato com o administrador do sitema");
		}else{
			//////Verifica se alterou algum dado da tabela 
			if($this->db->affected_rows()>0){
				/////Busca todos os usuários que possuem essa tarefa e cria um arquivo para alterar o menu lateral
				$this->db->distinct();
				$this->db->select('idSysUsuarios,nomeSysUsuarios');    
				$this->db->from('sys_usuarios');
				$this->db->join('sys_perfiluser', 'sys_usuarios.idSysUsuarios = sys_perfiluser.idUserSysPerfil ');
				$this->db->join('sys_permissoes', 'sys_permissoes.idPerfilSysPermissoes=sys_perfiluser.idUserSysPerfil');
				$this->db->where('sys_permissoes.idMetodoSysPermissoes', $id);
				$query = $this->db->get();
				/////Cria os arquivos para alteração
				foreach ($query->result() as $value) {
					$this->check_file_permitions->newFilePermition($value->idSysUsuarios);
				}
			}   
		}
		echo json_encode($data);
	}
	public function remove()	{
		$data 	= array("errorCode"=>0,"errorDesc"=>"sucesso");
		$id		= $this->input->post("id");
		if(!is_numeric($id)){
			$data 	= array("errorCode"=>1002,"errorDesc"=>"Erro na validação dos parametros.");
			echo json_encode($data);
			return;
			
		}
		$this->db->where('idSysMetodos', $id);
		if($this->db->delete('sys_metodos')){
			$this->systablog->putLog(0,"backend/roles_backend_json/remove","O Método com o ID[".$id."]  foi removido com sucesso!");
			$data 	= array("errorCode"=>0,"errorDesc"=>"Metodo removido com sucesso!");
		}else{
			$data 	= array("errorCode"=>1001,"errorDesc"=>"Erro ao atualizar dados.<br/>Entre em contato com o administrador do sitema");
		}
		echo json_encode($data);
	}
}