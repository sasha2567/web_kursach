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
		$titlecoment = $this->getTitleComent();
		$this->load->model('masters');
		$master = $this->masters->get();
		if(count($master) > 0)
			$master = $master[0];
		else{
			$master = null;
		}
		$data = array(
			'master' => $master,
			'titlecoment' => $titlecoment,
			'pageIndex' => 6,
			'username' => $this->session->userdata('username'),
			'title' => 'Мастер-класс'
			);
		$this->load->helper('url');
		$this->load->view('users/menu',$data);
		$this->load->view('users/master',$data);
		$this->load->view('users/footer');
	}

	public function write()
	{
		if (isset($_POST['user_master_btn'])) {
			$this->load->model('masters');
			$this->masters->adduser($this->session->userdata('user_id'));
			redirect('users/master/index');
		}
	}
}
