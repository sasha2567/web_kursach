<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feast extends CI_Controller {

	public function index()
	{
		$this->load->model('recipe');
		$recipes = $this->recipe->getsection(1);
		$data = array(
			'recipes' => $recipes,
			);
		$this->load->helper('url');
		$this->load->view('home',$data);
	}
}
