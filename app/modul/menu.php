<?php
class Menu{
    public function main(){
        $menu = menu;
        $id_peserta = @$_SESSION['id_peserta'];
        $peserta = new Peserta("WHERE id_peserta_ujian='$id_peserta' ");

        echo '
        <header class="mb-5">
        <div class="header-top">
            <div class="container">
          
                    <a href="'.domain.'"><img src="https://abdanhafidz.com/qb/_public/assets/quzzulogo.png" alt="Logo" srcset="" style="width:100px"></a>
                    <ul class="navigasi">
                    <li class="navg-item">
                    <a class="navg-link" href="'.domain.'/contest">
                    Contest
                    </a>
                    <div class="nav-decor"></div>
                    </li>
                    <li class="navg-item">
                    <a class="navg-link" href="'.domain.'/problemset">
                    Problemset
                    </a>
                    </li>
                    <li class="navg-item">
                    <a class="navg-link" href="'.domain.'/materials">
                    Materials
                    </a>
                    </li>
                    <li class="navg-item">
                    <a class="navg-link" href="'.domain.'/leaderboard">
                    Leaderboard
                    </a>
                    </li>
                    <li class="navg-item">
                    <a class="navg-link" href="'.domain.'/shop">
                    Shop
                    </a>
                    </li>
                    </ul>
                    <div class="header-top-right">
';
if(@$_SESSION['id_peserta']!=''){echo '
                    <div class="dropdown">
                        <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar avatar-md2" >
                                <img src="'.domain.'/_public/assets/images/faces/1.jpg" alt="Avatar">
                            </div>
                            <div class="text">
                                <h6 class="user-dropdown-name">'.@$peserta->getSingleData("nama").'</h6>
                                <p class="user-dropdown-status text-sm text-muted">Member</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                  
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="'.domain.'/logout">Logout</a></li>
                        </ul>
                    </div>
                    ';
                }
                        echo'
                    <!-- Burger button responsive -->
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-navbar">
                    <div class="container">
                    <ul class="">
                    <li class="menu-item">
                    <a class="navg-link" href="'.domain.'/contest">
                    Contest
                    </a>
                    </li>
                    <li class="menu-item">
                    <a class="navg-link" href="'.domain.'/problemset">
                    Problemset
                    </a>
                    </li>
                    <li class="menu-item">
                    <a class="navg-link" href="'.domain.'/materials">
                    Materials
                    </a>
                    </li>
                    <li class="menu-item">
                    <a class="navg-link" href="'.domain.'/leaderboard">
                    Leaderboard
                    </a>
                    </li>
                    <li class="menu-item">
                    <a class="navg-link" href="'.domain.'/shop">
                    Shop
                    </a>
                    </li>
                    </ul>

                    </div>


            </div>
      
    </header>

        ';
        
    }
}




?>