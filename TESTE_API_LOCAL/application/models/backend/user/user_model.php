<?php
class User_model extends CI_Model {
	function lista($id_user=null,$lastAcess=null) {
		$this->db->select("idSysUsuarios,
							userNameSysUsuarios,
							nomeSysUsuarios,
							emailSysUsuarios,
							ativoSysUsuarios,
							passwordSysUsuarios,
							DATE_FORMAT(ultimoAcessoSysUsuarios,'%d/%m/%Y %H:%i') as date",false);
		if($id_user){
			$this->db->where('idSysUsuarios', $id_user); 	
		}
		if($lastAcess){
			$this->db->where('ultimoAcessoSysUsuarios >= ',date("Y-m-d H:i:s", time()-300)); 	
		}
		$query = $this->db->get('sys_usuarios');
		return $query->result();
    }
    
	function cadastra_atualiza($idSysUsuarios,$userNameSysUsuarios,$nomeSysUsuarios,$emailSysUsuarios,$passwordSysUsuarios=null,$perfis=null) {
		$dataInsert = array(
					'userNameSysUsuarios' 		=> $userNameSysUsuarios ,
					'nomeSysUsuarios' 			=> $nomeSysUsuarios ,
					'emailSysUsuarios' 			=> $emailSysUsuarios,
					'ativoSysUsuarios'			=> 0,
					'ultimoAcessoSysUsuarios' 	=> null,
					'passwordSysUsuarios'		=> md5($passwordSysUsuarios),
					'metodoPadraoSysUsuarios'	=> 0
				);
				
		if($passwordSysUsuarios){
			$dataUpdate = array(
					'userNameSysUsuarios' 		=> $userNameSysUsuarios ,
					'nomeSysUsuarios' 			=> $nomeSysUsuarios ,
					'emailSysUsuarios' 			=> $emailSysUsuarios,
					'ultimoAcessoSysUsuarios' 	=> null,
					'passwordSysUsuarios'		=> md5($passwordSysUsuarios),
					'metodoPadraoSysUsuarios'	=> 0
				);
		}else{
			$dataUpdate = array(
					'userNameSysUsuarios' 		=> $userNameSysUsuarios ,
					'nomeSysUsuarios' 			=> $nomeSysUsuarios ,
					'emailSysUsuarios' 			=> $emailSysUsuarios,
					'ultimoAcessoSysUsuarios' 	=> null,
					'metodoPadraoSysUsuarios'	=> 0
				);
		}
		
				
		if(!$idSysUsuarios){
			$this->db->insert('sys_usuarios', $dataInsert);
			if($this->db->insert_id()){
				$idSysUsuarios = $this->db->insert_id();
				$this->systablog->putLog(0,"backend/user_backend/add_commit","O Usuário[$nomeSysUsuarios] com o ID[".$this->db->insert_id()."]  foi criado com sucesso!");
				$this->template_functions->setError("success","O Usuário[$nomeSysUsuarios] foi cadastrado com sucesso","Alerta");
			}else{
				$this->template_functions->setError("error","Erro ao inserir o Usuário[$nomeSysUsuarios]. Verifique o nome do usuário[$userNameSysUsuarios] e o email[$emailSysUsuarios] não são duplicados.","Erro");
				return false;
			}
		}else{
			if(!$this->db->update('sys_usuarios', $dataUpdate ,array('idSysUsuarios'=>$idSysUsuarios))){
				$this->template_functions->setError("error","Erro ao editar o Usuário[$nomeSysUsuarios].Verifique o nome do usuário[$userNameSysUsuarios] não é duplicado.","Erro");
				return false;
			}else{
				$this->template_functions->setError("success","O Usuário[$nomeSysUsuarios] foi alterado com sucesso!","Sucesso");
				$this->check_file_permitions->newFilePermition($idSysUsuarios);
			}
		}		
		if(is_array($perfis)){
			/////Remove todas os perfis antigos e insere as novas
			$this->db->where('idUserSysPerfil', $idSysUsuarios);
			$this->db->delete("sys_perfiluser");
			foreach ($perfis as $value) {
				$dataInsert = array(
						'idUserSysPerfil' 		=> $idSysUsuarios ,
						'idPerfilSysPerfilUser' => $value
					);
				$this->db->insert('sys_perfiluser', $dataInsert);
			}	
		}	
		return true;
    }
    
    
    
	function lista_perfis($id,$data_all=false) {
		$this->db->select("idSysPerfil,idPerfilSysPerfilUser,nameSysPerfil,descSysPerfil,ativoSysPerfil",false);
		$this->db->join('sys_perfil', "idPerfilSysPerfilUser=idSysPerfil" );
		$this->db->where('sys_perfiluser.idUserSysPerfil =' , $id); 		
		$query = $this->db->get('sys_perfiluser');
		$retval = array();
		if(!$data_all){
			foreach ($query->result() as $value) {
				$retval[] = $value->idPerfilSysPerfilUser;
			}
		}else{
			$retval=$query->result();
		}
		return $retval;
    }
    
	function block_unblock($idSysUsuarios,$type) {
		if($type=="block"){
			$valueUpdate 	= 0;
			$mensErro		= "já está desativado";
			$mensSuccess	= "desativado com sucesso";
		}else{
			$valueUpdate = 1;
			$mensErro		= "já está ativado";
			$mensSuccess	= "ativado com sucesso";
		}
		$dataUpdate = array('ativoSysUsuarios' => $valueUpdate);
		
		foreach ($idSysUsuarios as $value) {
			$userData	= $this->lista($value);
			if(!$this->db->update('sys_usuarios', $dataUpdate ,array('idSysUsuarios'=>$value))){
				$this->template_functions->setError("info","O Usuário[{$userData[0]->nomeSysUsuarios}] $mensErro.","Alerta");
			}else{
				$this->systablog->putLog(0,"backend/user_backend/block_unblock","O Usuário[{$userData[0]->nomeSysUsuarios}] com o ID[".$value."]  foi $mensSuccess!");
				$this->template_functions->setError("info","O Usuário[{$userData[0]->nomeSysUsuarios}] foi $mensSuccess.","Alerta");
			}
			
		}
		return;
    }
	function load_user_valid($email_user=null,$name_user=null,$id_user) {
		
		$this->db->select("idSysUsuarios,
							userNameSysUsuarios,
							nomeSysUsuarios,
							emailSysUsuarios,
							ativoSysUsuarios,
							passwordSysUsuarios,
							DATE_FORMAT(ultimoAcessoSysUsuarios,'%d/%m/%Y %H:%i') as date",false);
		if($email_user){
			$this->db->where('emailSysUsuarios', $email_user); 	
			$this->db->where('idSysUsuarios !=', $id_user); 
		}
		if($name_user){
			$this->db->where('userNameSysUsuarios', $name_user);
			$this->db->where('idSysUsuarios !=', $id_user);  	
		}
		$query = $this->db->get('sys_usuarios');
		
		return $query->result();
    }
}