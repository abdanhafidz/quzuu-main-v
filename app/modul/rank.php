<?php
class Rank{
    public function main(){
        $id_ujian = act;
        $exam = new Ujian($id_ujian);
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
     
        $nama = $exam->getSingleData("nama_ujian");
        echo ' <div class="col-md-8 middle">
        <div class="card card-ujian">

        <div class="card-header">
        <h3><i class="fa fa-trophy"></i> Scoreboard</h4>
        <h4 class="text-muted">'.$nama.'</h4>
        </div>
        <div class="card-body">
       <table class="table table-hover table-responsive data-tables table-bordered table-rank">
        <thead>
        <th>#</th>
        <th>Nama Peserta</th>
        <th>Asal Sekolah</th>
        <th>Durasi</th>
        <th>P.Ganda</th>
        <th>Isian</th>  
        <th>Total</th>
        </thead>
        <tbody>';
        $i = 1;
        $s = $res->rankedlist();

        while($r = mysqli_fetch_array($s)){
            $id_peserta = $r['id_peserta'];
            $peserta = new Peserta("WHERE id_peserta_ujian = '$id_peserta' ");
            $nama = $peserta->getSingleData("nama");
            $sekolah = $peserta->getSingleData("sekolah");
            $pg = $r['pg'];
            $isian  = $r['essay'];
            $nilai = $r['nilai'];
            $durasi  = $r['durasi'];

            echo '
            <tr>
            <td>
            '.$i.'
            <td>
           '.$nama.'
            </td>
            <td>
            '.$sekolah.'
            </td>
            <td>
            '.$durasi.'
            </td>
            <td>
            '.$pg.'
            </td>
            <td>
            '.$isian.'
            </td>
            <td>
            '.$nilai.'
            </td>

            </tr>
            
            ';
            $i++;
        }







echo'
        </tbody>

       </table>
        
        </div>
        <br>
     
        </div>

      
        </div>

        </div>';
       
        
    
    }

}



?>