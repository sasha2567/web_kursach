<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coment extends CI_Model {
    
    var $table = 'coment';
    var $table_user = 'user';
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

    function gettitlecoment(){
        $this->db->order_by('datetime', 'desc');
        $this->db->limit (5, 0);
        $query = $this->db->get($this->table);

        $coments = array();
        
        $coment = $query->result_array();
        foreach ($coment as $value) {
            $this->db->where($this->user_id,$value['user_id']);
            $temp = $this->db->get($this->table_user);
            $temp = $temp->result_array();
            $temp = $temp[0];
            $coments[] = array('user' => $temp, 'coment' => $value);
        }
        return $coments;
    }
}