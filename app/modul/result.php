<?php
class Hasil{
    public function review(){
        $id_ujian = act;
        $exam = new Ujian($id_ujian);
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
        $nama = $exam->getSingleData("nama_ujian");
        $open = $res->getSingleDataProgress("waktu_mulai");
        $close = $res->getSingleDataNilai("selesai");
        $openNew = new DateTime($open);
        $closeNew = new DateTime($close);
        $pg = $res->getSingleDataNilai("nilai");
        $isian = $res->getSingleDataNilai("essay");
        $b_pg = $res->getSingleDataNilai("jml_benar");
        $s_pg = $res->getSingleDataNilai("jml_salah");
        $k_pg = $res->getSingleDataNilai("jml_kosong");
    	$bo_b = $exam->getSingleData("benar");
    	$bo_s = $exam->getSingleData("salah");
    	$bo_k = $exam->getSingleData("kosong");
    	$bo_isian_b = $exam->getSingleData("bobot_isian");
    	$bo_isian_s = $exam->getSingleData("bobot_salah_isian");
    	$bo_isian_k = $exam->getSingleData("bobot_kosong_isian");
        $b_isian = $res->getSingleDataNilai("benar_isian");
        $s_isian = $res->getSingleDataNilai("salah_isian");
        $k_isian = $res->getSingleDataNilai("kosong_isian");
        $durasi = $res->getSingleDataNilai("durasi");
        $jml_pg = $b_pg + $s_pg + $k_pg;
        $jml_isian = $b_isian + $s_isian + $k_isian;
        $jml_soal  = $jml_pg + $jml_isian;
        $nilai = $pg + $isian;
        $acc = floor((($b_pg + $b_isian)/($jml_soal))*100);
        $date = ''.$openNew->format('F d, Y H:i').' - '.$closeNew->format('F d, Y H:i').'';
        $auth = new AUTH(null,null);
        echo '  <div class="col-md-9">
        <div class="card card-review">
        <div class="card-header">
        <a href="'.domain.'/editorial/'.act.'" target="_blank"><button class="btn btn-editorial"><i class="fa fa-edit"></i> Lihat Editorial </button></a>
        <div class="text-review-header"><b class="text-white">Review Ujian</b></div>
        </div>
        <div class="card-body list-review">
        <table class="table table-review">
        <thead>
       
        </thead>
        <tbody>
    
        ';
            
            for($i=1;$i<=$jml_soal;$i++){
                $tipe = $exam->getdataSoal("tipe",$i);
                $p[0] = $exam->getdataSoal("a",$i);
                $p[1] = $exam->getdataSoal("b",$i);
                $p[2] = $exam->getdataSoal("c",$i);
                $p[3] = $exam->getdataSoal("d",$i);
                $p[4] = $exam->getdataSoal("e",$i);
                $jwb = $res->getAns("jwb",$i);
                $kunci = $exam->getdataSoal("kunci",$i);
                $status = $res->getAns("status",$i);
                if($b_pg == 0 && $b_isian == 0){
                    $pg_benar = $exam->getdataSoal("benar",$i);
                    $pg_salah = $exam->getdataSoal("salah",$i);
                    $pg_kosong = $exam->getdataSoal("kosong",$i);
        
                    $isian_benar = $exam->getdataSoal("benar",$i);
                    $isian_salah = $exam->getdataSoal("salah",$i);
                    $isian_kosong = $exam->getdataSoal("kosong",$i);
                }else{
                    $pg_benar = $bo_b;
                    $pg_salah = $bo_s;
                    $pg_kosong = $bo_k;
        
                    $isian_benar = $bo_isian_b;
                    $isian_salah = $bo_isian_s;
                    $isian_kosong = $bo_isian_k;
                }
                echo'
        <tr>
        <td >
        <div class="soal-review">
        <p>
        <div class="panel-review">
        <b class="badge bg-info q-review">#Question-'.$i.'</b>';
        if($status == "benar"){
            if($tipe == "pg"){
            echo '
            <div class="scoring">'.$pg_benar.'.00</div>
            ';
            }else{
                echo '
            <div class="scoring">'.$isian_benar.'.00</div>
            ';
            }
        }elseif($status == "salah"){
            if($tipe == "pg"){
            echo '
            <div class="scoring">'.$pg_salah.'.00</div>
            ';
            }else{
                echo '
            <div class="scoring">'.$isian_salah.'.00</div>
            ';
            }
        }elseif($status == "kosong"){
            if($tipe == "pg"){
            echo '
            <div class="scoring scoring-kosong">'.$pg_kosong.'.00</div>
            ';
            }else{
                echo '
            <div class="scoring scoring-kosong">'.$isian_kosong.'.00</div>
            ';
            }
        }

echo'
        </div>
        '.$exam->getdataSoal("soal",$i).'
        
        ';
       
        if($tipe == "pg"){
        for($j=0;$j<5; $j++){
            if($p[$j]!= ''){
                
                echo '   <div style="display:inline-block" id="pilihan-a" class="col-lg-12 '; if((($j+1) == $kunci && $status == "benar") or $j+1 == $kunci ){echo 'jwb-benar'; }elseif($status == "salah" && $jwb == ($j+1)){echo ' jwb-salah';} echo '">

                <div class="form-check">
                <input class="form-check-input" type="radio" name="pilihan">
                <label class="form-check-label" for="radio-a" id="opsi-a">
                 '.$p[$j].'
                </label>
                </div>
        
                </div>
                
                ';
            }
        }
    }elseif($tipe == "isian"){
        echo ' <div class="row"><div class="col-md-8"><div class="col-lg-12" style="display:inline-block" id="isian">
        <p style="font-size:11pt">Answer : </p>
        <input type="text" class="form-control" disabled id="input-isian" value="'.$jwb.'" />
        <div id="label-change-isian"></div>
    </div></div>
        <div class="col-md-4">
        <b>Kunci Jawaban</b> <br>
        '.$exam->getdataSoal("kunci",$i).'
        </div>
    </div>
    ';
    }
        echo'
        
        </p>
        </div>
        </td>


        </tr>';
    }
        echo'
        </tbody>
        </table>
        </div>
        <div class="card-footer">

        </div>

        </div>

        </div>';
    }
    public function main(){
        $id_ujian = act;
        $exam = new Ujian($id_ujian);
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
        $nama = $exam->getSingleData("nama_ujian");
        $open = $res->getSingleDataProgress("waktu_mulai");
        $close = $res->getSingleDataNilai("selesai");
        $openNew = new DateTime($open);
        $closeNew = new DateTime($close);
        $pg = $res->getSingleDataNilai("nilai");
        $isian = $res->getSingleDataNilai("essay");
        $b_pg = $res->getSingleDataNilai("jml_benar");
        $s_pg = $res->getSingleDataNilai("jml_salah");
        $k_pg = $res->getSingleDataNilai("jml_kosong");
        $b_isian = $res->getSingleDataNilai("benar_isian");
        $s_isian = $res->getSingleDataNilai("salah_isian");
        $k_isian = $res->getSingleDataNilai("kosong_isian");
        $durasi = $res->getSingleDataNilai("durasi");
        $jml_pg = $b_pg + $s_pg + $k_pg;
        $jml_isian = $b_isian + $s_isian + $k_isian;
        $jml_soal  = $jml_pg + $jml_isian;
        $nilai = $pg + $isian;
        $acc = floor((($b_pg + $b_isian)/($jml_soal))*100);
        $date = ''.$openNew->format('F d, Y H:i').' - '.$closeNew->format('F d, Y H:i').'';
        $auth = new AUTH(null,null);
        echo '
        <div class="container-ujian">
        <div class="row">
        <div class="col-md-3">
        <div class="card card-ujian">

        <div class="card-header">
        <b>
        <h4>Hasil Ujian</h4>
        </b>
        </div>
        <div class="card-header">
        <h4>Info Ujian</h4>
        '.$nama.'
        </div>
        <div class="card-header">
        <h4>Waktu Pengerjaan</h4>
        '.$date.'
        </div>
        <div class="card-header">
        <h4>Nilai</h4>
        <div class="bar-accurate">
        '.$nilai.'.00
        </div>
     
        </div>
        <div class="card-header">
        <h4>Durasi Pengerjaan</h4>
       
        <i class="fa fa-clock"></i> '.$durasi.'
        
        
        </div>

        <div class="card-footer">
        <a href="'.domain.'"><button class="btn btn-warning btn-block">Kembali</button></a>

        </div>
        </div>

        </div>
      ';
      $auth->AUTHVALRANK(function(){
            $this ->review();
      });
        echo'
</div>
        </div>
        ';

    }
}





?>