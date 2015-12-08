<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Master extends CI_Controller {

	public function show()
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Мастер-класс'; else $title = 'Master-class';

		$this->load->model('master');
		$masters = $this->master->getlist();
		
		$this->load->helper('html');
		$this->load->helper('url');
		$data = array(
			'masters' => $masters,
			'titlecoment' => $titlecoment,
			'pageIndex' => 6,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('menu',$data);
			$this->load->view('user/master',$data);
			$this->load->view('footer');
		}
	}

	public function write($id)
	{
		if (isset($_POST['user_master_btn'])) {
			$this->load->model('master');
			$col = $this->master->validateUser($this->session->userdata('user_id'));
			if(count($col) == 0)
				$this->master->adduser($id,$this->session->userdata('user_id'));
			redirect('user/user_master/show');
		}
		redirect('user/user_master/show');
	}
}