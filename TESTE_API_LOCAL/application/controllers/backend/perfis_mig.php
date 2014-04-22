<?
class Perfis_mig extends CI_Controller_Auth_Permition {
	
	public function index()	{
		$data =array();
		/////Carrega os perfis cadastrados
		$this->load->model('backend/perfis/perfis_model', 'load_perfis');
		$data['perfis'] = $this->load_perfis->lista();
		
		$this->tollbar->setTextTollbar('glyphicons group','Gerenciamento de perfis: Lista!');
		$this->tollbar->setTollbar("Desativar","lock","backend","perfis_mig","block");
		$this->tollbar->setTollbar("Ativar","unlock","backend","perfis_mig","un_block");
		$this->tollbar->setTollbar("Adicionar","circle_plus","backend","perfis_mig","add");
		
		$this->template->load('template/backEndTemplate','backend/perfis_backend_list',$data);
	}
	
	
	
	public function add()	{
		$data = array(
					"nameSysPerfil"			=>	$this->input->post("nameSysPerfil"),
					"descSysPerfil"			=>	$this->input->post("descSysPerfil"),
					"attributesSysPerfil"	=>	$this->input->post("attributesSysPerfil"),
					"ativoSysPerfil"		=>	$this->input->post("ativoSysPerfil"),
					"idSysMetodos"			=>	$this->input->post("methodos")
				);
				
		$this->load->library('text_input');
		$this->load->library('text_area_input');
		
		/////Carrega os metodos cadastrados
		$this->load->model('backend/metodos/metodos_model', 'load_metodos');
		$data['metodos'] = $this->load_metodos->lista();
		
		$this->tollbar->setTextTollbar('glyphicons group','Gerenciamento de perfis : Adicionar!');
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend","perfis_mig","index");
		$this->tollbar->setTollbar("Salvar","circle_ok","backend","perfis_mig","add_commit");
		
		$this->template->load('template/backEndTemplate','backend/perfis_backend_form',$data);
	}
	
	
	
	public function add_commit()	{
		$data 				= array();
		$nameSysPerfil		= $this->input->post("nameSysPerfil");
		$descSysPerfil 		= $this->input->post("descSysPerfil");
		$attributesSysPerfil= $this->input->post("attributesSysPerfil");
		$cod_metodo 		= $this->input->post("cod_metodo");
		
		/////Validação dos campos
		$error				= array();
		if(!$nameSysPerfil)			{$error[] = "Preencha o nome do perfil";			$this->template_functions->setError("info","Preencha o nome do perfil","Alerta");}
		if(!$descSysPerfil)			{$error[] = "Preencha a descrição do perfil";		$this->template_functions->setError("info","Preencha a descrição do perfil","Alerta");}
		if(!is_array($cod_metodo))	{$error[] = "Selecione ao menos uma permissão";		$this->template_functions->setError("info","Selecione ao menos uma permissão","Alerta");}
		if(count($error)){
			$this->add();
			return;
		}
		/////Executa o cadastro
		$this->load->model('backend/perfis/perfis_model', 'perfil_cad');
		if($this->perfil_cad->cadastra_atualiza(null,$nameSysPerfil,$descSysPerfil,$attributesSysPerfil,$cod_metodo)){
			$this->index();
		}else{
			$this->add();
		}
	}

	
	
	public function edit()	{
		$data = array();
		/////Carrega os metodos cadastrados
		$this->load->model('backend/metodos/metodos_model', 'load_metodos');
		
		$this->load->model('backend/perfis/perfis_model', 'load_perfil');
		$cod_perfil 	= $this->input->post("cod_perfil");
		$perfildados 	= $this->load_perfil->lista($cod_perfil[0]);
		$data = array(
					"metodos"				=>  $this->load_metodos->lista(),
					"cod_perfil"			=>	$cod_perfil[0],
					"nameSysPerfil"			=>	$perfildados[0]->nameSysPerfil,
					"descSysPerfil"			=>	$perfildados[0]->descSysPerfil,
					"attributesSysPerfil"	=>	$perfildados[0]->attributesSysPerfil,
					"ativoSysPerfil"		=>	$perfildados[0]->ativoSysPerfil,
					"idSysMetodos"			=>	$this->load_perfil->lista_permicoes($cod_perfil[0])
				);

		$this->load->library('text_input');
		$this->load->library('text_area_input');
		
		$this->tollbar->setTextTollbar('glyphicons group','Gerenciamento de perfis: Editar!');
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend","perfis_mig","index");
		$this->tollbar->setTollbar("Salvar","circle_ok","backend","perfis_mig","edit_commit");
		
		$this->template->load('template/backEndTemplate','backend/perfis_backend_form',$data);
	}
	
	
	public function edit_commit()	{
		$data 				= array();
		$cod_perfil			= $this->input->post("cod_perfil");
		$nameSysPerfil		= $this->input->post("nameSysPerfil");
		$descSysPerfil 		= $this->input->post("descSysPerfil");
		$attributesSysPerfil= $this->input->post("attributesSysPerfil");
		$cod_metodo 		= $this->input->post("cod_metodo");
		
		/////Validação dos campos
		$error				= array();
		if(!is_array($cod_perfil))	{$error[] = "O código do perfil não é numérico,";	$this->template_functions->setError("info","O código do perfil não é numérico","Alerta");}
		if(!$nameSysPerfil)			{$error[] = "Preencha o nome do perfil";			$this->template_functions->setError("info","Preencha o nome do perfil","Alerta");}
		if(!$descSysPerfil)			{$error[] = "Preencha a descrição do perfil";		$this->template_functions->setError("info","Preencha a descrição do perfil","Alerta");}
		if(!is_array($cod_metodo))	{$error[] = "Selecione ao menos uma permissão";		$this->template_functions->setError("info","Selecione ao menos uma permissão","Alerta");}
		if(count($error)){
			$this->edit();
			return;
		}
		
		/////Executa a atualização
		$this->load->model('backend/perfis/perfis_model', 'perfil_cad');
		if($this->perfil_cad->cadastra_atualiza($cod_perfil[0],$nameSysPerfil,$descSysPerfil,$attributesSysPerfil,$cod_metodo)){
			$this->index();
		}else{
			$this->edit();
		}
		
	}
	
	public function block()	{
		/////Validação dos campos
		$cod_perfil 	= $this->input->post("cod_perfil");
		if(!is_array($cod_perfil))	{
			$this->template_functions->setError("info","Selecione ao menos um perfil para desativar.","Alerta");
		}else{
			/////Executa a desativação
			$this->load->model('backend/perfis/perfis_model', 'perfil_cad');
			$this->perfil_cad->block_unblock($cod_perfil,"block");
		}
		$this->index();
	}
	
	public function un_block()	{
		/////Validação dos campos
		$cod_perfil 	= $this->input->post("cod_perfil");
		if(!is_array($cod_perfil))	{
			$this->template_functions->setError("info","Selecione ao menos um perfil para ativar.","Alerta");
		}else{
			/////Executa a desativação
			$this->load->model('backend/perfis/perfis_model', 'perfil_cad');
			$this->perfil_cad->block_unblock($cod_perfil,"un_block");
		}
		$this->index();
	}
}