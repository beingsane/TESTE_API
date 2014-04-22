<?
class User_mig extends CI_Controller_Auth_Permition {
	
	public function index()	{
		$data =array();
		/////Carrega os usuários cadastrados
		$this->load->model('backend/user/user_model', 'load_users');
		$data['users'] = $this->load_users->lista();
		
		$this->tollbar->setTextTollbar('glyphicons parents','Gerenciamento de usuários: Lista!');
		$this->tollbar->setTollbar("Desativar","lock","backend","user_mig","block");
		$this->tollbar->setTollbar("Ativar","unlock","backend","user_mig","un_block");
		$this->tollbar->setTollbar("Adicionar","circle_plus","backend","user_mig","add");
		
		$this->template->load('template/backEndTemplate','backend/user_backend_list',$data);
	}
	
	
	
	public function add()	{
		$data = array(
					"name"		=>	$this->input->post("name"),
					"name_user"	=>	$this->input->post("name_user"),
					"email"		=>	$this->input->post("email"),
					"cod_perfil"=>	$this->input->post("cod_perfil") ? $this->input->post("cod_perfil") : array()
				);
				
		$this->load->library('text_input');
		$this->load->library('text_area_input');
		
		/////Carrega os user cadastrados
		$this->load->model('backend/perfis/perfis_model', 'load_perfis');
		$data['perfis'] = $this->load_perfis->lista();
		
		$this->tollbar->setTextTollbar('glyphicons group','Gerenciamento de usuários : Adicionar!');
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend","user_mig","index");
		$this->tollbar->setTollbar("Salvar","circle_ok","backend","user_mig","add_commit");
		
		$this->template->load('template/backEndTemplate','backend/user_backend_form',$data);
	}
	
	
	
	public function add_commit()	{
		$data 			= array();
				
		$name			= $this->input->post("name");
		$name_user 		= $this->input->post("name_user");
		$email			= $this->input->post("email");
		$senha1			= $this->input->post("pass_1");
		$senha2			= $this->input->post("pass_2");
		$cod_user 	= $this->input->post("cod_user");
		
		/////Validação dos campos
		$error						= array();
		if(!$name)					{$error[] = "";	$this->template_functions->setError("info","Preencha o nome","Alerta");}
		if(!$name_user)				{$error[] = "";	$this->template_functions->setError("info","Preencha o nome de usuário","Alerta");}
		if(!$email)					{$error[] = "";	$this->template_functions->setError("info","Preencha um email.","Alerta");
		} else {
			$conta 			= "^[a-zA-Z0-9\._-]+@";
			$domino 		= "[a-zA-Z0-9\._-]+.";
			$extensao 		= "([a-zA-Z]{2,4})^";
			$pattern 		= $conta.$domino.$extensao;
			if (!preg_match($pattern,$email)){
				$error[] = "";
				$this->template_functions->setError("info","Preencha um email válido","Alerta");
			}	
		}
		if(!$senha1 && strlen($senha1)<4) 	{$error[] = "";	$this->template_functions->setError("info","Preencha a senha com no minimo 4 caracteres","Alerta");}
		if($senha1 != $senha2) 				{$error[] = "";	$this->template_functions->setError("info","As senhas digitadas são diferentes","Alerta");}
		if(!is_array($cod_user))			{$error[] = "";	$this->template_functions->setError("info","Selecione ao menos um  perfil","Alerta");}
		if(count($error)){
			$this->add();
			return;
		}
		/////Executa o cadastro
		$this->load->model('backend/user/user_model', 'add');
		if($this->add->cadastra_atualiza(null,$name_user,$name,$email,$senha1,$cod_user)){
			$this->index();
		}else{
			$this->add();
		}
	}

	
	
	public function edit()	{
		$data 		= array();
		/////Carrega os user cadastrados
		$this->load->model('backend/perfis/perfis_model', 'load_perfis');
		
		$this->load->model('backend/user/user_model', 'load_data_user');
		$cod_user 	= $this->input->post("cod_user");
		$userdados 	= $this->load_data_user->lista($cod_user[0]);
		
		$data = array(
					"cod_user"	=>	$cod_user[0],
					"name"		=>	$userdados[0]->nomeSysUsuarios,
					"name_user"	=>	$userdados[0]->userNameSysUsuarios,
					"email"		=>	$userdados[0]->emailSysUsuarios,
					"cod_perfil"=>	$this->load_data_user->lista_perfis($cod_user[0]),
					"perfis"	=>	$this->load_perfis->lista()
				);

		$this->load->library('text_input');
		
		$this->tollbar->setTextTollbar('glyphicons group','Gerenciamento de usuários: Editar!');
		$this->tollbar->setTollbar("Voltar","circle_arrow_left","backend","user_mig","index");
		$this->tollbar->setTollbar("Salvar","circle_ok","backend","user_mig","edit_commit");
		
		$this->template->load('template/backEndTemplate','backend/user_backend_form',$data);
	}
	
	
	public function edit_commit()	{
		$data 			= array();
		$cod_user		= $this->input->post("cod_user");		
		$name			= $this->input->post("name");
		$name_user 		= $this->input->post("name_user");
		$email			= $this->input->post("email");
		$senha1			= $this->input->post("pass_1");
		$senha2			= $this->input->post("pass_2");
		$cod_perfil 	= $this->input->post("cod_perfil");
		
		/////Validação dos campos
		$error							= array();
		if(!is_array($cod_user))		{$error[] = "";	$this->template_functions->setError("info","Selecione um usuário para editar.","Alerta");}
		if(!$name)						{$error[] = "";	$this->template_functions->setError("info","Preencha o nome","Alerta");}
		if(!$name_user)					{$error[] = "";	$this->template_functions->setError("info","Preencha o nome de usuário","Alerta");}
		if($senha1 && $senha1!=$senha2)	{$error[] = "";	$this->template_functions->setError("info","As senhas digitadas são diferentes","Alerta");		}
		if(!$email)						{$error[] = "";	$this->template_functions->setError("info","Preencha um email.","Alerta");
		} else {
			$conta 			= "^[a-zA-Z0-9\._-]+@";
			$domino 		= "[a-zA-Z0-9\._-]+.";
			$extensao 		= "([a-zA-Z]{2,4})^";
			$pattern 		= $conta.$domino.$extensao;
			if (!preg_match($pattern,$email)){
				$error[] = "";
				$this->template_functions->setError("info","Preencha um email válido","Alerta");
			}	
		}
		if(!is_array($cod_perfil))			{$error[] = "";	$this->template_functions->setError("info","Selecione ao menos um  perfil","Alerta");}
		if(count($error)){
			$this->edit();
			return;
		}
		/////Executa o cadastro
		$this->load->model('backend/user/user_model', 'edit');
		if($this->edit->cadastra_atualiza($cod_user[0],$name_user,$name,$email,$senha1,$cod_perfil)){
			$this->index();
		}else{
			$this->edit();
		}
		
	}
	
	public function block()	{
		/////Validação dos campos
		$cod_user 	= $this->input->post("cod_user");
		if(!is_array($cod_user))	{
			$this->template_functions->setError("info","Selecione ao menos um perfil para desativar.","Alerta");
		}else{
			////verifica se o código do usuário a ser bloqeuado e o seu
			if(in_array($this->session->userdata('user_id'), $cod_user)){
				$this->template_functions->setError("info","Voce não pode desativar seu próprio usuário.","Alerta");
				$this->index();
				return;
			}
			/////Executa a desativação
			$this->load->model('backend/user/user_model', 'user_cad');
			$this->user_cad->block_unblock($cod_user,"block");
		}
		$this->index();
	}
	
	public function un_block()	{
		/////Validação dos campos
		$cod_user 	= $this->input->post("cod_user");
		if(!is_array($cod_user))	{
			$this->template_functions->setError("info","Selecione ao menos um perfil para ativar.","Alerta");
		}else{
			/////Executa a desativação
			$this->load->model('backend/user/user_model', 'user_cad');
			$this->user_cad->block_unblock($cod_user,"un_block");
		}
		$this->index();
	}
}