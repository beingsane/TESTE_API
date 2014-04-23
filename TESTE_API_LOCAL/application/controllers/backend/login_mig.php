<?
class Login_mig extends CI_Controller_Auth_Login {
	public function index()
	{
		$this->load->view('backend/login');
	}
	public function exec_login()	{
		$user 		= $this->input->post('user');
		$senha 		= $this->input->post('upw');
		$url		= $this->input->post('url');
		$permicoes	= array();
		$metodPadrao="";
		$errorDesc	=array();
		$errorCode	= 0;
		if(empty($user)){
			$errorDesc["email"] = "Preencha com o usuário ou email.";
			$errorCode= 1;
		}
		if(empty($senha)){
			$errorDesc["upw"] = "Preencha a senha.";
			$errorCode= 1;
		}
		
		if($errorCode){
			$this->load->view('backend/login',$errorDesc);
			return;
		}
		////Chama o model para validar os dados passados
		$this->load->model('backend/login/exec_login', 'logarSistema');
        if(!$this->logarSistema->efutua_login($user,$senha)){
        	$errorDesc["error"] = "Usuário e ou senha invalidos";
			$errorCode= 1;
        	$this->load->view('backend/login',$errorDesc);
        	return;
        }
       $this->load->helper('url');
       if($url){
       		redirect($url, 'refresh');
       }else{
			redirect(_HTTP_BASEPATH_.'/backend/default_page_mig', 'refresh');
       }
	}
}