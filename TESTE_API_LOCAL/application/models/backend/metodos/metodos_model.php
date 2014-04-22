<?php
class Metodos_model extends CI_Model {
	function lista() {
		$this->db->select("*",false);
		$this->db->where('descSysMetodos !=', ""); 	
		$this->db->order_by("classeSysMetodos", "ASC");
		$this->db->order_by("metodoSysMetodos", "ASC");
		$query = $this->db->get('sys_metodos');
		return $query->result();
    }
    
	
}