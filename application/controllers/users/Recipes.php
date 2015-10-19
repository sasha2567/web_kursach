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

	public function show($id)
	{
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
			'coments' => $coments
		);

		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('showrecipe',$data);
		}
	}

	public function addcoment($id)
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
	        $recipes = $this->recipe->add($id,$data);
	        redirect('adminindex');
		}
	}
}