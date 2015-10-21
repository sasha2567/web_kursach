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

class Recipes extends CI_Controller {

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

	public function show($id)
	{
		$titlecoment = $this->getTitleComent();
		$this->load->model('recipe');
        $item = $this->recipe->get($id);
        foreach ($item as $var) {
        	$item = $var;
        	break;
        }

		$this->load->model('coment');
		$coment = $this->coment->getrecipe($id);
		
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

		$data = array(
			'item' => $item,
			'coments' => $coments,
			'titlecoment' => $titlecoment,
			'username' => $this->session->userdata('username'),
			'title' => 'Описание рецепта'
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('menu',$data);
			//$this->load->helper('form');
			$this->load->helper('html');
			$this->load->view('showrecipe',$data);
			$this->load->view('footer');
		}
	}

	public function addcoment($id)
	{
		die('qqq');
		if(isset($_POST) && isset($_POST['add_coment_user']))
		{
			die('www');
			$coment = $_POST['coment_user'];
			$user_id = $this->session->userdata('user_id');
			if($user_id = false)
				$user_id = 0;
			$data = array(
	            'coment' => $coment,
	            'user_id' => $user_id,
	            'recipe_id' => $id
	        );

	        $this->load->model('coment');
	        $this->coment->add($data);
	        redirect('users/recipes/show/'.$id);
		}
	}
}