<?php defined('SYSPATH') or die('No direct script access.'); 

/**
* Create own library
*/

class lib_showcoment{

	public function coment_to_title()
	{
		$CI =& get_instance();
		$CI->load->model('coment');
		$CI->db->order_by('datetime', 'desc');
		$CI->db->limit (5, 0);
		$coment = $CI->coment->getlist();
		
		$CI->load->model('user');
		$users = array();
		$coments = array();
		foreach ($coment as $value) {
			$temp = $CI->user->get($value['user_id']);
			foreach ($temp as $var) {
				$temp = $var;
				break;
				}
			$coments['coment'] = $value;
			$coments['user'] = $temp;
		}
		return $coments;
	}
}