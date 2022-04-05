<?php
class Group{
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
                            
    }
}



?>