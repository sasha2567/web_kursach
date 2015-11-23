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

class Search extends CI_Controller {

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

	public function index($data = "")
	{
		$titlecoment = $this->getTitleComent();
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 0,
			'username' => $this->session->userdata('username'),
			'title' => 'Главная страница'
			);
		$this->load->helper('url');
		$this->load->view('users/menu',$data);
		$this->load->view('home');
		$this->load->view('users/footer');
	}
}
