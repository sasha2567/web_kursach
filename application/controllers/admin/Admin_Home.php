<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Home extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Главная страница'; else $title = 'Main page';
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 0,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/home');
        $this->load->view('admin/footer');
	}

	public function listrecipe($id = 1)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Список рецептов'; else $title = 'List of recipes';

		$this->load->model('recipe');
		$recipes = $this->recipe->getnews($id);
		$recordCount = count($this->recipe->getlist());

		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/admin_home/listrecipe';
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
		$this->load->view('admin/menu',$data);
        $this->load->view('admin/showrecipe',$data);
        $this->load->view('admin/footer');
	}

	public function deleterecipe($id)
	{
		if ($this->session->userdata('username') === false || $this->session->userdata('username') != 'admin') {
			redirect('home');
		}
		$this->load->model('recipe');
		$this->recipe->delete($id);
		redirect('admin/admin_home/listrecipe');
	}
}