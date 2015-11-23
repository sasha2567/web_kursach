<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function logined()
	{
		if(isset($_POST) && isset($_POST['user_login_btn']))
		{
			$username = $_POST['username'];
			$user_password = $_POST['user_password'];
			$this->load->model('user');
			$user = $this->user->getUser($username);
			foreach ($user as $item) 
			{
				$user = $item;
				break;
			}
			if($user['password'] == $user_password && $username == 'admin'){
				{
					$newdata = array(
					   'username'  => $username,
					   'email'     => $user['email'],
					   'user_id' => $user['user_id']
					);
					$this->session->set_userdata($newdata);
					redirect('admin/home');
				}
			}
			if($user['password'] == $user_password && $username == $user['username'])
			{
				if($username == "" || $user_password == "")
					redirect('home');
				$newdata = array(
				   'username'  => $username,
				   'email'     => $user['email'],
				   'user_id' => $user['user_id']
				);
				$this->session->set_userdata($newdata);
				redirect('home');
			}
		}
		else{
			redirect('home');
		}
	}

	public function exitlog()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('user_id');
		redirect('home');
	}
}
