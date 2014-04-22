<?
class Deslog_mig extends CI_Controller {
	public function index()	{
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect(_HTTP_BASEPATH_.'/backend/login_mig/','refresh'); 
	}
}