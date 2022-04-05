<?php

// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Function PHP --+
// Please Donate Me https://abdanhafidz.com/donate
//[[[[[[ FUNCTION BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]
function url_basis($no){
    $request = explode('/',$_SERVER['REQUEST_URI']);

return $request[$no];
}
function desc_abdan20($key,$text){
    $value = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($text)))))));
return $value ;
}
function dec_abdan20($txt){
    $data= desc_abdan20('11082005',$txt);
     return  $data;
  }

  function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

function acak(){
    $string = rand(1,1000);
$value =substr(md5($string),rand(1,10),5);
     return $value;
}




function enc_abdan20($text){
    $value = base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($text)))))));

return $value;


}


function RouteAdd($modul,$load){

$mod = modul;
     switch($mod){
         case $modul:
            echo $load;
            break;
     }


}
//[[[[[[ FUNCTION BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]





