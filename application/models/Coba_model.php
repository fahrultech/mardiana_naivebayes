<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Coba_model extends CI_Model{
    public $table = 'coba';
    public $id = 'id';
    public $order = 'id';
    
    //Constructor
    function __construct(){
        parent::__construct();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
}
