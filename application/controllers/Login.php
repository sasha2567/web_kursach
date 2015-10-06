<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->model('user');
        $users = $this->user->getlist();
		$data = array(
			'users' => $users 
			);
		$this->load->helper('url');
		$this->load->view('login',$data);
	}

	public function logined()
	{
		if(isset($_POST) && isset($_POST['user_login_btn']))
		{
			$username = $_POST['username'];
			$user_password = $_POST['user_password'];
			$data = array(
				'username' => $username,
				'user_password' => $user_password
			);

			$this->load->model('user');
			$user = $this->user->getUser($username);
			foreach ($user as $item) {
				$user = $item;
				break;
			}
			if($user['password'] == $user_password && $username == 'admin')
				redirect('adminhome');
			else
				redirect('hello');
		}
		else
			redirect('hello');
	}
}
