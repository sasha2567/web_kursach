<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index()
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Страница ошибки'; else $title = 'Error page';
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 8,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->view('menu',$data);
        $this->load->view('error');
        $this->load->view('footer');
	}
}
