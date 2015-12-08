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

class User_Recipe extends CI_Controller {

	public function show($id = 1)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Описание рецепта'; else $title = 'Description recipe';

		$this->load->model('recipe');
        $item = $this->recipe->get($id);
		$item = $item[0];
        $products = $this->recipe->getproduct($id);

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
		$this->load->helper('html');
		$this->load->helper('url');
		$data = array(
			'item' => $item,
			'products' => $products,
			'coments' => $coments,
			'titlecoment' => $titlecoment,
			'pageIndex' => 7,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'comented' => $this->session->userdata('usercoment'),
			'title' => $title
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('menu',$data);
			$this->load->view('user/showrecipe',$data);
			$this->load->view('footer');
		}
	}

	public function addcoment($id)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('coment_user', 'Коментарий', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		if ($this->form_validation->run() == TRUE)
		{
			$coment = $this->input->post('coment_user');
			$coment = htmlspecialchars($coment, NULL, 'ISO-8859-1');
			if(false === $this->session->userdata('user_id'))
				$user_id = 0;
			else
				$user_id = $this->session->userdata('user_id');

			$data = array(
	            'coment' => $coment,
	            'user_id' => $user_id,
	            'recipe_id' => $id,
	            'datetime' => date("Y-m-d H:i:s")
	        );

	        $this->load->model('coment');
	        $this->coment->add($data);
	        redirect('user/user_recipe/show/'.$id);
		}
		redirect('user/user_recipe/show/'.$id);
	}
}