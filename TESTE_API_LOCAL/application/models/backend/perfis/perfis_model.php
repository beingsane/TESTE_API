<?php
class Perfis_model extends CI_Model {
	function lista($id_perfil=null) {
		$this->db->select("*",false);
		if($id_perfil){
			$where = array('idSysPerfil' => $id_perfil);
			$this->db->where($where); 	
		}
		$query = $this->db->get('sys_perfil');
		return $query->result();
    }
    
	function cadastra_atualiza($idSysPerfil,$nameSysPerfil,$descSysPerfil,$attributesSysPerfil,$permicoes) {
		$dataInsert = array(
					'nameSysPerfil' 		=> $nameSysPerfil ,
					'descSysPerfil' 		=> $descSysPerfil ,
					'attributesSysPerfil' 	=> $attributesSysPerfil,
					'ativoSysPerfil'		=> 0
				);
		$dataUpdate = array(
					'nameSysPerfil' 		=> $nameSysPerfil ,
					'descSysPerfil' 		=> $descSysPerfil ,
					'attributesSysPerfil' 	=> $attributesSysPerfil
				);
				
		if(!$idSysPerfil){
			$this->db->insert('sys_perfil', $dataInsert);
			if($this->db->insert_id()){
				$idSysPerfil = $this->db->insert_id();
				$this->systablog->putLog(0,"backend/perfis_backend/add_commit","O Perfil[$nameSysPerfil] com o ID[".$this->db->insert_id()."]  foi criado com sucesso!");
				$this->template_functions->setError("success","O Perfil[$nameSysPerfil] foi cadastrado com sucesso","Alerta");
			}else{
				$this->template_functions->setError("error","Erro ao inserir o Perfil[$nameSysPerfil]. Verifique o nome do usuário se não é duplicado.","Erro");
				return false;
			}
		}else{
			if(!$this->db->update('sys_perfil', $dataUpdate ,array('idSysPerfil'=>$idSysPerfil))){
				$this->template_functions->setError("error","Erro ao editar o Perfil[$nameSysPerfil]. Verifique o nome do usuário se não é duplicado.","Erro");
				return false;
			}else{
				$this->systablog->putLog(0,"backend/perfis_backend/edit_commit","O Perfil[$nameSysPerfil] com o ID[".$idSysPerfil."]  foi alterado com sucesso!");
				$this->template_functions->setError("success","O Perfil[$nameSysPerfil] foi alterado com sucesso","Alerta");
			}
			/////carrega todos os usuários que possuem esse perfil
			$this->db->where('idPerfilSysPerfilUser', $idSysPerfil);
			$query 		= $this->db->get('sys_perfiluser');
			$user_result= $query->result();
			foreach ($user_result as $key => $value) {
				$this->check_file_permitions->newFilePermition($value->idUserSysPerfil);
			}
			
			
		}		
		/////Remove todas as permições antigas e insere as novas
		$this->db->where('idPerfilSysPermissoes', $idSysPerfil);
		$this->db->delete("sys_permissoes");
		foreach ($permicoes as $value) {
			$id= explode("#", $value);
			$dataInsert = array(
					'idMetodoSysPermissoes' 		=> $id[0] ,
					'idPerfilSysPermissoes' 		=> $idSysPerfil,
					'classe_methodo'				=> $id[1]."/".$id[2]
				);
			$this->db->insert('sys_permissoes', $dataInsert);
		}		
		return true;
    }
    
    
    
	function lista_permicoes($id) {
		$this->db->select("idMetodoSysPermissoes",false);
		$this->db->where('idPerfilSysPermissoes =', $id); 	
		$query = $this->db->get('sys_permissoes');
		$retval = array();
		foreach ($query->result() as $value) {
			$retval[] = $value->idMetodoSysPermissoes;
		}
		return $retval;
    }
    
	function block_unblock($idSysPerfil,$type) {
		if($type=="block"){
			$valueUpdate 	= 0;
			$mensErro		= "já está desativado";
			$mensSuccess	= "desativado com sucesso";
		}else{
			$valueUpdate = 1;
			$mensErro		= "já está ativado";
			$mensSuccess	= "ativado com sucesso";
		}
		$dataUpdate = array('ativoSysPerfil' => $valueUpdate);
		
		foreach ($idSysPerfil as $value) {
			$perfilData	= $this->lista($value);
			if(!$this->db->update('sys_perfil', $dataUpdate ,array('idSysPerfil'=>$value))){
				$this->template_functions->setError("info","O Perfil[{$perfilData[0]->nameSysPerfil}] $mensErro.","Alerta");
			}else{
				$this->systablog->putLog(0,"backend/perfis_backend/block_unblock","O Perfil[{$perfilData[0]->nameSysPerfil}] com o ID[".$value."]  foi $mensSuccess!");
				$this->template_functions->setError("info","O Perfil[{$perfilData[0]->nameSysPerfil}] foi $mensSuccess.","Alerta");
			}
			
		}
		return;
    }
}