<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tingkatkecanduan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('TipeKecanduan_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("tingkatkecanduan");
    }
    function getAllData(){
        $this->load->model('TipeKecanduan_model','tingkatkecanduan');
        $list = $this->TipeKecanduan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->tipekecanduan;
           $row[] = $li->keterangan;
           $row[] = $li->solusi;
           $row[] = '<div style="text-align:center">
                      <button onClick="editTipeKecanduan('."'$li->id'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusTipeKecanduan('."'$li->id'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->tingkatkecanduan->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function tambahTipeKecanduan(){
      $data = array(
        'tipekecanduan' => $this->input->post('tipekecanduan'),
        'keterangan' => $this->input->post('keterangan'),
        'solusi' => $this->input->post('solusi')
      );
      $insert = $this->TipeKecanduan_model->insert($data);
      echo json_encode(array("status" => TRUE));
    }
    function editTipeKecanduan($id){
      $data = $this->TipeKecanduan_model->getById($id);
      echo json_encode($data);
    }
    function hapustipekecanduan($id){
      $this->TipeKecanduan_model->deleteById($id);
      echo json_encode(array("status" => TRUE));
    }
    function updateTipeKecanduan(){
      $data = array(
        'tipekecanduan' => $this->input->post('tipekecanduan'),
        'keterangan' => $this->input->post('keterangan'),
        'solusi' => $this->input->post('solusi')
      );
      $this->TipeKecanduan_model->update(array('id' => $this->input->post('idtipekecanduan')),$data);
      echo json_encode(array("status" => TRUE));
    }
     

}