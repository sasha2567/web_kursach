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

class Redact extends CI_Controller {

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
			'username' => $this->session->userdata('username'),
			'title' => 'Описание рецепта'
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/showrecipe',$data);
			$this->load->view('admin/footer');
		}
	}

	public function addcoment($id)
	{
		if(isset($_POST) && isset($_POST['add_coment_user']))
		{
			$coment = $_POST['coment_user'];
			//$coment = iconv("UTF-8", "ISO-8859-1//IGNORE", $coment);
			$coment = htmlspecialchars($coment, NULL, 'ISO-8859-1');
			//die($coment.'*');
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
	        redirect('users/recipes/show/'.$id);
		}
	}

	public function redact($id)
	{
		if(isset($_POST) && isset($_POST['recipe_redact_btn']))
		{
			$description = $_POST['recipe_description'];
			$ingredients = $_POST['recipe_ingredients'];
			$recipe = $_POST['recipe_recipe'];
			$data = array(
	            'description' => $description,
	            'ingredients' => $ingredients,
	            'recipe' => $recipe
	        );

	        $this->load->model('recipe');
	        $recipes = $this->recipe->edit($id,$data);
	        redirect('adminindex');
		}
	}
}