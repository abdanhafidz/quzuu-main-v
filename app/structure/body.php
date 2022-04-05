<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Function PHP --+

//[[[[[[ FUNCTION BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]
$main = new module;
$modul = modul;
$auth = new AUTH(null,null);
$menu = "";

echo '   <div id="app">
         <div id="main" class="layout-horizontal">';
         if($modul!='process'){
            $main->Nav();
         }
            switch($modul){
               
            case "contest":
               $auth->AUTHVAL(function(){
                  global $main;
                  $main->home();
               }
               );
            break;
            case "detail":
               $auth->AUTHVAL(function(){
                     global $auth;
               $auth->AUTHVALEXAM(function(){
                     global $main;
                     $main->detail();
                  });
               });
            break;
            case "exam":
            $auth->AUTHVAL(function(){
                  global $auth;
            $auth->AUTHVALEXAM(function(){
                  global $main;
                  $main->exam();
               });
            });
            break;
            case "login":
               $main->login();
            break; 

            case "logout":
               $main ->logout();
            break;

            case "process":
               $auth->AUTHVAL(function(){
                  global $auth;
            $auth->AUTHVALEXAM(function(){
                  global $main;
                  $main->process();
               });
            });
            break;
            case "result":
               $auth->AUTHVAL(function(){
                  global $auth;
               $auth->AUTHVALRESULT(function(){
                  global $main;
               $main ->result();
               });
            });
            break;
            case "rank":
             
               $auth->AUTHVAL(function(){
                  global $auth;
               
                  global $main;
               $main ->rank();
          
         });
            break;
            case "register":
               $main ->register();
               break;
            default:
            $auth->AUTHVAL(function(){
               global $main;
            $main->cs();
            });
            break;

      }
         echo '
         </div>
         </div>'
?> 