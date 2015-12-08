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

class Admin_Recipe extends CI_Controller {

	public function show($id = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Редактирование рецепта'; else $title = 'Editing recipe';

		$this->load->model('recipe');
        $item = $this->recipe->get($id);
        foreach ($item as $var) {
        	$item = $var;
        	break;
        }
        $products = $this->recipe->getproduct($id);
        $product = $this->recipe->getproductlist();
		$types = $this->recipe->gettypeslist();
		$this->load->model('coment');
		$coment = $this->coment->getrecipe($id);
		
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
		$this->load->helper('html');
		$this->load->helper('url');
		$data = array(
			'item' => $item,
			'products' => $products,
			'product' => $product,
			'types' => $types,
			'coments' => $coments,
			'titlecoment' => $titlecoment,
			'pageIndex' => 3,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/showrecipeforredact',$data);
		$this->load->view('admin/footer');
	}

	public function redact($id = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'recipe_recipe', 'Текст рецепта',
		        'required',
		        array( 'required'      => 'Вы не ввели %s.')
		);
		for ($i=0; $i < 1000; $i++) { 
			if( isset( $_POST["ingredients"][$i] ) ) {
				$this->form_validation->set_rules(
			        'ingredients['.$i.']', 'ингредиент №'.$i,
			        'required',
			        array( 'required'      => 'Вы не ввели %s.')
				);
			}
			else{
				break;
			}
		}
		//print_r($_POST);
		//die();
		if ($this->form_validation->run() == TRUE){
			$recipe = htmlspecialchars($this->input->post('recipe_recipe'), NULL, 'ISO-8859-1');
			$data = array(
				'recipe' => $recipe
	        );

	        $ingredients = array();
	        foreach ($_POST['ingredients'] as $ingredient) { 
			  $ingredients[] = array(
			    'recipe_id'  => $id,
			    'product_id' => $ingredient['product_id'],
			    'count'      => $ingredient['count'],
			    'type_id'    => $ingredient['type_id'],
			  );
			}
			//print_r($ingredients);
			//die();
	        $this->load->model('recipe');
	        $this->recipe->deleteIngredients($id);
	        $this->recipe->addIngredients($ingredients);
	        $this->recipe->edit($id,$data);
		}
		redirect('admin/admin_recipe/show/'.$id);
	}

	public function showadd()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}

		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Добавление рецепта'; else $title = 'Add recipe';

		$this->load->model('recipe');
		$products = $this->recipe->getproductlist();
		$types = $this->recipe->gettypeslist();

		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 2,
			'lang' => $lang,
			'products' => $products,
			'types' => $types,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/add_recipe',$data);
        $this->load->view('admin/footer');
	}

	public function add()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('recipe_description', 'Название', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
		$this->form_validation->set_rules('recipe_recipe', 'Текст рецепта', 'required',
				array(
		                'required'      => '%s не введен'
		        )
		);

		for ($i=0; $i < 1000; $i++) { 
			if( isset( $_POST["ingredients"][$i] ) ) {
				$this->form_validation->set_rules(
			        'ingredients['.$i.']', 'Добавляемый ингредиент №'.$i,
			        'required',
			        array( 'required'      => 'Вы не ввели %s.')
				);
			}
			else{
				break;
			}
		}

		for ($i=0; $i < 1000; $i++) { 
			if( isset( $_POST["new_ingredient"][$i] ) ) {
				$this->form_validation->set_rules(
			        'new_ingredient['.$i.']', 'Добавляемый ингредиент №'.$i,
			        'required',
			        array( 'required'      => 'Вы не ввели %s.')
				);
			}
			else{
				break;
			}
		}

		if ($this->form_validation->run() == TRUE){
			define('DIRSEP', DIRECTORY_SEPARATOR);
			$upload_dir = __DIR__.DIRSEP."..".DIRSEP."..".DIRSEP."..".DIRSEP."images".DIRSEP;
			$image_fildname = "recipe_image";

			$filename = time() . $_FILES[$image_fildname]['name'];
			$upload_filename = $upload_dir . $filename;
			move_uploaded_file($_FILES[$image_fildname]['tmp_name'], $upload_filename);

			$description = htmlspecialchars($this->input->post('recipe_description'), NULL, 'ISO-8859-1');
			$recipe = htmlspecialchars($this->input->post('recipe_recipe'), NULL, 'ISO-8859-1');
			$section = htmlspecialchars($this->input->post('select_section'), NULL, 'ISO-8859-1');
			$imagename = $filename;
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
			$new_ingredients = array();
			if(isset($_POST['new_ingredient']))
				foreach ($_POST['new_ingredient'] as $new_ingredient) {
					$temp = $this->recipe->addProduct(array('description' => $new_ingredient['name']));
					$ingredients[] = array(
					    'recipe_id'  => $id,
					    'product_id' => $temp,
					    'count'      => $new_ingredient['count'],
					    'type_id'    => $new_ingredient['type_id'],
					);
				}
	        $this->recipe->addIngredients($ingredients);
		}

		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Добавление рецепта'; else $title = 'Add recipe';

		$this->load->model('recipe');
		$products = $this->recipe->getproductlist();
		$types = $this->recipe->gettypeslist();

		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 2,
			'lang' => $lang,
			'products' => $products,
			'types' => $types,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/add_recipe',$data);
        $this->load->view('admin/footer');
	}
}