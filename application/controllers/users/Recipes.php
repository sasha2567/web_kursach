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
			'titlecoment' => $titlecoment
		);
		$data['username'] = $this->session->userdata('username');

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('menu',$data);
			$this->load->view('showrecipe',$data);
			$this->load->view('footer');
		}
	}

	public function addcoment($id,$id_item)
	{
		if(isset($_POST) && isset($_POST['add_coment_user']))
		{
			$description = $_POST['coment_user'];
			$ingredients = $_POST['recipe_ingredients'];
			$recipe = $_POST['recipe_recipe'];
			$data = array(
	            'description' => $description,
	            'ingredients' => $ingredients,
	            'recipe' => $recipe
	        );

	        $this->load->model('recipe');
	        $recipes = $this->recipe->add($data);
	        redirect('/users/recipes/show/'.$id_item);
		}
	}
}