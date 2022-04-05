<?php
class Register{
    public function main(){
        echo '
        <div class="container-ujian">
        <div class="row">
        <div class="col-md-5 middle">
        <form id="register" enctype="multipart/form-data">
        <div class="card card-ujian">
        <div class="card-header">
        <h4><i class="fa fa-user"></i> Sign Up Your Account</h4>
        </div>
        <div class="card-body">
        <br>
        <br>
        <div class="container">
        <div class="row">   

        <div class="col-md-4">
        <b>Nama Lengkap</b>
        </div>
        <div class="col-md-8">
        <input type="text" name="nama" class="form-control" placeholder="nama lengkap anda" required />
        </div>
        <br><br><br>
        <div class="col-md-4">
        <b>Sekolah/Instansi Asal</b>
        </div>
        <div class="col-md-8">
        <input type="text" name="sekolah" class="form-control" placeholder="asal sekolah" required/>
        </div>
        <br><br><br>
        <div class="col-md-4">
        <b>Alamat Email</b>
        </div>
        <div class="col-md-8">
        <input type="email" name="email" class="form-control" placeholder="your email" required/>
        </div>
        <br><br><br>
        <div class="col-md-4">
        <b>Buat Username</b>
        </div>
        <div class="col-md-8">
        <input type="text" name="handle" class="form-control" placeholder="create an username" required/>
        </div>
        <br><br><br>
        <div class="col-md-4">
        <b>Buat Password</b>
        </div>
        <div class="col-md-8">
        <input type="password" name="password" class="form-control" placeholder="create your safekey" required/>
        <span style="font-size:9pt" class="text-secondary">Password terdiri dari kombinasi huruf dan angka, misalnya : abdan123</span>
        </div>
        <br><br><br>
        <div class="col-md-4">
        <b>Konfirmasi Password</b>
        </div>
        <div class="col-md-8">
        <input type="password" name="password_confirm" class="form-control" placeholder="confirm" required/>
        </div>


        </div>
        </div>
        </div>
        <div class="card-footer">
        <div class="container">
        <button class="btn btn-primary" type="submit">Register Account</button>
        </div>
        </div>

        </div>
        </form>
        </div>
        </div>
        </div>
        ';
    }
}




?>