<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Konfigurasi Utama --+
// Please Donate Me https://abdanhafidz.com/donate
date_default_timezone_set('Asia/Jakarta');//setting zona waktu
define('domain','https://quzuu.id/app');//setting domain
define('modul',@url_basis(2));//setting index modul
define('act',@url_basis(3));//setting index act
define('dataurl',@url_basis(4));//setting index dataurl
function dataurl($i){

return url_basis($i+3);
}
define('paging',@url_basis(6));//setting index page tambahan
define('CURRENT_TIME',strtotime(date("Y-m-d H:i:s")));
    $modul = modul;
    switch($modul){
        case "":
            define('menu','');
            break;
            case "exam":
                define('menu','Ujian');
                break;
                case "detail":
                    define('menu','Detail Ujian');
                    break;
                    case "result":
                        define('menu','Hasil Ujian');
                        break;
                        case "rank":
                            define('menu','Peringkat Ujian');
                            break;
                        default:
                        define('menu','');
                        break;
                                
    }
?>
