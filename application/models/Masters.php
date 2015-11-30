<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Model {
    
    var $table = 'master';
    var $key_id = 'master_id';
    var $table_master = 'master_user';
    var $table_user = 'user';
    var $user_key_id = 'user_id';

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
     * add data
     */
    function adduser($id)
    {
        $this->db->order_by('date', 'desc');
        $query = $this->db->get($this->table);
        $query = $query->result_array();
        $query = $query[0];
        $data = array(
            'master_id' => $query['master_id'],
            'user_id' => $id
        );
        $this->db->insert($this->table_master, $data);
    }

    /**
     * add data
     */
    function deleteuser($id)
    {
        $this->db->order_by('date', 'desc');
        $query = $this->db->get($this->table);
        $query = $query->result_array();
        $query = $query[0];
        $data = array(
            $this->key_id => $query[$this->key_id],
            $this->user_key_id => $id
        );
        $this->db->delete($this->table_master, $data);
    }
    /**
     * get info
     */
    function get(){
        $this->db->order_by('date', 'desc');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get info
     */
    function getUser($userid)
    {
        $this->db->where($this->user_key_id, $userid);
        $query = $this->db->get($this->table_user);
        return $query->result_array();
    }

    /**
     * get list
     */
    function getlist(){
        $this->db->order_by('date', 'desc');
        $query = $this->db->get($this->table);
        $query = $query->result_array();
        $query = $query[0];
        $this->db->where($this->key_id, $query[$this->key_id]);
        $query = $this->db->get($this->table_master);
        return $query->result_array();
    }
}