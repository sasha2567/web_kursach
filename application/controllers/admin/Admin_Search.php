<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Search extends CI_Controller {

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
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/search');
        $this->load->view('admin/footer');
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
			$config['base_url'] = base_url().'admin/admin_search/search';
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
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/search');
        $this->load->view('admin/footer');
	}
}
