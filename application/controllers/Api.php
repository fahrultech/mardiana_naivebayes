<?php

class Api extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Gejala_model');
        $this->load->model('Coba_model');
        $this->load->model('DataLatih_model');
        $this->load->model('DataUji_model');
        $this->load->model('TipeKecanduan_model');
        $this->load->model('Hasil_model','hasil');
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
       //$values = array("1","1","2","1","1","1","1","1","1","2","1","1","1","1","1","1","1","1","2","1","1","1","2","1","2","1");
       $values = $jsonArray["quisioner"];
       $iduser = $jsonArray["id"];
       $gejala = $this->Gejala_model->getAll();
       $tipekecanduan = $this->TipeKecanduan_model->getAll();
       $name = $this->User_model->getUserName($iduser);
       $ini = $this->naive;
       $id = $this->DataUji_model->getById($iduser);
       $hasil = $ini->getResult($values, $query);
       
    if(count($id) === 0){
        $data = array("iduser" => $iduser,"idtipekecanduan" => $hasil[0],"tanggal" => date("Y-m-d"));
        $query =  $this->DataUji_model->insert($data);
        $detaildata = array(
            "id_datauji" => $query,
            "id_gejala_1" => $values[0],
            "id_gejala_2" => $values[1],
            "id_gejala_3" => $values[2],
            "id_gejala_4" => $values[3],
            "id_gejala_5" => $values[4],
            "id_gejala_6" => $values[5],
            "id_gejala_7" => $values[6],
            "id_gejala_8" => $values[7],
            "id_gejala_9" => $values[8],
            "id_gejala_10" => $values[9],
            "id_gejala_11" => $values[10],
            "id_gejala_12" => $values[11],
            "id_gejala_13" => $values[12],
            "id_gejala_14" => $values[13],
            "id_gejala_15" => $values[14],
            "id_gejala_16" => $values[15],
            "id_gejala_17" => $values[16],
            "id_gejala_18" => $values[17],
            "id_gejala_19" => $values[18],
            "id_gejala_20" => $values[19],
            "id_gejala_21" => $values[20],
            "id_gejala_22" => $values[21],
            "id_gejala_23" => $values[22],
            "id_gejala_24" => $values[23],
            "id_gejala_25" => $values[24],
            "id_gejala_26" => $values[25],
            "bobot_jawaban" => $hasil[1]
        );
        $this->DataUji_model->insertDetail($detaildata);
    }else{
        $data = array("idtipekecanduan" => $hasil[0],"tanggal" => date("Y-m-d"));
        $this->DataUji_model->update(array("id" => $id[0]->id),$data);
        $detaildata = array(
            "id_gejala_1" => $values[0],
            "id_gejala_2" => $values[1],
            "id_gejala_3" => $values[2],
            "id_gejala_4" => $values[3],
            "id_gejala_5" => $values[4],
            "id_gejala_6" => $values[5],
            "id_gejala_7" => $values[6],
            "id_gejala_8" => $values[7],
            "id_gejala_9" => $values[8],
            "id_gejala_10" => $values[9],
            "id_gejala_11" => $values[10],
            "id_gejala_12" => $values[11],
            "id_gejala_13" => $values[12],
            "id_gejala_14" => $values[13],
            "id_gejala_15" => $values[14],
            "id_gejala_16" => $values[15],
            "id_gejala_17" => $values[16],
            "id_gejala_18" => $values[17],
            "id_gejala_19" => $values[18],
            "id_gejala_20" => $values[19],
            "id_gejala_21" => $values[20],
            "id_gejala_22" => $values[21],
            "id_gejala_23" => $values[22],
            "id_gejala_24" => $values[23],
            "id_gejala_25" => $values[24],
            "id_gejala_26" => $values[25],
            "bobot_jawaban" => array_sum($values)
        );
        $this->DataUji_model->updateDetail($id[0]->id, $detaildata);
    }
    $resultForMobile = array("Gejala " . $tipekecanduan[$hasil[0]-1]->tipekecanduan,array_sum($values));
    echo '{"name": '.json_encode($name->username).',"results" : '.json_encode($resultForMobile).'}';
    }

    function getprofile(){
        $jsonArray = json_decode(file_get_contents('php://input'),true); 
        $id = $jsonArray["id"];
        $query = $this->User_model->getUser($id);
        echo '{"results" : '.json_encode($query).'}';
    }
    function gethasil(){
        $jsonArray = json_decode(file_get_contents('php://input'),true); 
        $id = $jsonArray["id"];
        $res = $this->hasil->getHasil($id)[0];
        echo '{"gejala": '.json_encode("Gejala ".$res->tipekecanduan).',
                "score" : '.json_encode($res->bobot_jawaban).',
                "nama" :'.json_encode($res->username).'}';

    }
    function gantipassword(){
        $username = $this->input->post("username");
        $passwordbaru = $this->input->post("passwordbaru");
        $this->User_model->updatePassword($username,$passwordbaru);
         echo '{"message" : "Berhasil"}';
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