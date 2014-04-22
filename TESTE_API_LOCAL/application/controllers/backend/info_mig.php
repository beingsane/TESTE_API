<?
class Info_mig extends CI_Controller_Auth {
	
	public function index()	{
		$data =array();
		/////Carrega os usuários cadastrados
		$this->load->model('backend/user/user_model', 'load_users');
		$data['loged'] = $this->load_users->lista(null,true);
		
		$this->tollbar->setTextTollbar('glyphicons circle_info','Informações sobre o sistema!');
		$this->template->load('template/backEndTemplate','backend/info_backend',$data);
	}
	
}