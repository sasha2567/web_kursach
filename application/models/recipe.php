<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recipe extends CI_Model {
    
    var $table = 'recipe';
    var $product_table = 'products';
    var $recipe_product_table = 'recipe_product';
    var $type_table = 'types';
    var $key_id = 'recipe_id';
    var $section_id = 'section_id';
    var $product_id = 'product_id';

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
        return $id;
    }

    function addIngredients($data)
    {
        foreach ($data as $value) {
            $this->db->insert($this->recipe_product_table, $value);
        }
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
     * get info about 
     */
    function getsection($id){
        $this->db->where($this->section_id, $id);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get info about 
     */
    function getproduct($id){
        $this->db->where($this->key_id, $id);
        $query = $this->db->get($this->recipe_product_table);
        $temp = $query->result_array();
        $result = array();
        foreach ($temp as $value) {
            $this->db->where($this->product_id, $value[$this->product_id]);
            $query = $this->db->get($this->product_table);
            $tmp = $query->result_array();
            foreach ($tmp as $var) {
                $tmp = $var;
                break;
            }
            $type = $value['type_id'];
            $this->db->where('type_id', $type);
            $query = $this->db->get($this->type_table);
            $tmpp = $query->result_array();
            foreach ($tmpp as $var) {
                $tmpp = $var;
                break;
            }
            $type = $tmpp['type'];
            $tmp = $tmp['description'];
            $result[] = array(
                'product' => $tmp,
                'count' => $value['count'],
                'type' => $type
            );
        }
        return $result;
    }

    /**
     * get info about 
     */
    function getproductlist()
    {
        $query = $this->db->get($this->product_table);
        return $query->result_array();
    }

    /**
     * get info about 
     */
    function getproductid($value='')
    {
        $this->db->where('description', $value);
        $query = $this->db->get($this->product_table);
        return $query->result_array();
    }

    function getsearch($value='', $id = 0)
    {
        $this->db->like('description', $value);
        $this->db->limit (10, ($id - 1) * 10);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get info about 
     */
    function getrecipeid($value = null)
    {
        //запрос
        $query = $this->db->get($this->product_table);
        return $query->result_array();
    }

    /**
     * get info about 
     */
    function gettypeslist()
    {
        $query = $this->db->get($this->type_table);
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