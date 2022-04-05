<?php
class Login{
    public function main(){
        echo '
     
        <div class="card-login col-md-3">
      <div class="container">
          
                <div id="auth-left">
                    <div class="auth-logo">
                     
                    </div>
                    <h1 class="auth-title">Log In</h1>
                    <p class="auth-subtitle mb-5">Silahkan masuk menggunakan username dan password</p>
        
                    <form enctype="multipart/form-data" id="form-login">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                           
                        </div>
                        <button class="btn btn-warning btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                        <div class="divider">
                            <div class="divider-text text-secondary">Belum Punya Akun?</div>
                        </div>
                        <a href="'.domain.'/register"><button type="button" class="btn btn-outline-primary btn-block" type="submit">Register</button></a>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
           
                    </div>
                </div>
           
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
        
                </div>
            </div>
     </div>
        </div>
        
        
        ';
    }
}



?>