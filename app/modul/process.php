<?php
class Process{
    public function submit($id_ujian){
        global $db_con;
        $id_group = @$_SESSION['id_group'];
        $res = new Result("","",$id_ujian,$id_group);
        $id_peserta = @$_SESSION['id_peserta'];
        if($res->submitProgress()){
            echo '<script>window.location="'.domain.'"</script>';
        }else{
            echo '<script>Toastify({
                text: "Terjadi Masalah dalam mengirim jawaban. Periksa koneksi internet anda lalu refresh halaman!",
                duration: 5000,
                close:true,
                gravity: "bottom"
                position: "center",
                backgroundColor: "rgb(223, 71, 89)",
            }).showToast();
    
           }

        }
      });</script>';
        }
    }
}




?>