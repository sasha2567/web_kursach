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

class Searchs extends CI_Controller {

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
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 4,
			'currentPage' => $id,
			'username' => $this->session->userdata('username'),
			'title' => 'Поиск рецепта'
			);
		$this->load->helper('url');
		$this->load->view('users/menu',$data);
		$this->load->view('searchs',$data);
		$this->load->view('users/footer');
	}

	public function search($id = 1)
	{
		if(isset($_POST['user_search_btn'])){
			$titlecoment = $this->getTitleComent();
			$this->load->model('recipe');
			$datain = $_POST['search_text'];
			$this->db->like('description', $datain);
			$this->db->limit (10, ($id - 1) * 10);
			$recipes = $this->recipe->getlist();
			$recordCount = count($this->recipe->getlist()) / 10;
			$data = array(
				'recipes' => $recipes,
				'titlecoment' => $titlecoment,
				'pageIndex' => 4,
				'currentPage' => $id,
				'searchflag' => 1,
				'recordCount' => $recordCount,
				'username' => $this->session->userdata('username'),
				'title' => 'Поиск рецепта'
				);
			$this->load->helper('url');
			$this->load->view('users/menu',$data);
			$this->load->view('searchs',$data);
			$this->load->view('users/footer');
		}
	}
}
