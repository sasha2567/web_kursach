<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coment extends CI_Model {
    
    var $table = 'coment';
    var $key_id = 'coment_id';
    var $user_id = 'user_id';
    var $recipe_id = 'recipe_id';

    function __construct(){
        parent::__construct();
    }

    /**
     * add data
     */
    function add($data){
        $this->db->insert($this->table, $data);
    }

    /**
     * edit data
     */
	function edit($id, $data){
	 $this->db->where($this->key_id, $id);
	 $this->db->update($this->table, $data);
	}

    /**
     * delete data
     */
    function delete($id){
        $this->db->where($this->key_id, $id);
        $this->db->delete($this->table);
    }

    /**
     * get info about 
     */
    function get($id){
        $this->db->where($this->key_id, $id);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function getuser($id){
    	$this->db->where($this->user_id, $id);
    	$query = $this->db->get($this->table);
        return $query->result_array();
    }

    function getrecipe($id){
    	$this->db->where($this->recipe_id, $id);
    	$query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get list of 
     */
    function getlist(){
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}