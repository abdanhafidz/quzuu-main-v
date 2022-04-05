<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Function PHP --+
// Please Donate Me https://abdanhafidz.com/donate
//[[[[[[ FUNCTION BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]
class module {
    public function Nav(){
                $menu = new Menu;
                $menu->Main();
    }
    public function home(){
                $dashboard = new Dashboard;
                $dashboard->main();
    }
    public function login(){
                $login = new Login;
                $login->main();
    }

    public function logout(){
                $_SESSION['id_peserta'] = "";
                echo '<script>window.location = "'.domain.'" </script>';
    }

    public function detail(){
         
            $detail = new Detail();
            $detail->main();
    }

    public function exam(){
            $exam = new Exam();
            $exam -> main();
    }

    public function process(){
            $process = new Process;
            $id_ujian = act;
            $process->submit($id_ujian);
    }

    public function result(){
            $result = new Hasil;
            $result->main();
    }

    public function rank(){
            $rank = new Rank;
            $rank->main();
    }
    public function register(){
            $register = new Register;
            $register->main();
    }
    public function cs(){
            echo '
            <div class="container col-lg-6 middle" align="center">

                <img src="'.domain.'/_public/assets/images/cs-01.png" style="width:300px"/>
                <br><br>
                <h3 align="center">Fitur Ini Akan Hadir</h3>
                <p align="center"> platform ini masih dalam tahap pengembangan untuk saat ini. Beberapa fitur mungkin tidak tersedia tapi pasti akan hadir beberapa hari mendatang.

            </div>
            
            ';
    }
}
