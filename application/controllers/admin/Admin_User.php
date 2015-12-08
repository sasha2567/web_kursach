<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_User extends CI_Controller {

	public function index($id = 1, $pageid = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('user');
		$item = $this->user->get($id);
		foreach ($item as $var) {
			$item = $var;
			break;
		}
		$item['is_comented'] = 0;
		$item = $this->user->edit($id,$item);
		redirect('admin/admin_recipe/show/'.$pageid);
	}

	public function give($id = 1, $pageid = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('user');
		$item = $this->user->get($id);
		foreach ($item as $var) {
			$item = $var;
			break;
		}
		$item['is_comented'] = 1;
		$item = $this->user->edit($id,$item);
		redirect('admin/admin_recipe/show/'.$pageid);
	}
}
