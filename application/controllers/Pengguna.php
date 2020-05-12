<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller{
    function __construct(){
        parent::__construct();
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
        }
        $this->load->model('User_model','user');
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("pengguna");
    }
    function getAllData(){
        $list = $this->user->get_datatables();
        
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->username;
           $row[] = $li->email;
           $row[] = $li->level;
           $row[] = '<div style="text-align:center">
                      <button type="button" class="btn btn-xs btn-danger" onClick="hapusPengguna('."'$li->id'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          "recordsTotal" => $this->user->count_all(),
          "recordsFiltered" => $this->user->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function hapusPengguna($id){
        $this->user->deleteById($id);
        echo json_encode(array("status" => TRUE));
      }
}