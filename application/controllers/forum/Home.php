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

class Home extends CI_Controller {

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
		$titlecoment = $this->getTitleComent();
		$this->load->model('forum');
		$themes = $this->forum->gettheme($id);
		$recordCount = count($this->forum->get());
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 5,
			'themes' => $themes,
			'currentPage' => $id,
			'recordCount' => $recordCount,
			'username' => $this->session->userdata('username'),
			'title' => 'Форум'
			);
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('forum/home');
		$this->load->view('footer');
	}

	public function add()
	{
		if(isset($_POST['user_theme_btn'])){
			$data = array(
				'theme' => htmlspecialchars($_POST['theme_name'], NULL, 'ISO-8859-1')
			);
			$this->load->model('forum');
			$theme = $this->forum->addtheme($id);
			$theme = $theme[0];
			redirect('forum/home/show/'.$theme['theme_id']);
		}
	}

	public function show($id = 0)
	{
		$titlecoment = $this->getTitleComent();
		$this->load->model('forum');
		$messeges = $this->forum->getmessege($id);
		$themeName = $this->forum->getthemebyid($id);
		$themeName = $themeName[0];
		$themeName = $themeName['theme'];
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 5,
			'themeId' => $id,
			'themeName' => $themeName,
			'messeges' => $messeges,
			'username' => $this->session->userdata('username'),
			'title' => 'Форум'
			);
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('forum/theme');
		$this->load->view('footer');
	}

	public function addmessege($id = 0)
	{
		if(isset($_POST['user_messege_btn'])){
			$messege = htmlspecialchars($_POST['user_messege'], NULL, 'ISO-8859-1');
			$this->load->model('forum');
			$theme = $this->forum->addmessege($id, $this->session->userdata('user_id'), $messege);
			redirect('forum/home/show/'.$id);
		}
	}
}
