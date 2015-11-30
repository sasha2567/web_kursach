<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Model {
    
    var $table = 'theme';
    var $table_theme = 'theme_messege';
    var $table_messege = 'messege';
    var $table_user = 'user';
    var $key_id = 'theme_id';
    var $messege_id = 'messege_id';
    var $user_id = 'user_id';

    function __construct(){
        parent::__construct();
    }

    /**
     * add data
     */
    function addtheme($data){
        $this->db->insert($this->table, $data);
    }

    /**
     * add data
     */
    function addmessege($t_id,$u_id,$m){
        $query = $this->db->get($this->table);
        $c = count($query->result_array());
        $data = array(
        	$messege_id => $c,
        	$user_id => $u_id,
        	'messege' => $m
        );
        $this->db->insert($this->table_messege, $data);
        $data = array(
        	$messege_id => $c,
        	$theme_id => $t_id
        );
        $this->db->insert($this->table_theme, $data);
    }

    /**
     * get info
     */
    function gettheme($id = 1){
        $this->db->limit (10, ($id - 1) * 10);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function get(){
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get list
     */
    function getmessege($id){
        $this->db->select('messege.messege_id, messege.user_id, messege.messege, user.username');
		$this->db->from('theme_messege');
		$this->db->join('messege', 'messege.messege_id = theme_messege.messege_id');
		$this->db->join('user', 'user.user_id = messege.user_id');
		$this->db->where('theme_messege.theme_id', $id);
		$query = $this->db->get();
        return $query->result_array();
    }
}