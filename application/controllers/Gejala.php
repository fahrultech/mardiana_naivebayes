<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Gejala_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("gejala");
    }
    function getAllData(){
        $this->load->model('Gejala_model','gejala');
        $list = $this->Gejala_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->gejala;
           $row[] = '<div style="text-align:center">
                      <button onClick="editGejala('."'$li->id'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusGejala('."'$li->id'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          "recordsTotal" => $this->gejala->count_all(),
          "recordsFiltered" => $this->gejala->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function tambahGejala(){
      $data = array(
        'gejala' => $this->input->post('gejala'),
      );
      $insert = $this->Gejala_model->insert($data);
      echo json_encode(array("status" => TRUE));
    }
    function editGejala($id){
      $data = $this->Gejala_model->getById($id);
      echo json_encode($data);
    }
    function hapusGejala($id){
      $this->Gejala_model->deleteById($id);
      echo json_encode(array("status" => TRUE));
    }
    function updateGejala(){
      $data = array(
        'gejala' => $this->input->post('gejala'),
      );
      $this->Gejala_model->update(array('id' => $this->input->post('idgejala')),$data);
      echo json_encode(array("status" => TRUE));
    }
     

}