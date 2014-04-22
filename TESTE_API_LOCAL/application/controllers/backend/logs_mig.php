<?
class Logs_mig extends CI_Controller_Auth_Permition {
	
	public function index()	{
		$data =array();
		$this->load->library('select_input');
		
		/////Carrega os usuários cadastrados
		$this->load->model('backend/user/user_model', 'load_users');
		$users = $this->load_users->lista();
		/////Monta os usuários para o select
		foreach ($users as $key => $value) {
			$data['users'][] = array("value"=>$value->idSysUsuarios,"label"=>$value->nomeSysUsuarios);
		}
		
		$this->load->model('backend/logs/logs_model', 'logs');
		$data['logs'] = $this->logs->lista($this->input->post("type"),$this->input->post("user"),$this->input->post("model"));
		
		$this->tollbar->setTextTollbar('glyphicons log_book','Logs do Sistema!');
		$this->tollbar->setTollbar("Refresh","refresh","backend","logs_mig","index");
		$this->template->load('template/backEndTemplate','backend/logs_backend',$data);
	}
}