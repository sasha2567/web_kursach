<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Home extends CI_Controller {

	public function news($id = 1)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Новые рецепты'; else $title = 'New recipes';

		$this->load->model('recipe');
		$recipes = $this->recipe->getnews($id);
		$recordCount = count($this->recipe->getlist());

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/user_home/news';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$pagination_string = $this->pagination->create_links();

		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'pageIndex' => 2,
			'currentPage' => $id,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('user/home');
        $this->load->view('footer');
	}

	public function daily($id = 1)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Рецепты на каждый день'; else $title = 'Recipes for every day';

		$this->load->model('recipe');
		$recipes = $this->recipe->getdaily($id);
		$recordCount = count($this->recipe->dailylist());

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/user_home/daily';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$pagination_string = $this->pagination->create_links();

		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'pageIndex' => 4,
			'currentPage' => $id,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('user/home');
        $this->load->view('footer');
	}

	public function feast($id = 1)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Рецепты на каждый день'; else $title = 'Recipes for every day';

		$this->load->model('recipe');
		$recipes = $this->recipe->getfeast($id);
		$recordCount = count($this->recipe->feastlist());

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/user_home/daily';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$pagination_string = $this->pagination->create_links();

		$data = array(
			'recipes' => $recipes,
			'titlecoment' => $titlecoment,
			'pageIndex' => 3,
			'currentPage' => $id,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
		);
		$this->load->view('menu',$data);
        $this->load->view('user/home');
        $this->load->view('footer');
	}
}
