<?
class Carros extends CI_Controller_Auth_Permition {
	public function index()	{
		$data	= array();
		/////carregas os carros cadastrados
		$this->load->model('backend/carros/carros_model', 'load_carros');
		$data['cars'] = $this->load_carros->lista(null,1,true);
		
		/////Monta a tollbar
		$this->tollbar->setTextTollbar('glyphicons car','Carros');
		$this->tollbar->setTollbar("Carros",	"Adicionar",	"backend", "carros","add_form");
		
		/////Carrega a view
		$this->template->load('template/backEndTemplate','backend/carros/index',$data);
	}
	
	
	public function add_form(){
		$this->load->library('text_input');
		$this->load->library('text_area_input');
		$this->load->library('text_hidden');
		////Carrega a paginaÃ§Ã£o
		$this->load->library('Pagination');
	
		$data 			= array();
		$data['idProdAdded'] 		= $this->input->post("idProdAdded");
		$data['prodSell'] 			= $this->input->post("prodSell");
		$data['eanSell'] 			= $this->input->post("eanSell");
		$data['qtd'] 				= $this->input->post("qtd");
		$data['valor'] 				= $this->input->post("valor");
		$data['data_compra'] 		= $this->input->post("data_compra");
		$data['hora_compra'] 		= $this->input->post("hora_compra");
		$data['desc'] 				= $this->input->post("desc");
		
		/////Carrega os produtos cadastrados
		$this->load->model('backend/produtos/produtos_model', 'load_produtos');
		$produtos		= $this->load_produtos->lista(null, null , 1);
		$produtos_sel 	= '[';
		foreach ($produtos as $key => $value) {
			$produtos_sel.= "{'label':'".$value->nome_produto ." | ".$value->abrev_unidade." | ".$value->ean_produto."','valueProd':".$value->id_produto.",'eanProd':".$value->ean_produto."},";
		}
		$produtos_sel	.= '];';
		$data['produtos'] = $produtos_sel;
		
		$this->tollbar->setTextTollbar('glyphicons money','Gerenciamento de compras : Adicionar!');
		$this->tollbar->setTollbar("Salvar",	"circle_ok",			"backend",	"compras",	"add_commit");
		$this->tollbar->setTollbar("Voltar",	"circle_arrow_left",	"backend",	"compras",	"index");
		
		$this->template->load('template/backEndTemplate','backend/compras/form',$data);
	}
	
	
	public function add_commit()	{
		$data 			= array();
				
		$idProdAdded	= $this->input->post("idProdAdded") ? $this->input->post("idProdAdded") : array();
		$prodSell		= $this->input->post("prodSell");
		$eanSell		= $this->input->post("eanSell");
		$qtd			= $this->input->post("qtd");
		$valor	 		= $this->input->post("valor");
		$data_compra	= $this->input->post("data_compra");
		$hora_compra	= $this->input->post("hora_compra");
		$desc			= $this->input->post("desc");
		
		
		/////ValidaÃ§Ã£o dos campos
		$error						= array();
		if(count($idProdAdded)<1){
			$error[] = "";	$this->template_functions->setError("info","Adicione ao menos um produto!","Alerta");
		}
		foreach ($idProdAdded as $key => $value) {
			if($qtd[$key]=="" || !is_numeric($qtd[$key]) || $qtd[$key]<=0 ||  $valor[$key]=="" || !is_numeric($valor[$key]) || $valor[$key]<=0){
				$error[] = "";	$this->template_functions->setError("info","Verifique os campos em vermelho!","Alerta");
			}
		}
		$data_separated							= explode("/", $data_compra);
		if((!$data_separated[0] || !$data_separated[1] || !$data_separated[2]) 
				||
			!checkdate ($data_separated[1], $data_separated[0], $data_separated[2])){
				$error[]	= "";	
				$this->template_functions->setError("info","Preencha uma data de compra vÃ¡lida","Alerta");
		}
		if(!$hora_compra)			{$error[]	= "";	$this->template_functions->setError("info","Preencha a hora da compra","Alerta");}
		if(count($error)){
			$this->add_form();
			return;
		}
		
		
		$dateTime								= $data_separated[2]."-".$data_separated[1]."-".$data_separated[0]." ".$hora_compra."00";
		/////Executa o cadastro
		$this->load->model('backend/compras/compras_model', 'add');
		foreach ($idProdAdded as $key => $value) {
			
			$this->add->cadastra_atualiza(null,$value,$qtd[$key],$valor[$key],$dateTime,$desc);
		}
		
		$this->index();
	}
	
	
	public function edit_form()	{
		/////Carrega o grupo
		$id_code 	= $this->input->post("id_code");
		$this->load->model('backend/compras/compras_model', 'load_compra');
		$result		= $this->load_compra->lista($id_code[0]);
		$data = array(
					"id_code"			=>	$id_code[0],
					"nome_produto"		=>	$result[0]->nome_produto,
					"ean_produto"		=>	$result[0]->ean_produto,
					"nome_unidade"		=>	$result[0]->nome_unidade,
					"nome_grupo"		=>	$result[0]->nome_grupo,
					"qtd_compra"		=>	$result[0]->qtd_compra,
					"valor_unitario"	=>	$result[0]->valor_unitario,
					"obs_compra"		=>	$result[0]->obs_compra,
					"data_compra"		=>  $result[0]->data_compra,
					"hora_compra"		=>  $result[0]->hora_compra
				);

		$this->load->library('text_input');
		$this->load->library('text_area_input');
		$this->load->library('text_hidden');
		$this->load->library('Pagination');
		
		$this->tollbar->setTextTollbar('glyphicons money',	'Gerenciamento de compras: Editar!');
		$this->tollbar->setTollbar("Salvar","circle_ok",		"backend",	"compras",	"edit_commit");
		$this->tollbar->setTollbar("Remover","bin",				"backend",	"compras",	"remove_comit");
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend",	"compras",	"index");
		
		
		$this->template->load('template/backEndTemplate','backend/compras/form_edit',$data);
	}
	
	
	
	public function edit_commit()	{
		$data 			= array();
		$id_code		= $this->input->post("id_code");
		$qtd			= $this->input->post("qtd_compra");
		$valor	 		= $this->input->post("valor_unitario");
		$data_compra	= $this->input->post("data_compra");
		$hora_compra	= $this->input->post("hora_compra");
		$desc			= $this->input->post("desc");
		
		/////ValidaÃ§Ã£o dos campos
		$error						= array();
		if(!is_array($id_code))				{$error[] = "";	$this->template_functions->setError("info","Selecione uma compra para editar.","Alerta");}
		if(!is_numeric($qtd) || $qtd<1)		{$error[] = "";	$this->template_functions->setError("info","Preencha a quantidade comprada","Alerta");}
		if(!is_numeric($valor) || $valor<0)	{$error[] = "";	$this->template_functions->setError("info","Preencha o valor unitÃ¡rio","Alerta");}
		$data_separated							= explode("/", $data_compra);
		if((!$data_separated[0] || !$data_separated[1] || !$data_separated[2]) 
				||
			!checkdate ($data_separated[1], $data_separated[0], $data_separated[2])){
				$error[]	= "";	
				$this->template_functions->setError("info","Preencha uma data de compra vÃ¡lida","Alerta");
		}
		if(!$hora_compra)			{$error[]	= "";	$this->template_functions->setError("info","Preencha a hora da compra","Alerta");}
		
		if(count($error)){
			$this->edit_form();
			return;
		}
		/////Executa a alteraÃ§Ã£o
		$date_formated		= $data_separated[2]."-".$data_separated[1]."-".$data_separated[0]." ".$hora_compra.":00";
		$this->load->model('backend/compras/compras_model', 'edit');
		if($this->edit->cadastra_atualiza($id_code[0],null,$qtd,$valor,$date_formated,$desc)){
			$this->index();
		}else{
			$this->edit_form();
		}
		
	}
}