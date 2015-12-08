<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Model {
    
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
    function adduser($id,$userid)
    {
        $data = array(
            'master_id' => $id,
            'user_id' => $userid
        );
        $this->db->insert($this->table_master, $data);
    }

    /**
     * add data
     */
    function deleteuser($id, $masterid)
    {
        $data = array(
            $this->key_id => $masterid,
            $this->user_key_id => $id
        );
        $this->db->delete($this->table_master, $data);
    }

    function deleteMaster($id = 1)
    {
        $this->db->where($this->key_id, $id);
        $this->db->delete($this->table);
    }

    /**
     * get info
     */
    function getUser($masterid)
    {
        $this->db->join($this->table_master, 'user.user_id = master_user.user_id');
        $this->db->where('master_user.master_id', $masterid);
        $query = $this->db->get($this->table_user);
        return $query->result_array();
    }

    function getmaster($masterid)
    {
        $this->db->where($this->key_id, $masterid);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * get list
     */
    function getlist(){
        $this->db->order_by('dateprovide', 'desc');
        $this->db->where('provide', 0);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    function validateUser($userid)
    {
        $id = $this->getlist();
        $id = $id[0];
        $id = $id[$this->key_id];
        $this->db->where($this->user_key_id, $userid);
        $this->db->where($this->key_id, $id);
        $query = $this->db->get($this->table_master);
        return $query->result_array();
    }
}