<?php

class Detail{
    
    public function card_ujian(){
        $id_ujian = @act;
        $exam = new Ujian($id_ujian);
        echo '
        
        <div class="col-md-8 middle">
        <div class="card card-ujian">

        <div class="card-header">
       <h3 align="center">Petunjuk Pengerjaan</h3>
       <p>
       <ol type="1">
        <li>Kerjakanlah soal dengan cara membaca secara 
        keseluruhan pertanyaan lalu memilih jawaban yang benar di antara pilihan A,B,C,D, dan atau E untuk tipe pilihan 
        ganda dan mengisi jawaban pada kolom isian untuk tipe soal isian singkat dengan mengikuti petunjuk format jawaban yang tertera
        </li>
        <li>
        Perhatikan batas waktu pengerjaan beserta bobot penilaian yang telah ditetapkan dan kerjakanlah dengan menjunjung tinggi kejujuran
        </li>
        <li>
        Segala bentuk aktivitas kecurangan dalam bentuk apapun yang terdeteksi oleh sistem ataupun di luar sistem akan dikenakan sanksi
        berupa pemberian nilai kosong pada hasil ujian dan diskualifikasi
        </li>
        <li>
        <h5>Durasi Pengerjaan</h5>
        <p>'.$exam->getSingleData("durasi").'</p>
        </li>

       </ol>


       </p>
        </div>
        <div class="card-footer">
     


       
        </div>
        </div>

       
        </div>
        <div class="col-md-8 middle">
        <br>
        <a href="'.domain.'/exam/'.$id_ujian.'"><button class="btn btn-warning btn-block">
        Mulai

        </button>
        </a>
        </div>
        ';
    }
    public function main(){
        $id_ujian = act;
        $exam = new Ujian($id_ujian);
        echo '
        <div class="content-wrapper container col-md-12 middle">

        <div class="page-heading">

        <h3 class="text-white"> <i class="fa fa-book"></i> '.$exam->getSingleData("nama_ujian").'</h3>
        </div>

        <div class="page-content">
        <section class="row">
        ';
        $this->card_ujian();
        echo'
        </section>
        </div>

        </div>
        ';
    }
}

?>