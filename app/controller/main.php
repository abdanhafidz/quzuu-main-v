<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Kontrolisasi Penambahan Library/Files --+
// Please Donate Me https://abdanhafidz.com/donate

//inklud files yang ingin anda gabungkan di sini
session_start();

//[[[[[[ INKLUD FILE BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]



include 'config/__dbconnection.php';
include 'fondasi/function/PHP/main.php';
include 'config/__main.inc.php';
include 'fondasi/model/auth.php';
include 'fondasi/model/peserta.php';
include 'fondasi/model/result.php';
include 'fondasi/model/exam.php';
include 'modul/menu.php';
include 'modul/dashboard.php';
include 'modul/login.php';
include 'modul/detail.php';
include 'modul/exam.php';
include 'modul/process.php';
include 'modul/result.php';
include 'modul/rank.php';
include 'modul/register.php';
include 'modul/all.php';


//[[[[[[ INKLUD FILE BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]



?>