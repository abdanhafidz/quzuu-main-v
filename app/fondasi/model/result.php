<?php
class Result{
    public $id_peserta;
    public $id_result;
    public $id_progress;
    public $id_ujian;
    public $id_group;

    public function __construct($id_result,$id_progress,$id_ujian,$id_group){
        $this->id_result = $id_result;
        $this->id_progress = $id_progress;
        $this->id_ujian = $id_ujian;
        $this->id_group = $id_group;
        
    }
    public function selectNilai(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_result = $this->id_result;
        $id_ujian = $this->id_ujian;
        $id_group = $this->id_group;
        return mysqli_query($db_con,"SELECT*FROM data_nilai WHERE id_nilai = '$id_result' OR (id_peserta='$id_peserta' AND id_ujian='$id_ujian' AND id_group='$id_group' ) ");
    }

    public function getSingleDataNilai($req = ""){   
        global $db_con;
        $r = mysqli_fetch_array($this->selectNilai());
        return $r[$req];
    }

    public function selectProgress(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_progress = $this->id_progress;
        $id_result = $this->id_result;
        $id_ujian = $this->id_ujian;
        $id_group = $this->id_group;
        return mysqli_query($db_con,"SELECT*FROM progress_ujian WHERE id_progress = '$id_progress' OR (id_peserta='$id_peserta' AND id_ujian='$id_ujian' AND id_group='$id_group') ");
    }

    public function getSingleDataProgress($req = ""){   
        global $db_con;
        $r = mysqli_fetch_array($this->selectProgress());
        return $r[$req];
    }
    public function getJawaban($no){
        global $db_con;
        $s = $this->selectProgress();
        $exam = new Ujian($this->id_ujian);
        $soal = $exam->selectSoal();
        $n = mysqli_num_rows(
            $soal
        );
        $r = mysqli_fetch_array(
            $s
        );
        $ans = explode(',',$r['jawaban']);
        for($i = 1;$i<=$n;$i++){
            $jwb[$i] = $ans[$i-1];
        }
        return $jwb[$no];
    }   

    public function updateJawaban($no,$jwb){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_progress = $this->id_progress;
        $id_result = $this->id_result;
        $id_ujian = $this->id_ujian;
        $id_group = $this->id_group;
        $s = $this->selectProgress();
        $exam = new Ujian($this->id_ujian);
        $soal = $exam->selectSoal();
        $n = mysqli_num_rows($soal);
        $upjwb = '';
        for($i = 1; $i<=$n ; $i++){
            if($i!=$no){
                $upjwb=''.$upjwb.''.$this->getJawaban($i).'';
            }else{
                $upjwb=''.$upjwb.''.$jwb.'';
            }

            if($i<$n){
                $upjwb=''.$upjwb.',';
            }
        }
        return mysqli_query($db_con,"UPDATE progress_ujian SET jawaban='$upjwb' WHERE id_progress = '$id_progress' OR (id_peserta='$id_peserta' AND id_ujian='$id_ujian' AND id_group='$id_group')");
    }
    public function statusValProgress(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = $this->id_group;
        $id_ujian = $this->id_ujian;
        $progress =  mysqli_query($db_con,"SELECT*FROM progress_ujian WHERE id_peserta = '$id_peserta' AND id_group='$id_group' AND id_ujian = '$id_ujian' ") or die($db_con->error);
        $status = mysqli_num_rows($progress);
        if($status > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function statusValNilai(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = $this->id_group;
        $id_ujian = $this->id_ujian;
        $result = mysqli_query($db_con,"SELECT*FROM data_nilai WHERE id_peserta = '$id_peserta' AND id_group='$id_group' AND id_ujian = '$id_ujian' ") or die($db_con->error);
        $status = mysqli_num_rows($result);
        if($status > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function submitProgress(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = $this->id_group;
        $id_ujian = $this->id_ujian;
        $exam = new Ujian($this->id_ujian);
        $soal = $exam->selectSoal();
        $n_soal = mysqli_num_rows($soal);
        $benar = 0;
        $salah = 0;
        $kosong = 0;
        $benar_isian = 0;
        $salah_isian = 0;
        $kosong_isian = 0;
        $bb = $exam->getSingleData("benar");
        $bs = $exam->getSingleData("salah");
        $bk = $exam->getSingleData("kosong");
        $b_isian = $exam->getSingleData("bobot_isian");
        $s_isian = $exam->getSingleData("bobot_salah_isian");
        $k_isian = $exam->getSingleData("bobot_kosong_isian"); 
        if($bb != 0 && $b_isian !=0){
        for($i = 1;$i<=$n_soal;$i++){
            $jwb = $this->getJawaban($i);
            $kunci = $exam->getdataSoal("kunci",$i);
            $tipe = $exam->getdataSoal("tipe",$i); 
            if($jwb == $kunci){
                if($tipe == "pg"){
                $benar++;
                }else if($tipe == "isian"){
                $benar_isian++;
                }
            }elseif($jwb !=0 && $jwb != $kunci){
                if($tipe == "pg"){
                $salah++;
                }else if($tipe == "isian"){
                $salah_isian++;
                }
            }elseif($jwb == 0){
                if($tipe == "pg"){
                $kosong++;
                }else if($tipe == "isian"){
                $kosong_isian++;
                }
            }
        }
        $n_isian = ($benar_isian*$b_isian) + ($salah_isian*$s_isian) + ($kosong_isian*$k_isian);
        $n_pg = ($bb*$benar) + ($bs*$salah) + ($bk*$kosong);
    }else{
        $n_pg = 0;
            $n_isian = 0;
    for($i = 1;$i<=$n_soal;$i++){
            $jwb = $this->getJawaban($i);
            $kunci = $exam->getdataSoal("kunci",$i);
            $tipe = $exam->getdataSoal("tipe",$i); 
            $b_b = $exam->getdataSoal("benar",$i); 
            $b_s = $exam->getdataSoal("salah",$i); 
            $b_k = $exam->getdataSoal("kosong",$i); 
            
            if($jwb == $kunci){
                if($tipe == "pg"){
                $benar++;
                $n_pg += $b_b;
                }else if($tipe == "isian"){
                $benar_isian++;
                $n_isian += $b_b;
                }
            }elseif($jwb !=0 && $jwb != $kunci){
                if($tipe == "pg"){
                $salah++;
                $n_pg += $b_s;
                }else if($tipe == "isian"){
                $salah_isian++;
                $n_isian += $b_s;
                }
            }elseif($jwb == 0){
                if($tipe == "pg"){
                $kosong++;
                $n_pg += $b_k;
                }else if($tipe == "isian"){
                $kosong_isian++;
                $n_isian += $b_k;
                }
            }
        }
    }
       
    $waktu_mulai  = date_create($this->getSingleDataProgress("waktu_mulai")); 
        $waktu_selesai = date_create(date('Y-m-d H:i:s')); 
        $selesai = date('Y-m-d H:i:s');
        $diff =  date_diff($waktu_mulai, $waktu_selesai);
        $jam = $diff->h;
        $menit= $diff->i;
        $detik = $diff->s;
        $durasi = "$jam:$menit:$detik";
        $durasi_stamp = strtotime(date('Y-m-d H:i:s'));  
        
        $nilai = $n_pg + $n_isian;
        if(!$this->statusValNilai() && $this->statusValProgress() )
        return (
        mysqli_query($db_con,"
        INSERT INTO data_nilai 
        SET 
        id_peserta='$id_peserta',
        id_ujian='$id_ujian',
        id_group='$id_group',
        jml_benar='$benar',
        jml_salah='$salah',
        jml_kosong='$kosong',
        nilai='$nilai',
        benar_isian = '$benar_isian',
        salah_isian = '$salah_isian',
        kosong_isian = '$kosong_isian',
        essay='$n_isian',
        pg = '$n_pg',
        durasi='$durasi',
        durasi_stamp = '$durasi_stamp',
        selesai = '$selesai'
         ") or die($db_con->error)
        ) ;
    }  
    public function rankedlist(){
        global $db_con;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = $this->id_group;
        $id_ujian = $this->id_ujian;
        return( mysqli_query($db_con,
        "SELECT*FROM data_nilai 
        WHERE 
        id_ujian = '$id_ujian' AND
        id_group = '$id_group'
        ORDER BY 
        nilai DESC,
        essay DESC,
        pg DESC,  
        benar_isian DESC,
        salah_isian ASC,
        jml_benar DESC,
        jml_salah ASC,
        durasi_stamp ASC
         ")
        );
    }

    public function getAns($req,$no){
        $jwbi = $this->getSingleDataProgress("jawaban");
        $exam = new Ujian($this->id_ujian);
        $soal = $exam->selectSoal();
        $n_soal = mysqli_num_rows(
            $soal
        );
        $r = explode(",",$jwbi);
        
        for($i = 1; $i<=$n_soal ; $i++){
            $jwb[$i] = $r[$i - 1];
            $kunci = $exam->getdataSoal("kunci",$i);
            $benar[$i] = false;
            $salah[$i] = false;
            $kosong[$i] = false;
            if($jwb[$i] == $kunci){  
                $benar[$i] = true;
            }elseif($jwb[$i] != $kunci && $jwb[$i]!= 0 ){
                $salah[$i] = true;
            }elseif($jwb[$i] == 0){
                $kosong[$i] = true;
            }
        }
        switch($req){
            case "status":
                if($benar[$no]){
                    return "benar";
                }elseif($salah[$no]){
                    return "salah";
                }elseif($kosong[$no]){
                    return "kosong";
                }
                break;
            case "jwb":
                    return $jwb[$no];
                break;
        }
    }
}





?>