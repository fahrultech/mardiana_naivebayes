<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller{
    function __construct(){
        parent::__construct();
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        
    }
    function datalatih(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/datalatih");
    }
    function datauji(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("konsultasi/datauji");
    }
}