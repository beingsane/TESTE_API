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
		$this->db->join('brand', 'brand.id_brand = car.id_brand_rel');
	
		/////Monta o select
		$this->db->select("id_car,
							name_car,
							id_brand_rel,
							img,
							value_car,
							parc_number,
							DATE_FORMAT(year, '%d/%m/%Y') as ano,
							value_Total_interest,
							DATE_FORMAT(car.date_cad, '%d/%m/%Y') as date_cad,
							nomeSysUsuarios,
							idSysUsuarios,
							name_brand",
							false);
		$this->db->order_by("date_cad", "DESC"); 
		
		
		$query = $this->db->get_where('car',$where);
		return $query->result();
		
		
		
    }
    
	function cadastra_atualiza($id, $id_produto_compra=null, $qtd_compra, $valor_unitario, $data_compra, $obs_compra) {
		$data_bd = array(
					'qtd_compra' 				=> $qtd_compra,
					'valor_unitario'			=> $valor_unitario,
					'data_compra'				=> $data_compra,
					'obs_compra'				=> $obs_compra	
				);
				
		if(!$id){
			$data_bd['id_produto_compra'] = $id_produto_compra;
			$this->db->insert('bebidas_cabral_compras', $data_bd);
			if($this->db->insert_id()){
				$id_insert = $this->db->insert_id();
				
				/////Atualiza a quantidade em estoque
				$this->db->where('id_produto', $id_produto_compra);
				$this->db->set("qtd_produto", "qtd_produto+$qtd_compra", false);
				$this->db->set("date_atualizacao_produto" , date("Y-m-d H:i:s",time()), true);
				if(!$this->db->update('bebidas_cabral_produtos')){
					$this->template_functions->setError("error","Erro ao editar a quantidade em estoque.Entre em contato com o administrador do sistema","Erro");
					return false;
				}else{
					$this->systablog->putLog(0,"backend/compras/add_commit","Foi alterado com sucesso a quantidade em estoque do produto[$id_produto_compra] Quantidade[$qtd_compra]!");
				}
				$this->systablog->putLog(0,"backend/compras/add_commit","A compra com o ID[$id_insert] com o produto[$id_produto_compra] e com quantidade[$qtd_compra] e valor[$valor_unitario] foi adicionada com sucesso!");
				$this->template_functions->setError("success","Produto(s) cadastrado(s) com sucesso!","Sucesso");
				return true;
			}else{
				$this->template_functions->setError("error","Erro ao inserir o produto[$nome_produto]. Verifique o nome do produto[$nome_produto] não são duplicados.","Erro");
				return false;
			}
		}elseif(!$id_produto_compra){
			/////Pega o valor antigo de quantidade e diminui do estoque
			$this->db->select("qtd_compra,id_produto_compra");
			$query = $this->db->get_where('bebidas_cabral_compras',array("id_compra"=>$id));
			$qtd_result	= $query->result();
			$this->db->where('id_produto', $qtd_result[0]->id_produto_compra);
			$this->db->set("qtd_produto", "qtd_produto-{$qtd_result[0]->qtd_compra}", false);
			$this->db->set("date_atualizacao_produto" , date("Y-m-d H:i:s",time()), true);
			if(!$this->db->update('bebidas_cabral_produtos')){
				$this->template_functions->setError("error","Erro ao atualizar quantidade em estoque.","Erro");
				return false;
			}else{
				$this->systablog->putLog(0,"backend/compras/edit_commit","Foi decrementado o estoque do produto com o ID[".$id."] o valor de -[{$qtd_result[0]->qtd_compra}]!");
				/////Tenta fazer o update da compra
				if(!$this->db->update('bebidas_cabral_compras', $data_bd ,array('id_compra'=>$id))){
					$this->template_functions->setError("error","Erro ao editando compra.","Erro");
					return false;
				}else{
					/////Atualiza o estoque novamente
					$this->db->where('id_produto', $qtd_result[0]->id_produto_compra);
					$this->db->set("qtd_produto", "qtd_produto+{$qtd_compra}", false);
					$this->db->set("date_atualizacao_produto" , date("Y-m-d H:i:s",time()), true);
					if(!$this->db->update('bebidas_cabral_produtos')){
						$this->template_functions->setError("error","Erro ao atualizar quantidade em estoque com o novo valor.","Erro");
						return false;
					}
					$this->systablog->putLog(0,"backend/produtos/edit_commit","A compra com o ID[".$id."] foi alterada com sucesso!");
					$this->template_functions->setError("success","Compra alterada com sucesso!","Sucesso");
				}
			}
		}		
		return true;
    }
    
	function delete($id_code,$type) {
		if($type=="block"){
			$valueUpdate 	= 0;
			$mensErro		= "já está desativado";
			$mensSuccess	= "desativado com sucesso";
		}else{
			$valueUpdate = 1;
			$mensErro		= "já está ativado";
			$mensSuccess	= "ativado com sucesso";
		}
		$dataUpdate = array('ativo_produto' => $valueUpdate);
		
		foreach ($id_code as $value) {
			$data_info	= $this->lista($value);
			if(!$this->db->update('bebidas_cabral_produtos', $dataUpdate ,array('id_produto'=>$value))){
				$this->template_functions->setError("info","O produto[{$data_info[0]->nome_produto}] $mensErro.","Alerta");
			}else{
				$this->systablog->putLog(0,"backend/produtos/block_unblock","O produto[{$data_info[0]->nome_produto}] com o ID[".$value."]  foi $mensSuccess!");
				$this->template_functions->setError("info","O produto[{$data_info[0]->nome_produto}] foi $mensSuccess.","Alerta");
			}
			
		}
		return;
    }
	
    
	
}