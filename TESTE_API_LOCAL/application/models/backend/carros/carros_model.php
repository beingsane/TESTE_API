<?php
class Carros_model extends CI_Model {
	function lista($id = null) {
		/////Executa os filtros 
		$where	= array();
		if($id){
			$this->db->where('id_car', $id); 	
			$where["id_car"] = $id;
		}
		
		////Carrega a paginação
		$this->load->library('Pagination');
		$this->pagination->prepare(array("limit"=>25,"filterCompar"=>"carros","name"=>"list_carros"));
		/////Carrega o total de acordo com o filtro
		
		$this->pagination->setTotal($this->db->count_all_results('car')); 
		$this->db->limit($this->pagination->getLimit(),$this->pagination->getOffset());
		$this->db->join('sys_usuarios', 'sys_usuarios.idSysUsuarios = car.id_user_rel');
		$this->db->join('marcas', 'marcas.id_marca = car.id_marca_rel');
	
		/////Monta o select
		$this->db->select("id_car,
							name_car,
							id_marca_rel,
							img,
							value_car,
							parc_number,
							value_Total_interest,
							DATE_FORMAT(car.date_cad, '%d/%m/%Y') as date_cad,
							nomeSysUsuarios,
							idSysUsuarios,
							name_marca,
							year",
							false);
		$this->db->order_by("name_car", "DESC"); 
		
		
		$query = $this->db->get_where('car',$where);
		return $query->result();
		
		
		
    }
    
	function cadastra_atualiza($id, $modelo,
										$marca,
										$ano,
										$valor = null,
										$parcela,
										$image = null,
										$alter_value = null) {
		$totalJuros 	= $parcela*0.7;
		$valorJuros		= $valor*($totalJuros/100);
		
		$data_bd = array(
					'id_marca_rel' 		=> $marca,
					'parc_number'		=> $parcela,
					'year'				=> $ano,
					'name_car'			=> $modelo	
				);
				
		if(!$id){
			$totalJuros 	= $parcela*0.7;
			$valorJuros		= $valor*($totalJuros/100);
			
			$data_bd['date_cad'] 			= date("Y-m-d H:i",time());
			$data_bd['id_user_rel'] 		= $this->session->userdata('user_id');
			$data_bd['value_car']			= $valor;
			$data_bd['value_Total_interest']= $valor+$valorJuros;
			$data_bd['img']					= $image;
			
			$this->db->insert('car', $data_bd);
			if($this->db->insert_id()){
				$this->systablog->putLog(0,"backend/carros/add_commit","O carro com o ID[$this->db->insert_id()] com o marca[$marca]  foi adicionado com sucesso!");
				$this->template_functions->setError("success","Carro cadastrado com sucesso!","Sucesso");
				return true;
			}else{
				$this->template_functions->setError("error","Erro ao inserir o carro[$modelo].","Erro");
				return false;
			}
		}else{
			$totalJuros 	= $parcela*0.7;
			
			if($alter_value){
				$valorJuros		= $valor*($totalJuros/100);
				$data_bd['value_Total_interest']= $valor+$valorJuros;
			} else {
				$this->db->select("value_car");
				$query = $this->db->get_where('car',array("id_car"=>$id));
				$value_result	= $query->result();
				$value 			= $value_result[0]->value_car;
				$valorJuros		= $value*($totalJuros/100);
				$data_bd['value_Total_interest']= $value+$valorJuros;
			}
			if($image){
				$data_bd['img']= $image;
			}
			
			
			if(!$this->db->update('car', $data_bd ,array('id_car'=>$id))){
				$this->template_functions->setError("error","Erro ao editar o carro. Entre em contatio com o administrador do siyyytema","Erro");
				return false;
			}else{
				$this->systablog->putLog(0,"backend/carros/edit_commit","O carro[{$modelo}] com o ID[".$id."]  foi editado com sucesso!");
				$this->template_functions->setError("success","O carro[{$modelo}] foi alterado com sucesso.","Alerta");
			}
		}	
		return true;
    }
    
	function delete($id_code) {
		$mensErro		= "não possivel remover";
		$mensSuccess	= "foi removido com sucesso";
		
		foreach ($id_code as $value) {
			$data_info	= $this->lista($value);
			$this->db->where('id_car', $value);
			if(!$this->db->delete('car')){
				$this->template_functions->setError("info","O carro[{$data_info[0]->name_car}] $mensErro.","Alerta");
			}else{
				/////Remove a imagem do carro
				if(file_exists(_BASEPATH_."/public/img/carros/".$data_info[0]->img)){
					unlink(_BASEPATH_."/public/img/carros/".$data_info[0]->img);
				}
				$this->systablog->putLog(0,"backend/carros/delete","O carro[{$data_info[0]->name_car}] com o ID[".$value."]  $mensSuccess!");
				$this->template_functions->setError("info","O carro[{$data_info[0]->name_car}] $mensSuccess.","Alerta");
			}
			
		}
		return;
    }
	
    
	
}