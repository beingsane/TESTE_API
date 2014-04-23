<?
class Marcas extends CI_Controller_Auth_Permition {
	public function index()	{
		$data	= array();
		/////carregas os carros cadastrados
		$this->load->model('backend/marcas/marcas_model', 'load_marcas');
		$data['marcas'] = $this->load_marcas->lista(null,false);
		
		/////Monta a tollbar
		$this->tollbar->setTextTollbar('glyphicons registration_mark','Marcas');
		$this->tollbar->setTollbar("Remover",	"bin",	"backend","marcas",	"remove_commit");
		$this->tollbar->setTollbar("Adicionar","circle_plus","backend", "marcas","add_form");
		
		/////Carrega a view
		$this->template->load('template/backEndTemplate','backend/marcas/index',$data);
	}
	
	
	public function add_form(){
		$this->load->library('text_input');
		$this->load->library('Pagination');
		
		
	
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
				
		
		$this->tollbar->setTextTollbar('glyphicons registration_mark','Gerenciamento de marcas : Adicionar!');
		$this->tollbar->setTollbar("Salvar",	"circle_ok",			"backend",	"marcas",	"add_commit");
		$this->tollbar->setTollbar("Voltar",	"circle_arrow_left",	"backend",	"marcas",	"index");
		
		$this->template->load('template/backEndTemplate','backend/marcas/form',$data);
	}
	
	
	public function add_commit()	{
		$data 			= array();
				
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
		
		$error						= array();
		if(!$data['nome']){
			$error[] = "";	$this->template_functions->setError("info","Digite o nome da marca!","Alerta");
		}
		if(count($error)){
			$this->add_form();
			return;
		}
		
		
		
		$this->load->model('backend/marcas/marcas_model', 'add');
		$this->add->cadastra_atualiza(null, $data['nome']);
		
		$this->index();
	}
	
	public function edit_form()	{
		/////Carrega o grupo
		$id_code 	= $this->input->post("code");
		$this->load->model('backend/marcas/marcas_model', 'load_marcas');
		$result		= $this->load_marcas->lista($id_code[0]);
		
		$data = array(
					"id_code"		=>	$id_code[0],
					"nome"			=>	$result[0]->name_marca,
				);
				
		
		$this->load->library('text_input');
		$this->load->library('Pagination');
		
		$this->tollbar->setTextTollbar('glyphicons registration_mark',	'Gerenciamento de marcas: Editar!');
		$this->tollbar->setTollbar("Salvar","circle_ok",		"backend",	"marcas",	"edit_commit");
		$this->tollbar->setTollbar("Remover","bin",				"backend",	"marcas",	"remove_comit");
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend",	"marcas",	"index");
		
		
		$this->template->load('template/backEndTemplate','backend/marcas/form',$data);
	}
	
	
	
	public function edit_commit()	{
		$data 			= array();
		$id_code		= $this->input->post("code");
		
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
		
		/////Validação dos campos
		$error						= array();
		if(!$data['nome']){
			$error[] = "";	$this->template_functions->setError("info","Digite o nome da marca!","Alerta");
		}
		if(count($error)){
			$this->edit_form();
			return;
		}
		
		
		$this->load->model('backend/marcas/marcas_model', 'edit');
		if($this->edit->cadastra_atualiza($id_code[0],$data['nome'])){
			$this->index();
		} else {
			$this->edit_form();
		}
	}
	public function remove_commit()	{
		$id_code = $this->input->post("code");
		if(!is_array($id_code)){
			$this->template_functions->setError("info","Selecione ao menos um carro para remover!","Alerta");
		}else{
			$this->load->model('backend/marcas/marcas_model', 'remove');
			$this->remove->delete($id_code);
		}
		$this->index();
		
	}
}