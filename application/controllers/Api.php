<?php

class Api extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Gejala_model');
        $this->load->model('Coba_model');
        $this->load->model('DataLatih_model');
        $this->load->library('naive');
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
    function register(){
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'level' => 'user'
        );
        $insert = $this->User_model->insert($data);
        echo '{"message" : "Berhasil"}';
    }

    function sendgejala(){
        $jsonArray = json_decode(file_get_contents('php://input'),true); 
        echo '{"Jumlah" : "'.count($jsonArray["values"]).'"}';
    }
    function getNaive(){
       $jsonArray = json_decode(file_get_contents('php://input'),true); 
       $query =  $this->DataLatih_model->getData();
       $values = $jsonArray["quisioner"];
       $name = $this->User_model->getUserName($jsonArray["id"]);
       $ini = $this->naive;
       echo '{"name": '.json_encode($name->nama).',"results" : '.json_encode($ini->getResult($values,$query)).'}';
    }

    function getprofile(){
        $jsonArray = json_decode(file_get_contents('php://input'),true); 
        $id = $jsonArray["id"];
        $query = $this->User_model->getUser($id);
        echo '{"results" : '.json_encode($query).'}';
    }

    function updateprofil(){
        $username = $this->input->post("username");
        $id = $this->input->post("id");
        $password = $this->input->post("password");
        $gantipassword = $this->input->post("gantipassword");
        $email = $this->input->post("email");
        
        empty($gantipassword) ? $gantipassword = $password : $gantipassword = $gantipassword;
        
        $isOk = $this->User_model->confirmUser($id,$password);
        if($isOk > 0){
             $data = array("username" => $username,
                           "password" => md5($gantipassword),
                           "email" => $email
                        );
             $this->User_model->update(array("id" => $id),$data);
             echo '{"message" : "Berhasil"}';
        }else{
            echo '{"message" : "Password Salah"}';
        }
    }
}