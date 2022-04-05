<?php
class Peserta{
    public $validation;

    public function __construct($validation=""){
        $this->validation = $validation;
    }

    public function select(){
        global $db_con;
        $validation = $this->validation;
        return mysqli_query($db_con,"SELECT*FROM data_peserta_ujian $validation ");
    } 

    public function getSingleData($req = ""){
        global $db_con;
        $sel = $this->select();
        $r = mysqli_fetch_array($sel);
        switch($req){
            case "":
                return false;
                break;
            case "id_peserta":
                return $r['id_peserta_ujian'];
                break;
            case "nama":
                return $r['nama_lengkap'];
                break;
            case "username":
                return $r['username'];
                break;
            case "password":
                return $r['password'];
                break;
            case "hash_password":
                return $r['hash_password'];
                break;
            case "id_group":
                return $r['id_group'];
                break;
            case "email":
                return $r['email'];
                break;
            case "sekolah":
                return $r['sekolah'];
                break;
            case "telp":
                return $r['telp'];
                break;
            case "provinsi":
                return $r['provisi'];
                break;
            case "kota":
                return $r['kota'];
                break;
            case "status":
                return $r['status'];
                break;
        }
    }

}
?>