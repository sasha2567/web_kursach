<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminadd extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('admin/addrecipe');
	}

	public function add()
	{
		if(isset($_POST) && isset($_POST['recipe_add_btn']))
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
	        $recipes = $this->recipe->add($data);
	        redirect('adminindex');
		}
	}
}
