<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller {

	public function index()
	{
		$this->load->library('unit_test');
		$this->unit->run($this->load->model('coment'), 'is_object', 'load model "coment"');
		$this->unit->run($this->load->model('user'), 'is_object', 'load model "user"');
		$this->unit->run($this->load->model('recipe'), 'is_object', 'load model "recipe"');
		$this->unit->run($this->load->model('masters'), 'is_object', 'load model "masters"');
		$this->unit->run($this->load->model('forum'), 'is_object', 'load model "forum"');
		
		$m = $this->coment->getlist();
		$this->unit->run($m, 'is_array', 'model "coment" function "getlist"');
		$m = $this->coment->getrecipe(1);
		$this->unit->run($m, 'is_array', 'model "coment" function "getrecipe"');
		$m = $this->coment->getuser(1);
		$this->unit->run($m, 'is_array', 'model "coment" function "getuser"');
		
		$m = $this->forum->getmessege(1);
		$this->unit->run($m, 'is_array', 'model "forum" function "getmessege"');
		$m = $this->forum->gettheme();
		$this->unit->run($m, 'is_array', 'model "forum" function "gettheme"');
		
		$m = $this->user->getUser('admin');
		$this->unit->run($m, 'is_array', 'model "user" function "getUser"');
		$m = $this->user->getlist();
		$this->unit->run($m, 'is_array', 'model "user" function "getlist"');
		
		$m = $this->recipe->getproduct(1);
		$this->unit->run($m, 'is_array', 'model "recipe" function "getUser"');
		$m = $this->recipe->getrecipeid(array(1,2,3));
		$this->unit->run($m, 'is_array', 'model "recipe" function "getlist"');

		$m = $this->masters->getUser(1);
		$this->unit->run($m, 'is_array', 'model "masters" function "getUser"');
		$m = $this->masters->getlist();
		$this->unit->run($m, 'is_array', 'model "masters" function "getlist"');

		$this->unit->set_test_items(array('test_name', 'result')); 
		echo $this->unit->report();
	}
}
