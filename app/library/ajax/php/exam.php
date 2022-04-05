<?php
session_start();
include '../../../config/__dbconnection.php';
include '../../../fondasi/function/PHP/main.php';
include '../../../config/__main.inc.php';
include '../../../fondasi/model/auth.php';
include '../../../fondasi/model/exam.php';
include '../../../fondasi/model/result.php';
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Ajax Rest --+

$req = @$_GET['req'];
    switch($req){
        case "soal":
                $id_ujian = mysqli_real_escape_string($db_con,@$_POST['id_ujian']);
                $id_peserta = mysqli_real_escape_string($db_con,@$_POST['id_peserta']);
                $exam = new Ujian($id_ujian);
                $n_soal = mysqli_num_rows(
                    mysqli_query($db_con,
                    "SELECT*FROM data_soal WHERE id_ujian = '$id_ujian' "
                    
                    )
                );

                for($i = 1;$i<=$n_soal;$i++){
                    $soal['soal'][$i]   = $exam->getdataSoal("soal",$i);
                    $soal['a'][$i]      = $exam->getdataSoal("a",$i);
                    $soal['b'][$i]      = $exam->getdataSoal("b",$i);
                    $soal['c'][$i]      = $exam->getdataSoal("c",$i);
                    $soal['d'][$i]      = $exam->getdataSoal("d",$i);
                    $soal['e'][$i]      = $exam->getdataSoal("e",$i);
                    $soal['tipe'][$i]   = $exam->getdataSoal("tipe",$i);
                }
                
                $data = json_encode($soal);
                echo $data;
            break;
        case "jwb":
            $id_group = @$_SESSION['id_group'];
            $id_ujian = mysqli_real_escape_string($db_con,@$_POST['id_ujian']);
            $jwb = mysqli_real_escape_string($db_con,@$_POST['jwb']);
            $no = mysqli_real_escape_string($db_con,@$_POST['no']);
            $res = new Result("","",$id_ujian,$id_group);
            if($res->updateJawaban($no,$jwb)){
                echo 1;
            }else{
                echo 'Gagal dalam update jawaban';
            }
            break;
    }

?>