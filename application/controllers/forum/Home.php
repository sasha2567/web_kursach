<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($id = 1)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Темы форума'; else $title = 'Themes';
		$this->load->model('forum');

		$themes = $this->forum->gettheme($id);
		$recordCount = count($this->forum->get());

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/user_home/news';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = 10;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$pagination_string = $this->pagination->create_links();

		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 5,
			'themes' => $themes,
			'currentPage' => $id,
			'lang' => $lang,
			'pagination' => $pagination_string,
			'username' => $this->session->userdata('username'),
			'title' => $title
			);
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('forum/home');
		$this->load->view('footer');
	}

	public function add()
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('theme_name', 'Имя темы форума', 'required|is_unique[theme.theme]',
				array(
		                'required'      => 'Вы не ввели %s.',
		                'is_unique'     => 'Такой %s уже существует.'
		        )
		);

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'theme' => htmlspecialchars($this->input->post('theme_name'), NULL, 'ISO-8859-1'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->load->model('forum');
			$theme = $this->forum->addtheme($data);
			$theme = $theme[0];
			redirect('forum/home/show/'.$theme['theme_id']);
		}
		redirect('forum/home/index');
	}

	public function show($id = 0)
	{
		$this->load->model('coment');
		$titlecoment = $this->coment->gettitlecoment();
		$lang = $this->session->userdata('language');
		if($lang === FALSE)
			$lang = 'rus';
		if($lang == 'rus') $title = 'Темы форума'; else $title = 'Themes';
		$this->load->model('forum');
		$messeges = $this->forum->getmessege($id);
		$themeName = $this->forum->getthemebyid($id);
		$themeName = $themeName[0];
		$themeName = $themeName['theme'];
		$data = array(
			'titlecoment' => $titlecoment,
			'pageIndex' => 5,
			'themeId' => $id,
			'themeName' => $themeName,
			'messeges' => $messeges,
			'lang' => $lang,
			'username' => $this->session->userdata('username'),
			'title' => 'Форум'
			);
		$this->load->helper('url');
		$this->load->view('menu',$data);
		$this->load->view('forum/theme');
		$this->load->view('footer');
	}

	public function addmessege($id = 0)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_messege', 'Сообщение пользователя', 'required',
				array(
		                'required'      => 'Вы не ввели %s.'
		        )
		);
        if ($this->form_validation->run() == TRUE)
		{
			$messege = htmlspecialchars($this->input->post('user_messege'), NULL, 'ISO-8859-1');
			$this->load->model('forum');
			$theme = $this->forum->addmessege($id, $this->session->userdata('user_id'), $messege);
			redirect('forum/home/show/'.$id);
		}
		redirect('forum/home/show/'.$id);
	}
}