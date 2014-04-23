<?php
class Marcas_model extends CI_Model {
	function lista($id = null, $select = false , $join_veiculo = false) {
		/////Executa os filtros 
		$where	= array();
		if($id){
			$this->db->where('id_marca', $id); 	
			$where["id_marca"] = $id;
		}
		
		if(!$select){
			////Carrega a paginação
			$this->load->library('Pagination');
			$this->pagination->prepare(array("limit"=>25,"filterCompar"=>"marcas","name"=>"list_marcas"));
			/////Carrega o total de acordo com o filtro
			
			$this->pagination->setTotal($this->db->count_all_results('marcas')); 
			$this->db->limit($this->pagination->getLimit(),$this->pagination->getOffset());
		}
		if($join_veiculo){
			$this->db->join('car', 'car.id_marca_rel = marcas.id_marca', 'left');
			$this->db->select("id_marca,
							name_marca,
							id_marca_rel,
							name_car",
					false);
		}else{
		/////Monta o select
		$this->db->select("id_marca,
							id_user_cad,
							name_marca,
							DATE_FORMAT(date_cad, '%d/%m/%Y') as date_cad",
							false);
		}
		$this->db->order_by("name_marca", "ASC"); 
		
		
		$query = $this->db->get_where('marcas',$where);
		
		if(!$select){
			$result	= $query->result();
		} else {
			$result= array();
			foreach ($query->result() as $key => $value) {
				$result[] = array("label" => $value->name_marca, "value" => $value->id_marca);
			}
		}
		return $result;
		
		
		
    }
    
function cadastra_atualiza($id,$nome) {
		$data_bd	= array();
		$data_bd 	= array('name_marca' => $nome);
		
				
		if(!$id){
			$data_bd['date_cad'] 	= date("Y-m-d H:i",time());
			$data_bd['id_user_cad'] = $this->session->userdata('user_id');
			
			$this->db->insert('marcas', $data_bd);
			if($this->db->insert_id()){
				$this->systablog->putLog(0,"backend/marcas/add_commit","A marca com o ID[{$this->db->insert_id()}] foi adicionada com sucesso!");
				$this->template_functions->setError("success","Marca cadastrada com sucesso!","Sucesso");
				return true;
			}else{
				$this->template_functions->setError("error","Erro ao inserir o marca[$nome].","Erro");
				return false;
			}
		}else{
					
			if(!$this->db->update('marcas', $data_bd ,array('id_marca'=>$id))){
				$this->template_functions->setError("error","Erro ao editar a marca[{$nome}]. Entre em contato com o administrador do sistema","Erro");
				return false;
			}else{
				$this->systablog->putLog(0,"backend/marcas/edit_commit","A Marca[{$nome}] com o ID[".$id."] foi editada com sucesso!");
				$this->template_functions->setError("success","A Marca[{$nome}] foi alterada com sucesso.","Alerta");
			}
		}	
		return true;
    }
    
	function delete($id_code) {
		$mensErro		= "não possivel remover";
		$mensSuccess	= "foi removida com sucesso";
		
		foreach ($id_code as $value) {
			$data_info	= $this->lista($value, false, true);
			if($data_info[0]->id_marca_rel=="" || $data_info[0]->id_marca_rel==null){
				$this->db->where('id_marca', $value);
				if(!$this->db->delete('marcas')){
					$this->template_functions->setError("info","A Marca[{$data_info[0]->name_marca}] $mensErro.","Alerta");
				}else{
					$this->systablog->putLog(0,"backend/marcas/delete","A Marca[{$data_info[0]->name_marca}] com o ID[".$value."]  $mensSuccess!");
					$this->template_functions->setError("info","A Marca[{$data_info[0]->name_marca}] $mensSuccess.","Alerta");
				}
			} else {
				$this->template_functions->setError("info","Não é possivel remover a marca[{$data_info[0]->name_marca}] pois ela possui associação com o veículo[{$data_info[0]->name_car}]","Alerta");
			}
		}
		return;
    }
	
    
	
}