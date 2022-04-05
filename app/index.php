<?php
// © 2021 www.adanz.com - AdanZ Framework By Abdan Hafidz .
// Created With Love By Abdan Hafidz
// +-- Function PHP --+
// Please Donate Me https://abdanhafidz.com/donate
//[[[[[[ FUNCTION BERIKUT ADALAH DEFAULT DIMOHON UNTUK TIDAK DIRUBAH ]]]]]]
include 'controller/main.php';

?>
<?php


        ?>
<html>
    <head>
        <?php 
        include 'structure/head.php';
        ?>
        </head>
        <?php
        $modul = modul;
        ?>
        <body <?php if($modul == "detail" || $modul == "result") echo 'class="body-primary"'; ?>>

<?php 
        include 'structure/body.php';
        ?>
    

<?php 
        include 'structure/footer.php';
        ?>

</body>
</html>
<?php

?>