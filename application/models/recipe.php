<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recipe extends CI_Model {
    
    var $table = 'recipe';
    var $key_id = 'recipe_id';

    function __construct(){
        parent::__construct();
    }

    /**
     * add data
     */
    function add($data){
        $id = count($this->getlist()) + 1;
        $data[$this->key_id] = $id;
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

    /**
     * get list of 
     */
    function getlist(){
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}