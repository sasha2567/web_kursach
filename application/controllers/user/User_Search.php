<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Search extends CI_Controller {

	private $searchString = "";
	private $ingredients = null;

	public function index()
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Поиск рецептов'; else $title = 'Search recipe';
		$this->searchString = '';
		$this->ingredients = null;
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 1,
			'lang' => $lang,
			'pagination' => '',
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('search');
        $this->load->view('footer');
	}

	public function search($id = 1)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'search_text', 'Поисковая строка',
		        'required',
		        array( 'required'      => 'Вы не ввели %s.')
		);
		$recipes = array();
		$flag = 0;
		$this->ingredients = null;
		$pagination_string = '';
		if ($this->form_validation->run() == TRUE || $this->searchString != '')
        {
			$searchString = htmlspecialchars($this->input->post('search_text'), NULL, 'ISO-8859-1');;
			$this->load->model('recipe');
			$recipes = $this->recipe->getsearch($searchString, $id);
			
			$recordCount = count($this->recipe->getsearch($searchString, $id));
			$this->load->library('pagination');
			$config['base_url'] = base_url().'user/user_search/search';
			$config['total_rows'] = $recordCount;
			$config['per_page'] = 10;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			$pagination_string = $this->pagination->create_links();

			$flag = 1;
        }
        $this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Поиск рецептов'; else $title = 'Search recipe';
		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'pageIndex' => 1,
			'currentPage' => $id,
			'searchflag' => $flag,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('search');
        $this->load->view('footer');
	}

	public function recipesearch($id = 1)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		for ($i=0; $i < 1000; $i++) { 
			if( isset( $_POST["ingredients"][$i] ) ) {
				$this->form_validation->set_rules(
			        'ingredients['.$i.']', 'Поисковый ингредиент №'.$i,
			        'required',
			        array( 'required'      => 'Вы не ввели %s.')
				);
			}
			else{
				break;
			}
		}
		$recipes = array();
		$flag = 0;
		$this->searchString = '';
		$pagination_string = '';
		if ($this->form_validation->run() == TRUE || $this->ingredients != null)
        {
			$this->load->model('recipe');
			foreach ($this->input->post('ingredients') as $ingredient) { 
				$temp = $this->recipe->getproductid(htmlspecialchars($ingredient, NULL, 'ISO-8859-1'));
				$temp = $temp[0];
				$ingredients[] = $temp['product_id'];
			}
			$recipes = array();
			if($ingredients != null){
				$recipeId = $this->recipe->getrecipeid($ingredients);
				foreach ($recipeId as $value) {
					$temp = $this->recipe->get($value['recipe_id']);
					$temp = $temp[0];
					$recipes[] = $temp;
				}
			}
			$flag = 1;
        }
        $this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Поиск рецептов'; else $title = 'Search recipe';

		$recordCount = count($recipes);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/user_search/recipesearch';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$pagination_string = $this->pagination->create_links();

		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'pageIndex' => 1,
			'currentPage' => $id,
			'searchflag' => $flag,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('search');
        $this->load->view('footer');
	}
}
