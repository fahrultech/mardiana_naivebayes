<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Naive {
    //$values = array("2","2","3","3","3","1","2","1","1","1","2","2","2","2","1","1","1","3","2","2","1","2","2","2","1","4");
        //$values = array("2","3","3","3","2","1","3","2","2","2","3","3","3","3","2","3","3","3","3","3","3","4","3","2","3","4");
        //$values = array("1","1","2","1","1","1","1","1","1","2","1","1","1","1","1","1","1","1","2","1","1","1","2","1","2","1");
        private $res = 0;
        private $probres = 0;
        public function __construct(){
            
           
        }
        public function getResult($values,$query){
            $countSedang = 0;
            $countRingan = 0;
            $countBerat = 0;
            $jumlahArrayGejalaRingan = array();
            $jumlahArrayGejalaSedang = array();
            $jumlahArrayGejalaBerat = array();
            $arrayGejalaRingan = array(); 
            $arrayGejalaSedang = array();
            $arrayGejalaBerat = array();
            for($i=1;$i<=26;$i++){
                ${'jumlahGejalaRingan_'.$i} = 0;
                ${'jumlahGejalaSedang_'.$i} = 0;
                ${'jumlahGejalaBerat_'.$i} = 0;
            }
            
            foreach($query as $q){
                if($q->idtipekecanduan === "1"){
                    $row = array();
                    $countRingan++;
                    for($i=1;$i<=26;$i++){
                        if($q->{'id_gejala_'.$i} === $values[$i-1]){
                         ${'jumlahGejalaRingan_'.$i}++;
                        }
                        $row[] = $q->{'id_gejala_'.$i};
                    }
                    $arrayGejalaRingan[] = $row;
                }else if($q->idtipekecanduan === "2"){
                     $row = array();
                     $countSedang++;
                     for($i=1;$i<=26;$i++){
                         if($q->{'id_gejala_'.$i} === $values[$i-1]){
                             ${'jumlahGejalaSedang_'.$i}++;
                         }
                         $row[] = $q->{'id_gejala_'.$i};
                     }
                     $arrayGejalaSedang[] = $row;
                }else{
                     $row = array();
                     $countBerat++;
                     for($i=1;$i<=26;$i++){
                         if($q->{'id_gejala_'.$i} === $values[$i-1]){
                             ${'jumlahGejalaBerat_'.$i}++;
                         }
                         $row[] = $q->{'id_gejala_'.$i};
                     }
                     $arrayGejalaBerat[] = $row;
                }
             }
             for($i=1;$i<=26;$i++){
                $jumlahArrayGejalaRingan[] = ${'jumlahGejalaRingan_'.$i};
                $jumlahArrayGejalaSedang[] = ${'jumlahGejalaSedang_'.$i};
                $jumlahArrayGejalaBerat[] = ${'jumlahGejalaBerat_'.$i};
            }
            $allGejalaRingan = array("jumlah" => $countRingan,
                                     "arrayGejalaRingan" =>$arrayGejalaRingan,
                                     "jumlahArrayGejalaRingan" => $jumlahArrayGejalaRingan
            );
            $allGejalaSedang = array("jumlah" => $countSedang,
                                     "arrayGejalaSedang" =>$arrayGejalaSedang,
                                     "jumlahArrayGejalaSedang" => $jumlahArrayGejalaSedang
            );
            $allGejalaBerat = array("jumlah" => $countBerat,
                                     "arrayGejalaBerat" =>$arrayGejalaBerat,
                                     "jumlahArrayGejalaBerat" => $jumlahArrayGejalaBerat
            );
            $pGejalaRingan = $countRingan/count($query);
            $pGejalaSedang = $countSedang/count($query);
            $pGejalaBerat = $countBerat/count($query);
            
            $pAllRingan; $pAllSedang; $pAllBerat  = array();
            
            $pRingan = 1;
            $pSedang = 1;
            $pBerat = 1;
    
            $rr = $this->checkZeroProbability($jumlahArrayGejalaRingan,$countRingan);
            $ss = $this->checkZeroProbability($jumlahArrayGejalaSedang,$countSedang);
            $bb = $this->checkZeroProbability($jumlahArrayGejalaBerat,$countBerat);
            for($i=0;$i<count($rr);$i++){
                $jumlahArrayGejalaRingan = $rr[0];
                $countRingan =$rr[1];
            }
            for($i=0;$i<count($ss);$i++){
                $jumlahArrayGejalaSedang = $ss[0];
                $countSedang =$ss[1];
            }
            for($i=0;$i<count($bb);$i++){
                $jumlahArrayGejalaBerat = $bb[0];
                $countBerat =$bb[1];
            }
            
            for($i=0;$i<count($jumlahArrayGejalaRingan);$i++){
                $pAllRingan[] = $jumlahArrayGejalaRingan[$i]/$countRingan;
                $pRingan *= $jumlahArrayGejalaRingan[$i]/$countRingan;
            }
            for($i=0;$i<count($jumlahArrayGejalaSedang);$i++){
                $pAllSedang[] = $jumlahArrayGejalaSedang[$i]/$countSedang;
                $pSedang *= $jumlahArrayGejalaSedang[$i]/$countSedang;
            }
            for($i=0;$i<count($jumlahArrayGejalaBerat);$i++){
                $pAllBerat[] = $jumlahArrayGejalaBerat[$i]/$countBerat;
                $pBerat *= $jumlahArrayGejalaBerat[$i]/$countBerat;
            }
            $prob = array("ringan" => $pRingan * $pGejalaRingan,
                          "sedang" => $pSedang * $pGejalaSedang,
                          "berat" => $pBerat * $pGejalaBerat);
           
            if($prob["ringan"] > $prob["sedang"] && $prob["ringan"] > $prob["berat"]) {$this->res = 1 ;$this->probres=$prob["ringan"];}
            else if($prob["sedang"] > $prob["berat"] && $prob["sedang"] > $prob["ringan"]) {$this->res = 2 ;$this->probres=$prob["sedang"];}
            else if($prob["berat"] > $prob["sedang"] && $prob["berat"] > $prob["ringan"]) {$this->res = 3 ;$this->probres=$prob["berat"];}
            return array($this->res,strval(sprintf("%1.4e",$this->probres)));
        }
       
        private function checkZeroProbability($data = array(),$stat){
            for($i =0; $i<count($data);$i++){
                if($data[$i] === 0){
                    if($i === 0){
                        $data[$i] = 1;
                        $data[$i+1]++;
                        $stat++;
                    }
                    else{
                        $data[$i] = 1;
                        $data[$i-1]++;
                        $stat++;
                    }
                }
            }
            return array($data,$stat);
         }
}