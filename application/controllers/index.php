<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function index()
	{
		echo "Hello World";
		// $this->load->model('recipe');
  		//$recipes = $this->recipe->getlist();
		// $data = array(
		// 	'recipes' => $recipes 
		// 	);
		// $this->load->helper('url');
		// $this->load->view('admin\index',$data);
	}
}
