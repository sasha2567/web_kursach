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

class Addrecipe extends CI_Controller {

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
		$this->load->model('recipe');
		$products = $this->recipe->getproductlist();
		$types = $this->recipe->gettypeslist();

		$data = array(	
			'titlecoment' => $titlecoment,
			'username' => $this->session->userdata('username'),
			'title' => 'Описание рецепта'
		);

		$this->load->helper('url');
		$this->load->view('admin/menu',$data);
		
		$data = array(
			'products' => $products,
			'types' => $types
		);
		
		$this->load->view('admin/add_recipe',$data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		if(isset($_POST) && isset($_POST['recipe_add_btn']))
		{
			move_uploaded_file($_POST['recipe_image'],"images/".$_POST['recipe_image']);
			$description = $_POST['recipe_description'];
			$recipe = $_POST['recipe_recipe'];
			$section = $_POST['select_section'];
			$imagename = $_POST['recipe_image'];
			$data = array(
	            'description' => $description,
	            'recipe' => $recipe,
	            'section_id' => $section,
	            'image' => $imagename,
	            'date' => date("Y-m-d H:i:s")
	        );
	        $this->load->model('recipe');
	        //$id = $this->recipe->add($data);

	        $ingredients = array();
	        for ($i=1; $i < 1000; $i++) { 
	        	echo($_POST['recipe_count_ing_'.$i]."$$<br />");
	        	if(isset($_POST['ingredient_'.$i]))
	        	{
	        		$ingredients[$i] = array(
	        			'recipe_id' => 4,
	        			'product_id' => $_POST['ingredient_'.$i],
	        			'count' => $_POST['recipe_count_ing_'.$i],
	        			'type_id' => $_POST['type_'.$i],
	        		);
	        	}
	        	else
	        		break;
	        }
	        print_r($ingredients);
	        die();
	        $this->recipe->addIngredients($ingredients);
	        redirect('admin/home');
		}
	}
}
