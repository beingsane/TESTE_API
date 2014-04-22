<?php
class Logs_model extends CI_Model {
	function lista($type="",$user="",$model="") {
		/////Executa os filtros 
		$where	= array();
		if($type && $type!=" "){
			$this->db->where('type_log', $type); 
			$where["type_log"]=$type;
		}
		if($user && $user!=" "){
			$this->db->where('idUserSysLog', $user); 
			$where["idUserSysLog"]=$user;
		}
		if($model && $model!=" "){
			$this->db->where('moduleSysLog', $model); 
			$where["moduleSysLog"]=$model;
		}
		////Carrega a paginação
		$this->load->library('Pagination');
		$this->pagination->prepare(array("limit"=>25,"filterCompar"=>"logs","name"=>"log"));
		/////Carrega o total de acordo com o filtro
		$this->pagination->setTotal($this->db->count_all_results('sys_log')); 
		$this->db->limit($this->pagination->getLimit(),$this->pagination->getOffset());
		
		/////Monta o select
		$this->db->select("idUserSysLog,userDescSysLog,moduleSysLog,infoSysLog,type_log,DATE_FORMAT(dateTimeSysLog, '%d/%m/%Y %H:%i:%s') as data",false);
		$this->db->order_by("idSysLog", "DESC");
		$query = $this->db->get_where('sys_log',$where);
		return $query->result();
    }
    
	
}