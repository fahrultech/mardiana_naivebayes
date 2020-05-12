<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataLatih extends CI_Controller{
    function __construct(){
        parent::__construct();
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
        }
        $this->load->model('DataLatih_model');
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/datalatih");
    }
    function lihat($id){
        $tableData = $this->getDataById($id)["data"];
        $tipe = $this->getDataById($id)["tipe"];
        $data = array("id" => $id,"datatabel" => $tableData,"tipe" => $tipe);
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/lihatdatalatih",$data);
    }
    function getDataById($id){
        $this->load->model('DataLatih_model','datalatih');
        $this->load->model('Gejala_model','gejala');
        $list = $this->DataLatih_model->lihatTabel($id);
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
       return array("data" => $data,"tipe" => $list[0]->tipekecanduan);
    }
    function getAllData(){
        $this->load->model('DataLatih_model','datalatih');
        $list = $this->DataLatih_model->get_datatables();
        
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->tipekecanduan;
           $row[] = '<div style="text-align:center">
                      <a href="'.site_url('/datalatih/lihat/'.$li->id).'" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                      <button type="button" class="btn btn-xs btn-danger" onClick="hapusDataLatih('."'$li->id'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->datalatih->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    
}