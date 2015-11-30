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

 function handle_error($user_error_message, $system_error_message) {
 	die ($user_error_message ." " . $system_error_message); 
 };

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
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$titlecoment = $this->getTitleComent();
		$this->load->model('recipe');
		$products = $this->recipe->getproductlist();
		$types = $this->recipe->gettypeslist();

		$data = array(	
			'titlecoment' => $titlecoment,
			'username' => $this->session->userdata('username'),
			'title' => 'Раздел администратора - Добавление нового рецепта'
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
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		if(isset($_POST) && isset($_POST['recipe_add_btn']))
		{
			define('DIRSEP', DIRECTORY_SEPARATOR);
			$upload_dir = __DIR__.DIRSEP."..".DIRSEP."..".DIRSEP."..".DIRSEP."images".DIRSEP;
			$image_fildname = "recipe_image";

			$upload_filename = $upload_dir . $_FILES[$image_fildname]['name'];
			move_uploaded_file($_FILES[$image_fildname]['tmp_name'], $upload_filename);

			$description = htmlspecialchars($_POST['recipe_description'], NULL, 'ISO-8859-1');
			$recipe = htmlspecialchars($_POST['recipe_recipe'], NULL, 'ISO-8859-1');
			$section = htmlspecialchars($_POST['select_section'], NULL, 'ISO-8859-1');
			$imagename = $_FILES[$image_fildname]['name'];
			$data = array(
	            'description' => $description,
	            'recipe' => $recipe,
	            'section_id' => $section,
	            'image' => $imagename,
	            'date' => date("Y-m-d H:i:s")
	        );
	        $this->load->model('recipe');
	        $id = $this->recipe->add($data);

	        $ingredients = array();
	        foreach ($_POST['ingredients'] as $ingredient) { 
			  $ingredients[] = array(
			    'recipe_id'  => $id,
			    'product_id' => $ingredient['product_id'],
			    'count'      => $ingredient['count'],
			    'type_id'    => $ingredient['type_id'],
			  );
			}
	        $this->recipe->addIngredients($ingredients);
	        redirect('admin/home');
		}
	}
}
