<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminredact extends CI_Controller {

	public function show($id)
	{
		$this->load->model('recipe');
        $data = $this->recipe->get($id);
        foreach ($data as $item) {
        	$data = $item;
        	break;
        }
		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('admin/showrecipeforredact',$data);
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