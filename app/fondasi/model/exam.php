<?php
class Ujian{
    public $id_ujian;
    public function __construct($id_ujian=""){
        $this -> id_ujian = $id_ujian;
    }

    public function select(){
        global $db_con;
        $id_ujian = $this->id_ujian;
        return mysqli_query($db_con,"SELECT*FROM data_ujian WHERE id_ujian = '$id_ujian' ");
    }

    public function selectConfig(){
        global $db_con;
        $id_ujian = $this->id_ujian;
        return mysqli_query($db_con,"SELECT*FROM config_ujian WHERE id_ujian ='$id_ujian' ");
    }

    public function selectSoal(){
        global $db_con;
        $id_ujian = $this->id_ujian;
        return mysqli_query($db_con,"SELECT*FROM data_soal WHERE id_ujian='$id_ujian' ORDER BY id_soal ASC ");
    
    }

    public function getSingleData($req = ""){
        global $db_con;
        $r = mysqli_fetch_array($this->select());
        $c = mysqli_fetch_array($this->selectConfig());
        switch($req){
            case "id_ujian":
                    return $r['id_ujian'];
                break;
            case "nama_ujian":
                    return $r['nama_ujian'];
                break;
            case "buka":
                    return $r['waktu_buka'];
                break;
            case "tutup":
                    return $r['waktu_tutup'];
                break;
            case "status":
                    if($r['tampil_analisis']=="Y"){
                        return true;
                    }else{
                        return false;
                    }
                break;

            case "benar":
                    return $c['bobot_benar'];
                break;

            case "salah":
                return $c['bobot_salah'];
                break;
            
            case "kosong":
                return $c['bobot_kosong'];
                break;
            
            case "durasi":
                return $c['durasi'];
                break;
            case "bobot_isian":
                return $c['essay'];
                break;
            case "bobot_salah_isian":
                return $c['essay_salah'];
                break;
            case "bobot_kosong_isian":
                return $c['essay_kosong'];
                break;

            case "":
                    return $r;
                break;

            default:
                    return false;
                break;
        }
    }

    public function getdataSoal($req, $nomor = ""){
        global $db_con; 
        $no = 1;
        $sel = $this -> selectSoal();
        while($r = mysqli_fetch_array($sel)){
            $id_soal[$no] = $r['id_soal'];
            $soal[$no] = $r['soal'];
            $pil_a[$no] = $r['pilihan_1'];
            $pil_b[$no] = $r['pilihan_2'];
            $pil_c[$no] = $r['pilihan_3'];
            $pil_d[$no] = $r['pilihan_4'];
            $pil_e[$no] = $r['pilihan_5'];
            $tipe[$no]  = $r['tipe'];
            $kunci[$no] = $r['kunci'];
            $benar[$no] = $r['bobot_benar'];
            $salah[$no] = $r['bobot_salah'];
            $kosong[$no] = $r['bobot_kosong'];
            $no++;
        }

        switch($req){
            case "id_soal":
                    return $id_soal[$nomor];
                break;
            case "soal":
                    return $soal[$nomor];
                break;
            case "a":
                    return $pil_a[$nomor];
                break;
            case "b":
                    return $pil_b[$nomor];
                break;
            case "c":
                    return $pil_c[$nomor];
                break;
            case "d":
                    return $pil_d[$nomor];
                break;
            case "e":
                    return $pil_e[$nomor];
                break;
            case "tipe":
                    return $tipe[$nomor];
            case "kunci":
                    return $kunci[$nomor];
                break;
            case "benar":
                    return $benar[$nomor];
                break;
            case "salah":
                    return $salah[$nomor];
                break;
            case "kosong":
                    return $kosong[$nomor];
                break;
            case "count":
                    return mysqli_num_rows($sel);
                break;
            case "";
                return $r;
                break;

        }
        
    }
    public function statusUjian(){
        global $db_con;
        $buka = strtotime($this->getSingleData("buka"));
        $tutup = strtotime($this->getSingleData("tutup"));
        $skrg = CURRENT_TIME;
        //setup status ujian
        if($buka > $skrg && $tutup > $skrg){
            return "belum";
        }elseif($buka <= $skrg && $tutup > $skrg){
            return "run";
        }elseif($tutup < $skrg && $buka < $skrg){
            return "closed";
        }else{
            return "closed";
        }
    }

    public function statusUjianPeserta(){
        global $db_con;
        $id_ujian = $this->id_ujian;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group       =  @$_SESSION['id_group'];
        $res         = new Result("","",$id_ujian,$id_group);
        $progress    = $res->StatusValProgress();
        $nilai       = $res->StatusValNilai();
        if($progress && !$nilai ){
            return "run";
        }elseif(!$progress && !$nilai){
            return "belum";
        }elseif(!$progress && !$nilai){
            return "done";
        }elseif($progress && $nilai){
            return "done";
        }elseif(!$progress && $nilai){
            return "done";
        }else{
            return "error";
        }
    }

    public function create_progress(){
        global $db_con;
        $auth = new AUTH(null,null);
        $auth->AUTHVALEXAM(function(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = @$_SESSION['id_group'];
        $id_ujian = $this->id_ujian;
        $sup = $this->statusUjianPeserta();
        $su = $this->statusUjian();
        $n = $this->getdataSoal("count","");
        $waktu_mulai = date('Y-m-d H:i:s');
        $mulai = date('H:i:s');
        $durasi = $this->getSingleData("durasi");
        $jam_mulai=date('H:i:s'); 
        $jam_selesai=$durasi;
        $times = array($jam_mulai,$jam_selesai); 
          $seconds = 0; foreach ( $times as $time ) { list( $g, $i, $s ) = explode( ':', $time ); 
             $seconds += $g * 3600; $seconds += $i * 60; $seconds += $s; } 
             $hours = floor( $seconds / 3600 ); 
             $seconds -= $hours * 3600; 
             $minutes = floor( $seconds / 60 ); 
             $seconds -= $minutes * 60; 
             if($hours>23){
                     $jam = $hours-24;
                     if($jam==0){
                             $jm ='00';
                     }else{
                             $jm = $jam;
                     }

                     $y = date('Y');
                     $m = date('m');
                     $d = date('d')+1;
                     $tgl = "$y-$m-$d";
              $waktu_selesai = "$tgl $jm:$minutes:$seconds";
     
             }else{
                     $tgl = date('Y-m-d');
                     $waktu_selesai = "$tgl $hours:$minutes:$seconds";
             }
        
        $jwb = "";
        for($i = 1; $i<= $n ; $i++){
            $jwb = ''.$jwb.'0';
            if($i<$n){
                $jwb =''.$jwb.',';
            }
        }
        if($sup == "belum" && $su == "run"){
        mysqli_query($db_con,"
        INSERT INTO 
        progress_ujian 
        SET 
        id_peserta = '$id_peserta',
        id_ujian = '$id_ujian',
        id_group = '$id_group',
        urut_soal = '',
        jawaban  = '$jwb',
        waktu_mulai = '$waktu_mulai',
        batas_waktu = '$waktu_selesai'
        
        ") or die($db_con->error);

        }
    });
    }
    
    
}



?>