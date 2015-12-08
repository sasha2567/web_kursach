<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Master extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Мастер-класс'; else $title = 'Master-class';
		
		$this->load->model('master');
		$masters = $this->master->getlist();
		
		$data = array(
			'titlecoment' => $titlecoment,
			'masters' => $masters,
			'pageIndex' => 4,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->helper('url');
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/master',$data);
		$this->load->view('admin/footer');
	}

	public function show($id = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Мастер-класс'; else $title = 'Master-class';
		
		$this->load->model('master');
		$temp = $this->master->getmaster($id);
		$master = array(
				'master' => $temp[0],
				'users' => $this->master->getUser($id)
			);
		$this->load->helper('html');
		$this->load->helper('url');
		$data = array(
			'master' => $master,
			'titlecoment' => $titlecoment,
			'pageIndex' => 6,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/mastershow',$data);
			$this->load->view('admin/footer');
		}
	}

	public function delete($id,$page)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('master');
		$this->master->deleteuser($id,$page);
		redirect('admin/admin_master/show/'.$page);
	}

	public function deletemaster($id)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('master');
		$this->master->deleteMaster($id);
		redirect('admin/admin_master/index');
	}

	public function add()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subject', 'Тема', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		$this->form_validation->set_rules('description', 'Описание', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		$this->form_validation->set_rules('dateprovide', 'Дата проведения', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		if ($this->form_validation->run() == TRUE){
			$subject = htmlspecialchars($this->input->post('subject'), NULL, 'ISO-8859-1');
			$description = htmlspecialchars($this->input->post('description'), NULL, 'ISO-8859-1');
			$dateprovide = htmlspecialchars($this->input->post('dateprovide'), NULL, 'ISO-8859-1');
			$data = array(
				'subject' => $subject,
				'description' => $description,
				'provide' => 0,
				'dateprovide' => $dateprovide
			);
			$this->load->model('master');
			$this->master->add($data);
		}
		redirect('admin/admin_master/index');
	}
}
