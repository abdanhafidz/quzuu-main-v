<?php
class PS{
    public function card_ujian($id_ujian){
        global $db_con;
        $r =    mysqli_fetch_array(
                mysqli_query($db_con,
                "SELECT*FROM data_ujian WHERE id_ujian='$id_ujian' AND competition = '0' "
                )
                );
        $open = @$r['waktu_buka'];
        $close = @$r['waktu_tutup'];
        $openNew = new DateTime($open);
        $closeNew = new DateTime($close);
        $ujian = new Ujian($id_ujian);
        $date = ''.$openNew->format('F d, Y H:i').' - '.$closeNew->format('F d, Y H:i').'';
        $statusujian = $ujian->statusUjian();
        $statushasil = $ujian->statusUjianPeserta();
        $meth = "#";
        if($statushasil=="belum" || $statushasil == "run"){
        if($statusujian == "belum" || $statusujian == "closed"){
            $meth = "editorial/$id_ujian";
        }elseif($statusujian == "run"){
            $meth = "detail/$id_ujian";
        }
    }elseif($statushasil == "done"){
            $meth = "result/$id_ujian";
    }
        
        echo '
        <div class="col-lg-12 col-12">
        <a href="'.domain.'/'.$meth.'">
        <div class="card card-ujian">
        <div class="row">
        <div class="col-md-12">
                <div class="card-header card-dashboard ">
                
                    <h3>'.$r['nama_ujian'].'</h3>
                  <b class="text-secondary"><span class="bi bi-calendar-event-fill text-secondary"></span>  '.$date.'</b>
                    ';

                  

                    echo'
                   
                    ';
                    if($statushasil == "done"){
                        echo '<br> <br><a href="'.domain.'/rank/'.$id_ujian.'"><button class="btn btn-outline-secondary"><i class="fa fa-filter"></i> Scoreboard</button></a> &nbsp;  <a href="'.domain.'/result/'.$id_ujian.'"><button class="btn btn-outline-success"><i class="fa fa-list"></i> Lihat Hasil</button></a>';
                    }elseif($statusujian == "belum" || $statusujian == "closed"){
            			echo '<br><br><a href="'.domain.'/rank/'.$id_ujian.'"><button class="btn btn-outline-secondary"><i class="fa fa-filter"></i> Scoreboard</button></a> &nbsp; <a href="'.domain.'/editorial/'.$id_ujian.'"><button class="btn btn-warning"><i class="fa fa-edit"></i> Lihat Editorial</a>';
                    }
                    echo '
                </div>
           
            </div>
            </div>
            </div>
            </a>
        </div>
   
        ';
    }
    public function data_ujian(){
        global $db_con;
        $id_group = @$_SESSION['id_group'];
        $select = mysqli_query($db_con,
            "SELECT*FROM grouping_ujian WHERE id_group_ujian='$id_group' "
        );
        while($r = mysqli_fetch_array($select)){
        	 $k =    mysqli_fetch_array(
                mysqli_query($db_con,
                "SELECT*FROM data_ujian WHERE id_ujian='$r[id_ujian]' AND competition = '1' "
                )
                );
       		if($k['competition']== '1'){
            $this->card_ujian($r['id_ujian']);
            }
        }
    }
    public function main(){
        echo'
            <div class="content-wrapper container">

            <div class="page-heading">
           
            </div>

            <div class="page-content">
            <section class="row">
            <div class="col-md-8">
            <div class="col-lg-12 col-12">
            <div class="card-header ">
            <h5><i class="fa fa-edit"></i> Kontes Terbaru</h5>
            
            </div>
            </div>';
                $this->data_ujian();
                echo'
          
            </div>
            <div class="col-md-4">
        <div class="card-header">
        <h5><i class="fa fa-user"></i> Top Users</h5>
        </div>
        <div class="card card-ujian card-dashboard " align="center">
        <br>

        Yoohoo This Feature Will Be Appear Soon!
        <br>
        <br>
        </div>


            </div>
            </section>
            </div>
      
            </div>
         
       ';
    }
}

?>