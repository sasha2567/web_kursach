<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function logined()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'username', 'Логин',
		        'required',
		        array(
		                'required' => 'Вы не ввели %s.'
		        )
		);
		$this->form_validation->set_rules('user_password', 'Пароль', 'required',
				array(
		                'required' => 'Вы не ввели %s.'
		        )
		);
		if ($this->form_validation->run() == TRUE)
		{
			$username = htmlspecialchars($this->input->post('username'), NULL, 'ISO-8859-1');
			$user_password = htmlspecialchars($this->input->post('user_password'), NULL, 'ISO-8859-1');
			$this->load->model('user');
			$user = $this->user->getUser($username);
			$user = $user[0];
			if($user['password'] == $user_password && $username == 'admin')
			{
				$newdata = array(
				   'username'  => $username,
				   'email'     => $user['email'],
				   'user_id' => $user['user_id']
				);
				$this->session->set_userdata($newdata);
				redirect('admin/admin_home');
			}
			if($user['password'] == $user_password && $username == $user['username'])
			{
				if($username == "" || $user_password == "")
					redirect('home');
				$newdata = array(
				   'username'  => $username,
				   'email'     => $user['email'],
				   'user_id' => $user['user_id'],
				   'usercoment' => $user['is_comented']
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
		$this->session->unset_userdata('is_comented');
		redirect('home');
	}
}
