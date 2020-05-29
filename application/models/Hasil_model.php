<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Hasil_model extends CI_Model{
    private $table = 'datauji';

    function __construct(){
        parent::__construct();
    }

    function getHasil($id){
        $this->db->select('username,tipekecanduan.tipekecanduan,detail_datauji.bobot_jawaban');
        $this->db->from('datauji');
        $this->db->where('iduser',$id);
        $this->db->join('detail_datauji','detail_datauji.id_datauji = datauji.Id');
        $this->db->join('tipekecanduan','tipekecanduan.id = datauji.idtipekecanduan');
        $this->db->join('users','users.id = datauji.iduser');
        $query = $this->db->get();
        return $query->result();
    }

}