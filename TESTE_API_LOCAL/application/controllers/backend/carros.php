<?
class Carros extends CI_Controller_Auth_Permition {
	public function index()	{
		$data	= array();
		/////carregas os carros cadastrados
		$this->load->model('backend/carros/carros_model', 'load_carros');
		$data['cars'] = $this->load_carros->lista(null,1,true);
		
		/////Monta a tollbar
		$this->tollbar->setTextTollbar('glyphicons car','Carros');
		$this->tollbar->setTollbar("Remover",	"bin",	"backend","carros",	"remove_commit");
		$this->tollbar->setTollbar("Adicionar","circle_plus","backend", "carros","add_form");
		
		/////Carrega a view
		$this->template->load('template/backEndTemplate','backend/carros/index',$data);
	}
	
	
	public function add_form(){
		$this->load->library('text_input');
		$this->load->library('select_input');
		$this->load->library('jcrop_add');
		$this->load->library('Pagination');
		
		
	
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
		$data['marca'] 			= $this->input->post("marca");
		$data['ano'] 			= $this->input->post("ano");
		$data['valor'] 			= $this->input->post("valor");
		$data['parcela'] 		= $this->input->post("parcela");
		$data['image'] 			= "";
				
		/////Carrega as marcas  cadastradas
		$this->load->model('backend/marcas/marcas_model', 'load_marcas');
		$marcas		= $this->load_marcas->lista(null,true);
		$data['marcas'] = $marcas;
		
		$this->tollbar->setTextTollbar('glyphicons car','Gerenciamento de carros : Adicionar!');
		$this->tollbar->setTollbar("Salvar",	"circle_ok",			"backend",	"carros",	"add_commit");
		$this->tollbar->setTollbar("Voltar",	"circle_arrow_left",	"backend",	"carros",	"index");
		
		$this->template->load('template/backEndTemplate','backend/carros/form',$data);
	}
	
	
	public function add_commit()	{
		$data 			= array();
				
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
		$data['marca'] 			= $this->input->post("marca");
		$data['ano'] 			= $this->input->post("ano");
		$data['valor'] 			= $this->input->post("valor");
		$data['parcela'] 		= $this->input->post("parcela");
		$data['image'] 			= "";
		
		/////Caordenadas da imagem
		$coordsX		= $this->input->post("coordsX-imgCrop-1");
		$coordsY		= $this->input->post("coordsY-imgCrop-1");
		$coordsX2		= $this->input->post("coordsX2-imgCrop-1");
		$coordsY2		= $this->input->post("coordsY2-imgCrop-1");
		$coordsW		= $this->input->post("coordsW-imgCrop-1");
		$coordsH		= $this->input->post("coordsH-imgCrop-1");
		$name_img_temp	= $this->input->post("nameImageCrop-imgCrop-1");
		
		/////Validação dos campos
		$error_image				= true;
		$error						= array();
		if(!$data['nome']){
			$error[] = "";	$this->template_functions->setError("info","Digite o modelo do veículo!","Alerta");
		}
		if(!$coordsW || !$coordsH || !$name_img_temp)	{
			$error_image 	= false;
			$error[] 		= "";	$this->template_functions->setError("info","Selecine uma imagem em seu computador","Alerta");
		}
		if(!is_numeric($data['marca'])){
			$error[] = "";	$this->template_functions->setError("info","Selecione amarca do veículo!","Alerta");
		}
		if(!is_numeric($data['ano'])){
			$error[] = "";	$this->template_functions->setError("info","Digite o ano de fabricação do veículo!","Alerta");
		}
		if(!is_numeric($data['valor'])){
			$error[] = "";	$this->template_functions->setError("info","Digite o valor do veículo!","Alerta");
		}
		if(!is_numeric($data['parcela']) || $data['parcela']<3 || $data['parcela']>12){
			$error[] = "";	$this->template_functions->setError("info","Selecione o máximo de parcelas!","Alerta");
		}
		
		if(count($error)){
			if($error_image){
				$error[] = "";	$this->template_functions->setError("info","A imagem temporária foi removida, selecione uma nova imagem.!","Alerta");
			}
			$this->add_form();
			return;
		}
		
		
		/////Executa o cadastro/////Tenta fazer o crop da imagem
		$this->load->library('crop_image');
		$nameImageSeparate	= explode("/",$name_img_temp);
		$newNameImage		= end($nameImageSeparate);
		$image				= $this->crop_image->crop($coordsX,$coordsY,$coordsX2,$coordsY2,$coordsW,$coordsH,_BASEPATH_."/public/img/temp_upload/".$newNameImage,_BASEPATH_."/public/img/carros/",300,200);
		
		$this->load->model('backend/carros/carros_model', 'add');
		$this->add->cadastra_atualiza(null,
										$data['nome'],
										$data['marca'],
										$data['ano'],
										$data['valor'],
										$data['parcela'],
										$image);
		
		$this->index();
	}
	
	public function edit_form()	{
		$this->edit_form_full();
	}
	
	public function edit_form_full()	{
		/////Carrega o grupo
		$id_code 	= $this->input->post("code");
		$this->load->model('backend/carros/carros_model', 'load_carros');
		$result		= $this->load_carros->lista($id_code[0]);
		$alter_value= $this->check_file_permitions->check_permitions("carros","edit_form_full");
		$data = array(
					"id_code"		=>	$id_code[0],
					"nome"			=>	$result[0]->name_car,
					"marca"			=>	$result[0]->id_marca_rel,
					"image"			=>	_HTTP_IMGPATH_."/carros/".$result[0]->img,
					"ano"			=>	$result[0]->year,
					"valor"			=>	$result[0]->value_car,
					"parcela"		=>	$result[0]->parc_number,
					"alter_value"	=>	$alter_value
				);
				
		/////Carrega as marcas  cadastradas
		$this->load->model('backend/marcas/marcas_model', 'load_marcas');
		$marcas		= $this->load_marcas->lista(null,true);
		$data['marcas'] = $marcas;
		
		$this->load->library('text_input');
		$this->load->library('select_input');
		$this->load->library('jcrop_add');
		$this->load->library('text_hidden');
		
		$this->tollbar->setTextTollbar('glyphicons car',	'Gerenciamento de carros: Editar!');
		$this->tollbar->setTollbar("Salvar","circle_ok",		"backend",	"carros",	"edit_commit");
		$this->tollbar->setTollbar("Remover","bin",				"backend",	"carros",	"remove_comit");
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend",	"carros",	"index");
		
		
		$this->template->load('template/backEndTemplate','backend/carros/form',$data);
	}
	
	
	
	public function edit_commit()	{
		$data 			= array();
		$id_code		= $this->input->post("code");
		
		$data 					= array();
		$data['nome'] 			= $this->input->post("nome");
		$data['marca'] 			= $this->input->post("marca");
		$data['ano'] 			= $this->input->post("ano");
		$data['valor'] 			= $this->input->post("valor");
		$data['parcela'] 		= $this->input->post("parcela");
		$data['image'] 			= "";
		
		/////Caordenadas da imagem
		$coordsX		= $this->input->post("coordsX-imgCrop-1");
		$coordsY		= $this->input->post("coordsY-imgCrop-1");
		$coordsX2		= $this->input->post("coordsX2-imgCrop-1");
		$coordsY2		= $this->input->post("coordsY2-imgCrop-1");
		$coordsW		= $this->input->post("coordsW-imgCrop-1");
		$coordsH		= $this->input->post("coordsH-imgCrop-1");
		$name_img_temp	= $this->input->post("nameImageCrop-imgCrop-1");
		
		/////Validação dos campos
		$error_image				= true;
		$error						= array();
		$alter_value				= $this->check_file_permitions->check_permitions("carros","edit_form_full");
		
		if(!$data['nome']){
			$error[] = "";	$this->template_functions->setError("info","Digite o modelo do veículo!","Alerta");
		}
		if(!is_numeric($data['marca'])){
			$error[] = "";	$this->template_functions->setError("info","Selecione amarca do veículo!","Alerta");
		}
		if(!is_numeric($data['ano'])){
			$error[] = "";	$this->template_functions->setError("info","Digite o ano de fabricação do veículo!","Alerta");
		}
		if($alter_value){
			if(!is_numeric($data['valor'])){
				$error[] = "";	$this->template_functions->setError("info","Digite o valor do veículo!","Alerta");
			}
			
		}else{
			$data['valor'] = null;
		}
		
		if(!is_numeric($data['parcela']) || $data['parcela']<3 || $data['parcela']>12){
			$error[] = "";	$this->template_functions->setError("info","Selecione o máximo de parcelas!","Alerta");
		}
		
		if(count($error)){
			if($error_image){
				$error[] = "";	$this->template_functions->setError("info","A imagem temporária foi removida, selecione uma nova imagem.!","Alerta");
			}
			$this->edit_form();
			return;
		}
		
		if($coordsW && $coordsH && $name_img_temp)	{
			/////Executa o cadastro/////Tenta fazer o crop da imagem
			$this->load->library('crop_image');
			$nameImageSeparate	= explode("/",$name_img_temp);
			$newNameImage		= end($nameImageSeparate);
			$image				= $this->crop_image->crop($coordsX,$coordsY,$coordsX2,$coordsY2,$coordsW,$coordsH,_BASEPATH_."/public/img/temp_upload/".$newNameImage,_BASEPATH_."/public/img/carros/",300,200);
		}else{
			$image = null;
		}
		
		
		$this->load->model('backend/carros/carros_model', 'edit');
		if($this->edit->cadastra_atualiza($id_code[0],
										$data['nome'],
										$data['marca'],
										$data['ano'],
										$data['valor'],
										$data['parcela'],
										$image,
										$alter_value)){
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
			$this->load->model('backend/carros/carros_model', 'remove');
			$this->remove->delete($id_code);
		}
		$this->index();
		
	}
}