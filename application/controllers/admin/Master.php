<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coments {
	public $coment = null;
	public $user = null;

	function __construct($c,$u){
        $this->coment = $c;
        $this->user = $u;
    }
}

class Master extends CI_Controller {

	public function getTitleComent()
	{
		$this->load->model('coment');
		$this->db->order_by('datetime', 'desc');
		$this->db->limit (5, 0);
		$coment = $this->coment->getlist();
		
		$this->load->model('user');
		$users = array();
		$coments = array();
		foreach ($coment as $value) {
			$temp = $this->user->get($value['user_id']);
			foreach ($temp as $var) {
				$temp = $var;
				break;
				}
			$coments[] = new Coments($value,$temp);
		}
		return $coments;
	}

	public function index()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$titlecoment = $this->getTitleComent();
		$this->load->model('masters');
		$master = $this->masters->get();
		if(count($master) > 0)
			$master = $master[0];
		else{
			$master = null;
		}
		$table = $this->masters->getlist();
		$user = array();
		foreach ($table as $value) {
			$temp = $this->masters->getUser($value['user_id']);
			$user[] = $temp[0];
			
		}
		$data = array(
			'master' => $master,
			'users' => $user,
			'titlecoment' => $titlecoment,
			'username' => $this->session->userdata('username'),
			'title' => 'Мастер-класс'
			);
		$this->load->helper('url');
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/master',$data);
		$this->load->view('admin/footer');
	}

	public function delete($id)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('masters');
		$this->masters->deleteuser($id);
		redirect('admin/master/index');
	}
}
