<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauji extends CI_Controller{
    function __construct(){
        parent::__construct();
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
        }
        $this->load->model('DataUji_model','datauji');
        $this->load->model('TipeKecanduan_model','tipekecanduan');
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/datauji");
    }
    function lihat($id){
        $tableData = $this->getDataById($id)["data"];
        $ser = $this->datauji->getDataById($id);
        $data = array("id" => $id,"datatabel" => $tableData,"ser" => $ser[0]);
        $gejala = $this->gejala->getAll();
        $tingkatkecanduan = $this->tipekecanduan->getAll();
        $ser[0]->idtipekecanduan = $tingkatkecanduan[$ser[0]->idtipekecanduan-1]->tipekecanduan;
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/lihatdatauji",$data);
    }
    function getDataById($id){
        $this->load->model('Gejala_model','gejala');
        $list = $this->datauji->lihatTabel($id);
        $gejala = $this->gejala->getAll();
        $arrayGejala = array();
        $hasil = array("Sangat Tidak Setuju","Tidak Setuju", "Setuju", "Sangat Setuju");

        $arrayGejala[] = $hasil[$list[0]->id_gejala_1-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_2-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_3-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_4-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_5-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_6-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_7-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_8-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_9-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_10-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_11-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_12-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_13-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_14-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_15-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_16-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_17-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_18-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_19-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_20-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_21-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_22-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_23-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_24-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_25-1];
        $arrayGejala[] = $hasil[$list[0]->id_gejala_26-1];
       
        $data =array();
        $no = 0;
        foreach($gejala as $g){
           $row = array();
           $row[] = $no+1;
           $row[] = $g->gejala;
           $row[] = $arrayGejala[$no];
           $data[] = $row;
           $no++;
        }
       return array("data" => $data);
    }
    function getAllData(){
        $list = $this->datauji->get_datatables();
        
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->username;
           $row[] = $li->tipekecanduan;
           $row[] = tgl_indo($li->tanggal);
           $row[] = '<div style="text-align:center">
                      <a href="'.site_url('/datauji/lihat/'.$li->id).'" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                      <button type="button" class="btn btn-xs btn-danger" onClick="hapusDataUji('."'$li->id'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          "recordsTotal" => $this->datauji->count_all(),
          "recordsFiltered" => $this->datauji->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function hapusDataUji($id){
        $this->datauji->deleteById($id);
        echo json_encode(array("status" => TRUE));
      }
    
}