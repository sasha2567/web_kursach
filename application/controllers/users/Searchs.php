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

	private $searchString = "";
	private $ingredients = null;

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

	public function index()
	{
		$titlecoment = $this->getTitleComent();
		$searchString = "";
		$ingredients = null;
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 4,
			'username' => $this->session->userdata('username'),
			'title' => 'Поиск рецепта'
			);
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('searchs',$data);
		$this->load->view('footer');
	}

	public function search($id = 1)
	{
		if(isset($_POST['user_search_btn'])){
			$datain = $_POST['search_text'];
			$searchString = $datain;
		}
		if($searchString != ""){
			$titlecoment = $this->getTitleComent();
			$this->load->model('recipe');
			$recipes = $this->recipe->getsearch($datain, $id);
			$recordCount = count($this->recipe->getsearch($datain, $id)) / 10;
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
			$this->load->view('menu',$data);
			$this->load->view('searchs',$data);
			$this->load->view('footer');
		}
	}

	public function recipesearch($id = 1)
	{
		if(isset($_POST['user_search_recipe_btn'])){
			$titlecoment = $this->getTitleComent();
			$ingredients = array();
			$this->load->model('recipe');
	        foreach ($_POST['ingredients'] as $ingredient) { 
				$temp = $this->recipe->getproductid($ingredient);
				$temp = $temp[0];
				$ingredients[] = $temp['product_id'];
			}
		}
		if($ingredients != null){
			$recipeId = $this->recipe->getrecipeid($ingredients);
			$recipes = array();
			foreach ($recipeId as $value) {
				$temp = $this->recipe->get($value['recipe_id']);
				$temp = $temp[0];
				$recipes[] = $temp;
			}
			$recordCount = count($recipes) / 10;
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
			$this->load->view('menu',$data);
			$this->load->view('searchs',$data);
			$this->load->view('footer');
		}
	}
}
