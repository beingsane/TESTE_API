<?
class Perfil_mig extends CI_Controller_Auth {
	
	public function index()	{
		$data =array();
		
		
		/////Carrega osdados do usuário
		$this->load->model('backend/user/user_model', 'load_users');
		$users 				= $this->load_users->lista($this->session->userdata('user_id'));
		$data["perfis"] 	= $this->load_users->lista_perfis($this->session->userdata('user_id'),true);
		$data["name"]	 	= $users[0]->nomeSysUsuarios;
		$data["name_user"]	= $users[0]->userNameSysUsuarios;
		$data["email"]	 	= $users[0]->emailSysUsuarios;
		$this->load->library('text_input');
		$this->load->library('text_area_input');
				
		$this->tollbar->setTextTollbar('glyphicons user','Dados pessoais!');
		$this->tollbar->setTollbar("Editar","pencil","backend","perfil_mig","edit");
		$this->template->load('template/backEndTemplate','backend/perfil_form_mig',$data);
	}
	
	public function edit()	{
		$dataUpdate = array("userNameSysUsuarios"	=> $this->input->post('name_user'),
							"nomeSysUsuarios"		=> $this->input->post('name'),
							"emailSysUsuarios"		=> $this->input->post('email'),
							'pass_1'				=> $this->input->post('pass_1'),
							'pass_2'				=> $this->input->post('pass_2')
							);
		
		/////Verifica se o email já existe:
		$this->load->model('backend/user/user_model', 'load_data_user');
		$userdados 	= $this->load_data_user->load_user_valid($dataUpdate['emailSysUsuarios'],null,$this->session->userdata('user_id'));
		if(count($userdados)){
			$this->template_functions->setError("info","O email [".$dataUpdate['emailSysUsuarios']."] já existe cadastrado para outro usuário.","Alerta");
		}
		/////Verifica se o nome_usuário já existe:
		$userdados 	= $this->load_data_user->load_user_valid(null,$dataUpdate['userNameSysUsuarios'],$this->session->userdata('user_id'));
		if(count($userdados)){
			$this->template_functions->setError("info","O nome de usuário [".$dataUpdate['userNameSysUsuarios']."] já existe cadastrado para outro usuário.","Alerta");
		}
		
		$error						= array();
		if(!$dataUpdate['nomeSysUsuarios'])			{$error[] = "";	$this->template_functions->setError("info","Preencha o nome","Alerta");}
		if(!$dataUpdate['userNameSysUsuarios'])		{$error[] = "";	$this->template_functions->setError("info","Preencha o nome de usuário","Alerta");}
		if(!$dataUpdate['emailSysUsuarios'])		{$error[] = "";	$this->template_functions->setError("info","Preencha um email.","Alerta");
		} else {
			$conta 			= "^[a-zA-Z0-9\._-]+@";
			$domino 		= "[a-zA-Z0-9\._-]+.";
			$extensao 		= "([a-zA-Z]{2,4})^";
			$pattern 		= $conta.$domino.$extensao;
			if (!preg_match($pattern,$dataUpdate['emailSysUsuarios'])){
				$error[] = "";
				$this->template_functions->setError("info","Preencha um email válido","Alerta");
			}	
		}
		if($dataUpdate['pass_1'] && (strlen($dataUpdate['pass_1'])<4 || ($dataUpdate['pass_1'] != $dataUpdate['pass_2']))) {$error[] = "";	$this->template_functions->setError("info","As senhas digitadas são diferentes","Alerta");}
		if(count($error)){
			$this->index();
			return;
		}
		/////atualiza os dados do usuário
		$this->load_data_user->cadastra_atualiza(	$this->session->userdata('user_id'),
													$dataUpdate['userNameSysUsuarios'],
													$dataUpdate['nomeSysUsuarios'],
													$dataUpdate['emailSysUsuarios'],
													$dataUpdate['pass_2'],
													null);
		
		
		$this->index();
	}
}