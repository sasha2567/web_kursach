<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercoment extends CI_Controller {

	public function index($id)
	{
		$this->load->model('user');
		$item = $this->user->get($id);
		foreach ($item as $var) {
			$item = $var;
			break;
		}
		$item['is_comented'] = 0;
		$item = $this->user->edit($id,$item);
		goback();
	}

	public function give($id)
	{
		$this->load->model('user');
		$item = $this->user->get($id);
		foreach ($item as $var) {
			$item = $var;
			break;
		}
		$item['is_comented'] = 1;
		$item = $this->user->edit($id,$item);
		redirect("adminlist");
	}
}
