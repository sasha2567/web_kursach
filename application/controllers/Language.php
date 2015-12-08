<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

	public function index($id = 1)
	{
		if($id == 1){
			$newdata = array(
			   'language'  => 'rus',
			);
			$this->session->set_userdata($newdata);
		}
		if($id == 2){
			$newdata = array(
			   'language'  => 'eng',
			);
			$this->session->set_userdata($newdata);
		}
		redirect('home');
	}
}
