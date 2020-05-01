<?php

class Api extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Gejala_model');
    }

    function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $username;
        $pass = md5($password);

        $cek = $this->Login_model->cek($user, $pass);

        if($cek->num_rows() > 0){
            echo '{"message" : "Berhasil","results" : '.json_encode($cek->result()).'}';
            
        }else{
            header('Content-Type: application/json');
            echo '{"message" : "Email atau password salah"}';
        }
    }
    function getGejala(){
        echo '{"results" : '.json_encode($this->Gejala_model->getAll()).'}';
    }
}