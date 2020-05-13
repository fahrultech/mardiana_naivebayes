<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class DataUji_model extends CI_Model{
    public $table = 'datauji';
    public $id = 'id';
    public $order = array('id' => 'asc');
    public $columnOrder = array('iduser');
    public $columnSearch = array('iduser');

    
    //Constructor
    function __construct(){
        parent::__construct();
    }
    function lihatTabel($id){
        $this->db->select('
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
        bobot_jawaban
        ');
        $this->db->from('detail_datauji');
        $this->db->where('id_datauji',$id);
        $qq = $this->db->get();
        return $qq->result();
    }
    function _get_datatables_query(){
        $this->db->select('datauji.id,username,tipekecanduan,tanggal');
        $this->db->from($this->table);
        $this->db->join('tipekecanduan', 'tipekecanduan.id = datauji.idtipekecanduan');
        $this->db->join('users', 'users.id = datauji.iduser');
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
    function count_all(){
        return $this->db->count_all($this->table);
    }
    function getData(){
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
    function getTheData(){
        $this->db->from($this->table);
    }
    function getById($id){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('iduser',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function getDataById($id){
        $this->db->select('username, idtipekecanduan');
        $this->db->from($this->table);
        $this->db->join('users','users.id = datauji.iduser');
        $this->db->where('datauji.id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function insertDetail($data){
        $this->db->insert('detail_datauji',$data);
    }
    function update($id, $data){
        $this->db->update($this->table, $data, $id);
        return $this->db->affected_rows();
    }
    function updateDetail($id, $data){
        $this->db->set($data);
        $this->db->where('id_datauji',$id);
        $this->db->update('detail_datauji');
        return $this->db->affected_rows();
    }
    function deleteById($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
}
