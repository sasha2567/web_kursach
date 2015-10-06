<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlist extends CI_Controller {

	public function index()
	{
		$this->load->model('recipe');
        $recipes = $this->recipe->getlist();
		$data = array(
			'recipes' => $recipes 
			);
		$this->load->helper('url');
		$this->load->view('admin/showrecipe',$data);
	}
}
