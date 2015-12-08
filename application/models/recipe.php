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

    function addProduct($data)
    {
        $this->db->insert($this->product_table, $data);
        $id = null;
        $this->db->where('description', $data['description']);
        $query = $this->db->get($this->product_table);
        $query = $query->result_array();
        $id = $query[0][$this->product_id];
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
    function delete($id = 0){
        $this->db->where($this->key_id, $id);
        $this->db->delete($this->table);
    }

    function deleteIngredients($id = 1)
    {
        $this->db->where($this->key_id, $id);
        $this->db->delete($this->recipe_product_table);
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
            $tmp = $tmp[0];
            $type = $value['type_id'];
            $this->db->where('type_id', $type);
            $query = $this->db->get($this->type_table);
            $tmpp = $query->result_array();
            $tmpp = $tmpp[0];
            $result[] = array(
                'product_id' => $tmp['product_id'],
                'product' => $tmp['description'],
                'count' => $value['count'],
                'type' => $tmpp['type'],
                'type_id' => $tmpp['type_id']
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
        $this->db->like('description', $value);
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
        if($value != null){
            $str = "(".$value[0];
            $i = 1;
            for ($i=1; $i < count($value); $i++) { 
                $str .= ", ".$value[$i];
            }
            $str .= ")";
            $query = $this->db->query("SELECT DISTINCT `recipe_id` FROM `web_recipe_product` А WHERE NOT exists (SELECT `product_id` FROM `web_products` WHERE `product_id` in ".$str." AND NOT exists (SELECT `recipe_id`, `product_id` FROM `web_recipe_product` В WHERE В.`product_id` = `web_products`.`product_id` AND А.`recipe_id` =В.`recipe_id`))");
            return $query->result_array();    
        }
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

    function getnews($id = 1)
    {
        $this->db->order_by('date', 'desc');
        $this->db->limit (10, ($id - 1) * 10);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function getdaily($id = 1)
    {
        $this->db->where($this->section_id, 2);
        $this->db->limit (10, ($id - 1) * 10);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function dailylist()
    {
        $this->db->where($this->section_id, 2);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function getfeast($id = 1)
    {
        $this->db->where($this->section_id, 1);
        $this->db->limit (10, ($id - 1) * 10);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function feastlist()
    {
        $this->db->where($this->section_id, 1);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}