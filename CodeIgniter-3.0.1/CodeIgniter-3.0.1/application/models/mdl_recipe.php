<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recipe extends CI_Model {
    
    var $table = 'recipe';
    var $key_id = 'recipe_id';

    function __construct(){
        parent::__construct();
    }

    function add(){
        echo 'function add';
    }
}