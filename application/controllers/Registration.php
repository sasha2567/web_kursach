<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'username', 'Логин',
		        'required|min_length[5]|max_length[12]|is_unique[user.username]',
		        array(
		                'required'      => 'Вы не ввели %s.',
		                'is_unique'     => 'Такой %s уже существует.',
		                'min_length'    => 'Нельзя вводить %s длиной менее 5 символов',
		                'max_length'    => 'Нельзя вводить %s длиной более 12 символов'
		        )
		);
		$this->form_validation->set_rules('password', 'Пароль', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		$this->form_validation->set_rules('passconf', 'Подтверждение пароля', 'required|matches[password]',
				array(
		                'required'      => '%s не введен',
		                'matches'       => 'Пароли не совпадают'
		        )
		);
		$this->form_validation->set_rules('userfio', 'ФИО', 'required',
				array(
		                'required'      => 'Вы не ввели %s'
		        )
		);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]',
				array(
		                'required'      => 'Вы не ввели %s.',
		                'is_unique'     => 'Такой %s уже существует.',
		                'valid_email'    => 'Введен некоректный %s'
		        )
		);
        if ($this->form_validation->run() == TRUE)
        {
            $this->load->model('user');
    		$username = htmlspecialchars($this->input->post('username'), NULL, 'ISO-8859-1');
			$userpass = htmlspecialchars($this->input->post('password'), NULL, 'ISO-8859-1');
			$userfio = htmlspecialchars($this->input->post('userfio'), NULL, 'ISO-8859-1');
			$usermail = htmlspecialchars($this->input->post('email'), NULL, 'ISO-8859-1');
			$data = array(
				'username' => $username,
				'password' => $userpass,
				'fio' => $userfio,
				'email' => $usermail,
			    'is_comented' => 1
			);
			$this->user->add($data);
			$userid = $this->user->getUser($username);
			$userid = $userid[0];
			$userid = $userid['user_id'];
			$newdata = array(
			   'username'  => $username,
			   'email'     => $usermail,
			   'user_id' => $userid
			);
			$this->session->set_userdata($newdata);
			redirect('home');
        }
        $this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Регистрация'; else $title = 'Registration';
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 7,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->view('menu',$data);
        $this->load->view('registrationform');
        $this->load->view('footer');
    }
}
