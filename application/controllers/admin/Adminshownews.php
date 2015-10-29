<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminshownews extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/home');
	}
}