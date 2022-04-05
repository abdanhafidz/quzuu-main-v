<?php
session_start();
include '../../../config/__dbconnection.php';
include '../../../fondasi/function/PHP/main.php';
include '../../../config/__main.inc.php';
include '../../../fondasi/model/auth.php';
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Ajax Rest --+
///Contoh : if(@$_GET['action']=='Aksi Ajax'){
       //ekspresi aksi CRUD dari data ajax yang diterima
///}

$req = mysqli_real_escape_string($db_con,@$_GET['req']);
       
       switch($req){
              case "login":
                            $username = mysqli_real_escape_string($db_con,@$_POST['username']);
                            $password = md5(mysqli_real_escape_string($db_con,@$_POST['password']));
                            $auth = new AUTH($username,$password);

                                   if(($auth->AUTH_USERNAME() && $auth->AUTH_PASSWORD()) || $auth->AUTH_EMAIL($username)){
                                          $_SESSION['id_peserta'] = $auth->ID_PESERTA();
                                          $_SESSION['id_group'] = $auth->ID_GROUP();
                                          echo 1;
                                   }else{
                                          if($auth->AUTH_USERNAME() && !$auth->AUTH_PASSWORD()){

                                                 echo '<b>Peringatan!</b> Password yang anda masukkan tidak dapat ditemukan';
                                               

                                          }else if(!$auth->AUTH_USERNAME() && $auth->AUTH_PASSWORD()){
                                                 echo '<b>Peringatan!</b> Username yang anda masukkan tidak dapat ditemukan';
                                          }else{
                                                 echo '<b>Peringatan!</b> Username dan Password yang anda masukkan tidak dapat ditemukan';
                                          }
                                   }

                     break;
           case "register":
                     $nama = mysqli_real_escape_string($db_con,@$_POST['nama']);
                     $email = mysqli_real_escape_string($db_con,@$_POST['email']);
                     $username = mysqli_real_escape_string($db_con,@$_POST['handle']);
                     $password = mysqli_real_escape_string($db_con,@$_POST['password']);
                     $sekolah = mysqli_real_escape_string($db_con,@$_POST['sekolah']);
                     $pass = md5($password);
                     $auth = new AUTH($username,$password);
                     if(!$auth->AUTH_USERNAME() && !$auth->AUTH_PASSWORD() ){
                            if(mysqli_num_rows(mysqli_query($db_con,"SELECT*FROM data_peserta_ujian WHERE email = '$email' "))<1){
                                   $action = mysqli_query($db_con,
                                   "INSERT INTO data_peserta_ujian
                                   SET 
                                   nama_lengkap = '$nama',
                                   username = '$username',
                                   password= '$pass',
                                   hash_password = '$password',
                                   id_group = 1,
                                   sekolah = '$sekolah',
                                   email = '$email'
                                   "
                                   ) or die($db_con->error);
                            if($action){
                                   echo 1;
                            }
                            
                            }else{
                                   echo 'Alamat email tersebut sudah digunakan!';
                            }

                     }else{
                            echo 'Username dan password sudah digunakan!';
                     }
                     break;
       }