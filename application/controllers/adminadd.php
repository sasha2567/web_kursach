<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminadd extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('admin/add');
	}

	public function add()
	{
		if(isset($_POST))
		{
			$description = $_POST['recipe_description'];
			$ingridients = $_POST['recipe_ingridients'];
			$recipe = $_POST['recipe_recipe'];
			$data = array(
	            'description' => $description,
	            'ingridients' => $ingridients,
	            'recipe' => $recipe
	        );

	        $this->load->model('recipe');
	        $recipes = $this->recipe->add($data);
	        redirect('adminindex');
		}
	}
}
