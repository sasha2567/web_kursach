<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addcoments extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('coments');
	}

	public function add()
	{
		if(isset($_POST))
		{
			// $description = $_POST['recipe_description'];
			// $ingredients = $_POST['recipe_ingridients'];
			// $recipe = $_POST['recipe_recipe'];
			// $data = array(
	  //           'description' => $description,
	  //           'ingredients' => $ingredients,
	  //           'recipe' => $recipe
	  //       );

	        $this->load->model('recipe');
	        $recipes = $this->recipe->add($data);
	        redirect('coments');
		}
	}
}