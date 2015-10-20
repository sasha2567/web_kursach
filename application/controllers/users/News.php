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

class News extends CI_Controller {

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
		$this->load->model('recipe');
		$this->db->order_by('date', 'desc');
		$recipes = $this->recipe->getlist();
		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment
			);
		$data['username'] = $this->session->userdata('username');
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
}
