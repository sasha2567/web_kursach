<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function index()
	{
		$this->load->model('recipe');
		$this->db->order_by('date', 'desc');
		$recipes = $this->recipe->getlist();
		$data = array(
			'recipes' => $recipes,
			);
		$this->load->helper('url');
		$this->load->view('home',$data);
	}
}
