
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

class Recipelist extends CI_Controller {

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
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$titlecoment = $this->getTitleComent();
		$this->load->model('recipe');
		$recordCount = count($this->recipe->getlist()) / 10;
		$this->db->limit (10, ($id - 1) * 10);
		$recipes = $this->recipe->getlist();
		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'recordCount' => $recordCount,
			'currentPage' => $id,
			'username' => $this->session->userdata('username'),
			'title' => 'Ежедневные вкусняшки'
			);
		if($data != null)
		{
			$this->load->helper('url');
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/showrecipe',$data);
			$this->load->view('admin/footer');
		}
	}
}