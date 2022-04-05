<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Koneksi Database --+
// Please Donate Me https://abdanhafidz.com/donate
$server = 'localhost'; //server database ex:Localhost
$username = 'root'; //username database ex:root
$password = 'Fpi558585';//password database ex:12345
$name  = 'quzuu';//nama database ex:databasesaya
$db_con = mysqli_connect($server,$username,$password,$name);
mysqli_set_charset($db_con,"utf8mb4");