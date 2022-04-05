            <footer align="center">
               
                            <p>2021 &copy; <a href="https://abdanhafidz.com">Abdan Hafidz</a> Production </p>
                       
            </footer>
<script src="<?= domain ?>/_public/assets/vendors/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?= domain ?>/_public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= domain ?>/_public/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= domain ?>/_public/assets/js/pages/dashboard.js"></script>

<script src="<?= domain ?>/_public/assets/js/pages/horizontal-layout.js"></script>
<script src="<?= domain ?>/_public/assets/vendors/toastify/toastify.js"></script>
<script src="<?= domain ?>/_public/assets/vendors/fontawesome/all.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= domain ?>/_public/assets/js/custom.js"></script>

<?php
$modul = modul;

if($modul == "exam" && act!=''){
            echo '<script src="'.domain.'/_public/assets/js/exam.js"></script>';
}


?>