<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class DataLatih_model extends CI_Model{
    public $table = 'datalatih';
    public $id = 'id';
    public $order = array('id' => 'asc');
    public $columnOrder = array('tipekecanduan');
    public $columnSearch = array('tipekecanduan');

    
    //Constructor
    function __construct(){
        parent::__construct();
    }
    function _get_datatables_query(){
        $this->db->select('datalatih.id,tipekecanduan');
        $this->db->from($this->table);
        $this->db->join('tipekecanduan', 'tipekecanduan.id = datalatih.idtipekecanduan');
        $i = 0;
        foreach($this->columnSearch as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }else{
                    $this->db->or_like($item, $POST['search']['value']);
                }
                if(count($this->columnSearch) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST['order'])){
            $this->db->order_by($this->columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function lihatTabel($id){
        $this->db->select('datalatih.id,
        tipekecanduan,
        id_gejala_1,
        id_gejala_2,
        id_gejala_3,
        id_gejala_4,
        id_gejala_5,
        id_gejala_6,
        id_gejala_7,
        id_gejala_8,
        id_gejala_9,
        id_gejala_10,
        id_gejala_11,
        id_gejala_12,
        id_gejala_13,
        id_gejala_14,
        id_gejala_15,
        id_gejala_16,
        id_gejala_17,
        id_gejala_18,
        id_gejala_19,
        id_gejala_20,
        id_gejala_21,
        id_gejala_22,
        id_gejala_23,
        id_gejala_24,
        id_gejala_25,
        id_gejala_26,
        ');
        $this->db->from($this->table);
        $this->db->where('datalatih.id',$id);
        $this->db->join('tipekecanduan', 'tipekecanduan.id = datalatih.idtipekecanduan');
        $qq = $this->db->get();
        return $qq->result();
    }
    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
        echo json_encode($query->result());
    }
    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getData(){
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
    function getTheData(){
        $this->db->from($this->table);
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
}
