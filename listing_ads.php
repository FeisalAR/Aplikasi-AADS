<!DOCTYPE html>
<html lang="en">

<head>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/popper.js"></script>
    <link rel="stylesheet" type="text/css" href='css/bootstrap.css' />
    <link rel="stylesheet" type="text/css" href='css/style.css' />
    <link rel="stylesheet" href='css/all.css' />
    <script src="js/script.js"></script>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing ADS - Aplikasi AADS</title>
</head>

<body>

    <img class="dnapic" src="images/dnabg.png" alt="dnapic">
    <div class="container-fluid">
        <!-- Horizontal Navbar -->
        <div class="nav-wrapper">
            <nav class="navbar navbar-expand-lg navbar-toggleable-lg hnavbar">
                <div class="row buttonlogo">
                    <div class="col togglebutton">
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                            data-target="#HnavbarToggler">
                            <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Brand -->
                        <a class="navbar-brand navbar-nav navbar-collapse" href="index.php">
                            <img src="images/logo.png" alt="Logo">
                        </a>
                    </div>


                </div>


                <div class="collapse navbar-collapse" id="HnavbarToggler">
                    <!-- Links -->
                    <ul class="userHmenu navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hactive" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola
                                ADS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listing_program.php"><i class="icon fas fa-tasks"></i>Kelola
                                Program</a>
                        </li>
                    </ul>

                    <!-- <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                    </ul> -->

                    <!-- Search form -->
                    <form class="form-inline ml-auto navbar-nav navbar-collapse">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 red-border" type="text" placeholder="Cari ADS..."
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search text-grey"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>

                    <ul class="userlogin navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php"><i
                                    class="icon fas fa-user-plus"></i>Registrasi</a>
                        </li>
                    </ul>
                    <!-- <ul class="userlogout navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon fas fa-sign-out-alt"></i>Log Out</a>
                        </li>
                    </ul> -->


                </div>


            </nav>
        </div>
    </div>
    <!-- End of Horizontal Navbar -->

    <div class="vnavcontent row">
        <div class="col-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    <ul class="userVmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i><span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="program_individu.php" class="nav-link">
                                <i class="icon far fa-address-book"></i><span class="vmenutext">Program
                                    Individu Saya</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="detail_program_individu.php" class="nav-link">
                                <i class="icon far fa-calendar-check"></i><span class="vmenutext">Detail Program &
                                    Catatan Harian</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="laporan_capaian.php" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Laporan Capaian</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="guestVmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing ADS</span>
                            </a>
                            <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil ADS</span>
                            </a>
                        </li> -->
                    </ul>


                </nav>
            </div>
            <!-- End of vertical navbar -->
        </div>

        <!-- Main content container -->
        <div class="col">
            <div class="container-fluid">
                <main>
                    <div class="row">
                        <!-- Form Title -->
                        <div class="col">
                            <h1>Listing ADS</h1>
                        </div>
                    </div>


                    <!-- Form fields -->
                    <div class="row">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <div class="card-header p-0">
                                                    <ul class="pull-right m-0">
                                                        <li class="mt-2">

                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="row search-div" style="display: block;">
                                                    <div class="col-md-12 col-12">
                                                        <div class="search-input">
                                                            <input type="text" class="form-control rounded-0"
                                                                placeholder="&#xF002;   Cari Nama atau Kode ADS..."
                                                                aria-label="Recipient's username"
                                                                style="font-family: Montserrat, FontAwesome;"
                                                                aria-describedby="basic-addon2" id="user-list-search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group" id="user-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-md-4 col-4 user-img text-center pt-1">
                                                                        <img src="http://nicesnippets.com/demo/cs-image2.png"
                                                                            alt="Seth Frazier"
                                                                            class="img-responsive img-circle rounded-circle" />
                                                                    </div>
                                                                    <div class="col-md-8 col-8">
                                                                        <h5 class="font-weight-bold mb-1 namaads">Nick
                                                                            Daniel
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0  bdads"><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i> 10/03/2019
                                                                            </p>
                                                                            <p class="m-0"><i class="fas fa-mars mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Laki-laki</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-user-friends mr-1 ortuads"></i>Nama
                                                                                Orang Tua</p>
                                                                            <p class="m-0  kodeads"><i
                                                                                    class="fas fa-key mr-1"></i>ADS001
                                                                            </p>
                                                                            <a href="profil_ads.php?id_ads=ADS001">
                                                                                <button
                                                                                    class="btn btndetail text-white">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Profil
                                                                                </button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-md-4 col-4 user-img text-center pt-1">
                                                                        <img src="http://nicesnippets.com/demo/cs-image6.jpg"
                                                                            alt="Debbie Schmidt"
                                                                            class="img-responsive img-circle rounded-circle" />
                                                                    </div>
                                                                    <div class="col-md-8 col-8">
                                                                        <h5 class="font-weight-bold mb-1 namaads">Debbie
                                                                            Scoomin
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0  bdads"><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i> 23/08/2017
                                                                            </p>
                                                                            <p class="m-0"><i class="fas fa-venus mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Perempuan</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-user-friends mr-1  ortuads"></i>Maximillian
                                                                                Scoomin</p>
                                                                            <p class="m-0 kodeads"><i
                                                                                    class="fas fa-key mr-1"></i>ADS002
                                                                            </p>
                                                                            <a href="profil_ads.php?id_ads=ADS002">
                                                                                <button
                                                                                    class="btn btndetail text-white">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Profil
                                                                                </button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-md-4 col-4 user-img text-center pt-1">
                                                                        <img src="http://nicesnippets.com/demo/cs-image3.jpg"
                                                                            alt="Debbie Schmidt"
                                                                            class="img-responsive img-circle rounded-circle" />
                                                                    </div>
                                                                    <div class="col-md-8 col-8">
                                                                        <h5 class="font-weight-bold mb-1 namaads">John
                                                                            Tokio
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0 bdads"><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i> 23/08/2017
                                                                            </p>
                                                                            <p class="m-0"><i class="fas fa-venus mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Perempuan</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-user-friends mr-1  ortuads"></i>Kioto
                                                                                Tokio</p>
                                                                            <p class="m-0  kodeads"><i
                                                                                    class="fas fa-key mr-1"></i>ADS003
                                                                            </p>
                                                                            <a href="profil_ads.php?id_ads=ADS003">
                                                                                <button
                                                                                    class="btn btndetail text-white">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Profil
                                                                                </button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-md-4 col-4 user-img text-center pt-1">
                                                                        <img src="http://nicesnippets.com/demo/cs-image7.jpg"
                                                                            alt="Debbie Schmidt"
                                                                            class="img-responsive img-circle rounded-circle" />
                                                                    </div>
                                                                    <div class="col-md-8 col-8">
                                                                        <h5 class="font-weight-bold mb-1 namaads">Glenda
                                                                            Favier
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0 bdads"><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i> 23/08/2017
                                                                            </p>
                                                                            <p class="m-0"><i class="fas fa-venus mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Perempuan</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-user-friends mr-1  ortuads"></i>Limmy
                                                                                Favier</p>
                                                                            <p class="m-0  kodeads"><i
                                                                                    class="fas fa-key mr-1"></i>ADS004
                                                                            </p>
                                                                            <a href="profil_ads.php?id_ads=ADS001">
                                                                                <button
                                                                                    class="btn btndetail text-white">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Profil
                                                                                </button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- Main Container end -->

                </main>
            </div>
        </div>
    </div>
    </div>
</body>


</html>
