<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coments {
	public $coment = null;
	public $user = null;

	function __construct($c,$u){
        $this->coment = $c;
        $this->user = $u;
    }
}

class Registration extends CI_Controller {

	public function getTitleComent()
	{
		$this->load->model('coment');
		$this->db->order_by('datetime', 'desc');
		$this->db->limit (5, 0);
		$coment = $this->coment->getlist();
		
		$this->load->model('user');
		$users = array();
		$coments = array();
		foreach ($coment as $value) {
			$temp = $this->user->get($value['user_id']);
			foreach ($temp as $var) {
				$temp = $var;
				break;
				}
			$coments[] = new Coments($value,$temp);
		}
		return $coments;
	}

	public function index($id = 1)
	{
		if(false === $this->session->userdata('username'))
			redirect('home');
		$titlecoment = $this->getTitleComent();
		$data = array(
			'titlecoment' => $titlecoment,
			'username' => $this->session->userdata('username'),
			'title' => 'Регистрация пользователя'
			);
		$this->load->helper('url');
		$this->load->view('users/menu',$data);
		$this->load->view('registration');
		$this->load->view('users/footer');
	}

	public function registrated()
	{
		if(isset($_POST) && isset($_POST['user_registr_btn'])){
			$username = $_POST['user_name'];
			$userpass1 = $_POST['user_password1'];
			$userpass2 = $_POST['user_password2'];
			$userfio = $_POST['user_fio'];
			$usermail = $_POST['user_mail'];
			if($userpass1 == $userpass2){
				$this->load->model('user');
				$user = $this->user->getUser($username);
				foreach ($user as $item) 
				{
					$user = $item;
					break;
				}
				if($user == false){
					echo "4<br />";
					$data = array(
						'username' => $username,
						'password' => $userpass1,
						'fio' => $userfio,
						'email' => $usermail,
					    'is_comented' => 1
					);
					$this->user->add($data);
					$userid = $this->user->getUser($username);
					foreach ($userid as $item) 
					{
						$userid = $item;
						break;
					}
					$userid = $userid['user_id'];
					$newdata = array(
					   'username'  => $username,
					   'email'     => $usermail,
					   'user_id' => $userid
					);
					$this->session->set_userdata($newdata);
					redirect('home');

				}
			}
		}
	}
}