<?php
class My_404_backend extends CI_Controller {
    public function index() {
        $this->output->set_status_header('404');
        $data['content'] = 'A página solicitada não foi encontrada.';
		if(!$this->session->userdata('user_id') || !$this->session->userdata('username') || !$this->session->userdata('name_site')) {
			echo header("location:/backend/login_mig");
		}else{
			$this->tollbar->setTextTollbar('glyphicons remove','404 Página não encontada!');
			$this->template->load('template/backEndTemplate','backend/error_404',$data);
		}
    }
}
?>