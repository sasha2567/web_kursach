<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('recipe');
		$recipes = $this->recipe->getlist();
		$data = array(
			'recipes' => $recipes,
			'title' => 'Главная страница'
			);
		$this->load->helper('url');
		$this->load->view('home',$data);
	}
}
