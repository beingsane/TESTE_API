<?
class Error_mig extends CI_Controller_Auth {
	public function permition()	{
		$data		= array();
		$this->tollbar->setTextTollbar('glyphicons warning_sign','Erro de permissão!');
		$this->template->load('template/backEndTemplate','backend/not_permition',$data);
	}
}