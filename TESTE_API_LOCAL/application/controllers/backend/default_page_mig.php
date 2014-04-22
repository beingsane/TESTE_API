<?
class Default_page_mig extends CI_Controller_Auth {
	public function index()	{
		$data	= array();
		$this->tollbar->setTextTollbar('glyphicons sort','Página Inicial!');
		$this->template->load('template/backEndTemplate','backend/default_page',$data);
	}
}