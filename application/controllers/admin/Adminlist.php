<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlist extends CI_Controller {

	public function index()
	{
		$this->load->model('recipe');
		$recipes = $this->recipe->getlist();
		$image_path = 'http://justcooking.16mb.com/application/views/img';
		$data = array(
			'recipes' => $recipes,
			'image_path' => $image_path
			);
		$this->load->helper('url');
		$this->load->view('admin/showrecipe',$data);
	}
}
