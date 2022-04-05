<?php
class Exam{
    
    public function __construct(){
    $id_ujian = act;
   
    $exam = new Ujian($id_ujian);
    $exam->create_progress();
    }
    public function timer(){

    }
    public function xmJawaban(){
        $id_ujian = act;
        $id_peserta = @$_SESSION['id_peserta'];
        $id_group = @$_SESSION['id_group'];
        $exam = new Ujian($id_ujian);
        $res = new Result("","",$id_ujian,$id_group);
        $jml_soal = mysqli_num_rows($exam->selectSoal());
       
        echo '
        <div style="display:none" id="data-jawaban">';
            for($i=1;$i<=$jml_soal;$i++){
                echo '
                <div id="jawaban-'.$i.'">'.$res->getJawaban($i).'</div>
                ';
            }

        echo '
        </div>
        
        ';
    }
    public function listnomor(){
        global $db_con;
        $id_ujian = @act;
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
        $jum_soal = mysqli_num_rows(
            mysqli_query(
                $db_con,
                "SELECT*FROM data_soal WHERE id_ujian='$id_ujian' "
            )
            );
        for($i = 1;$i<=$jum_soal;$i++){
            $jwb = $res->getJawaban($i);
            if($jwb!=0){
                $classPlus = 'nomor-soal-answered';
            }else{
                $classPlus = '';
            }
            echo '<div class="nomor-soal '.$classPlus.'" data-next="'.$i.'" id="list-nomor-'.$i.'">'.$i.'</div>';
        }
    }

    public function cardSoal(){
        $id_ujian = @act;
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
        echo' <div class="col-md-8">
        <input type="hidden" id="batas_waktu" value="'.$res->getSingleDataProgress("batas_waktu").'" />
        <div class="card ">
        <div class="card-header card-timer">
        <div class="timer">
<b  ><i class="fa fa-clock" align="center"></i> Sisa Waktu <span id="timer">
    </span>
    </div>
       </b>
        </div>
        <div class="card-body">
        <div style="display:none">

        <div id="id_ujian">'.$id_ujian.'</div>
        <div id="id_peserta">'.$_SESSION['id_peserta'].'</div>

        </div>
        <br>
       <h3 align="left">#Question <span id="no-soal"></span></h3>
       <p align="justify" id="soal">
        
       </p>
    
       </ol>


       </p>
        </div>
        <div class="card-footer">
        
       
        ';
            echo'
        <div class="row">
        <div class="col-lg-12" style="display:inline-block" id="isian">
            <p style="font-size:11pt">Answer : </p>
            <input type="text" class="form-control" id="input-isian" />
            <div id="label-change-isian"></div>
        </div>
        <div class="col-lg-12" style="display:inline-block" id="pilihan-a">

        <div class="form-check">
        <input class="form-check-input" type="radio" value="1" name="pilihan" id="radio-a">
        <label class="form-check-label" for="radio-a" id="opsi-a">
         
        </label>
        </div>

        </div>

  

        <div class="col-lg-12" style="display:inline-block" id="pilihan-b">

        <div class="form-check">
        <input class="form-check-input" type="radio" value="2" name="pilihan" id="radio-b">
        <label class="form-check-label" for="radio-b" id="opsi-b">
            
        </label>
        </div>

        </div>

     

        <div class="col-lg-12" style="display:inline-block" id="pilihan-c">

        <div class="form-check">
        <input class="form-check-input" type="radio" name="pilihan" value="3" id="radio-c">
        <label class="form-check-label" for="radio-c" id="opsi-c">
            
        </label>
        </div>

        </div>

    

        <div class="col-lg-12" style="display:inline-block"  id="pilihan-d" >

        <div class="form-check">
        <input class="form-check-input" type="radio" name="pilihan" value="4" id="radio-d">
        <label class="form-check-label" for="radio-d" id="opsi-d">
           
        </label>
        </div>

        </div>

  

        <div class="col-lg-12" style="display:inline-block" id="pilihan-e">

        <div class="form-check">
        <input class="form-check-input" type="radio" name="pilihan" value="5" id="radio-e">
        <label class="form-check-label" for="radio-e" id="opsi-e">
            
        </label>
        </div>

        </div>

        
        </div>
        <br>

       <div class="row">
       <div class="col-md-4  btn-prev">
        <button class="btn btn-prev-next" id="previous"> <i class="fa fa-arrow-circle-left"></i>Previous</button>
        </div>
        <div class="col-md-4 btn-reset">
        <div id="reset_jawaban" style="display:none">
        <div class="text-info reset-btn">
        <i class="fa fa-times"></i>  Batalkan Jawaban
        </div>
        </div>
        </div>
        <div class="col-md-4 btn-next">
        <button class="btn btn-prev-next " id="next">Next  <i class="fa fa-arrow-circle-right"></i></button>
        </div>
</div>
        </div>';
         
        echo'
        
        </div>
     
        <br>
        <br>
        </div>

        <div class="col-md-4">
        <div class="card">
        <div class="card-header">
        <h5><i class="fa fa-list"></i> Navigasi Soal</h5>
        </div>
        <div class="card-body">
        <br>
        <br>
        '; $this->listnomor() ;
        echo'
        </div>
        <div class="card-footer">
        <button class="btn btn-selesai btn-block" id="finish" data-finish = "true">Selesai <i class="fa fa-check"></i> </button>
        </div>
        </div>

        </div>
        </div>
        </div>
       ';

    }
    

   

    public function main(){
        global $db_con;
        $id_ujian = @act;
        $nsoal = mysqli_num_rows(
            mysqli_query(
                $db_con,
                "SELECT*FROM data_soal WHERE  id_ujian= '$id_ujian' "
            )
        );
        echo '
        <style>
        body{
         
          
        }
        </style>
       
        <div class="content-wrapper container-ujian">

        <div class="page-heading" align="center">
       
        
        </div>

        <div class="page-content">
        <section class="row">';
      
            $this->cardSoal();


        echo '
        
        </section>
       
        </div>
        </div>';

        $this->xmJawaban();
        
        
    }
}




?>