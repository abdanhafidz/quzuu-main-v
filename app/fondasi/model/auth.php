<?php
class AUTH{
    public $username;
    public $password;
    public function __construct($username,$password){
            $this->username = $username;
            $this->password = $password;
    }
    public function AUTH_USERNAME(){
            global $db_con;
            $username = $this->username;
            $validate = mysqli_num_rows(mysqli_query($db_con,
            "SELECT*FROM data_peserta_ujian
            WHERE username = '$username'
            "
            )) ;

            if($validate > 0 ){
                return true;
            }else{
                return false;
            }
    }

    public function AUTH_PASSWORD(){
        global $db_con;
        $password = $this->password;
        $validate = mysqli_num_rows(mysqli_query($db_con,
        "SELECT*FROM data_peserta_ujian
        WHERE password = '$password'
        
        "
        ) );

        if($validate > 0 ){
            return true;
        }else{
            return false;
        }
        

}


public function AUTH_EMAIL($email){
    global $db_con;
    $validate = mysqli_num_rows(mysqli_query($db_con,
    "SELECT*FROM data_peserta_ujian
    WHERE email = '$email'
    
    "
    ) );

    if($validate > 0 ){
        return true;
    }else{
        return false;
    }
    

}
    public function ID_PESERTA(){
        global $db_con;
        $username = $this->username;
        $password = $this->password;
        if($this->AUTH_USERNAME() && $this->AUTH_PASSWORD()){
                $r = mysqli_fetch_array(mysqli_query($db_con,"SELECT*FROM data_peserta_ujian WHERE username='$username' AND password='$password' ")) or die($db_con->error);
                $id_peserta = $r['id_peserta_ujian'];
                return $id_peserta;
        }else{
            return false;
        }
    }

    public function ID_GROUP(){
        global $db_con;
        $username = $this->username;
        $password = $this->password;
        if($this->AUTH_USERNAME() && $this->AUTH_PASSWORD()){
                $r = mysqli_fetch_array(mysqli_query($db_con,"SELECT*FROM data_peserta_ujian WHERE username='$username' AND password='$password' ")) or die($db_con->error);
                $id_group = $r['id_group'];
                return $id_group;
        }else{
            return false;
        }
    }

    public function AUTHVAL($act){
         if(@$_SESSION['id_peserta']!=0 && @$_SESSION['id_peserta']!='') {
            $act();
        }else{
            $domain = domain;
            echo '<script>window.location="'.$domain.'/login"</script>';
        }
    }

    public function VALEXAM($id_ujian){
        global $db_con;
        $r = mysqli_fetch_array(
            mysqli_query($db_con,
            "SELECT*FROM grouping_ujian WHERE id_ujian = '$id_ujian' "
            
            )
        );
        if($r['id_group_ujian'] == $_SESSION['id_group']){
            return true;
        }else{
            return false;
        }
    }
    public function AUTHVALEXAM($act){
        $id_ujian = @act;
        $exam = new Ujian($id_ujian);

        if($this->VALEXAM($id_ujian) && $exam->statusUjian()!='closed' && $exam->statusUjianPeserta()!='done' && $exam->statusUjian()!="belum"){
            $act();
        }else{
            $domain = domain;
            echo '<script>window.location="'.$domain.'"</script>';
        }
    }

    public function AUTHVALRESULT($act){
        $id_ujian = @act;
        $exam = new Ujian($id_ujian);
        if($this->VALEXAM($id_ujian) && $exam->statusUjianPeserta()=='done'){
            $act();
        }else{
            $domain = domain;
            echo '<script>window.location="'.$domain.'"</script>';
        }
    }
    public function AUTHVALRANK($act){
        $id_ujian = @act;
        $exam = new Ujian($id_ujian);
        $status = $exam->statusUjian();
        if($exam->getSingleData("status")){
            $act();
        }else{
            echo '<div class="col-lg-9 col-12">
            <div class="card card-review">
            <div class="card-header">
           
            </div>
            <div class="card-body list-review">
            <div class="container" align="center">
            <br>
            <br>
            <h4 class="text-white"><i class="fa fa-lock"></i> Review soal dikunci</h4>
            <p class="text-white">Review soal mungkin ditampilkan kemudian hari berikutnya</p>
            </div>
            </div>
            <div class="card-footer">
           
            </div>
            </div>';
        }
       
    }
}

?>