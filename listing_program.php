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
    <title>Listing Program - Aplikasi AADS</title>
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
                            <a class="nav-link" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola ADS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hactive" href="listing_program.php"><i
                                    class="icon fas fa-tasks"></i>Kelola Program</a>
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

                    <!-- <ul class="userlogin navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon fas fa-sign-in-alt"></i>Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php"><i
                                    class="icon fas fa-user-plus"></i>Registrasi</a>
                        </li>
                    </ul> -->
                    <ul class="userlogout navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon fas fa-sign-out-alt"></i>Log Out</a>
                        </li>
                    </ul>


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
                    <ul class="programVmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_program.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        <li class="nav-item">
                            <a href="tambah_program.php" class="nav-link">
                                <i class="icon far fa-plus-square"></i><span class="vmenutext">Tambah Program</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_program.php" class="nav-link">
                                <i class="icon far fa-edit"></i><span class="vmenutext">Edit Program</span>
                            </a>
                        </li>
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
                            <h1>Listing Program</h1>
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
                                                <div class="row programfilters">

                                                    <div class="col-md-8">
                                                        <label class="font-weight-bold">Status:</label>
                                                        <div class="form-group filterstatusprogram mb-0">
                                                            <label class="radio-inline mr-2"><input type="radio"
                                                                    name="radiofilterstatus" value="Semua"
                                                                    checked>Semua</label>
                                                            <label class="radio-inline mr-2"><input type="radio"
                                                                    name="radiofilterstatus"
                                                                    value="Pending">Pending</label>
                                                            <label class="radio-inline mr-2"><input type="radio"
                                                                    name="radiofilterstatus"
                                                                    value="Selesai">Selesai</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row search-div" style="display: block;">
                                                    <div class="col-md-12 col-12">
                                                        <div class="search-input">
                                                            <input type="text" class="form-control rounded-0"
                                                                placeholder="&#xF002;   Cari Kode Program atau Nama ADS..."
                                                                aria-label="Recipient's username"
                                                                style="font-family: Montserrat, FontAwesome;"
                                                                aria-describedby="basic-addon2"
                                                                id="program-list-search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group" id="program-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">

                                                                    <div class="col-md-12 col-12">
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Mengenal Warna
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0 text-warning status"><i
                                                                                    class="fas fa-hourglass-half"
                                                                                    aria-hidden="true"></i>
                                                                                <b>Pending</b>
                                                                            </p>
                                                                            <p class="m-0  targetdate"><i
                                                                                    class="fas fa-calendar mr-1"
                                                                                    aria-hidden="true"></i> 11/06/2020
                                                                            </p>
                                                                            <p class="m-0 namaads"><i
                                                                                    class="fas fa-user mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Nick Daniel | ADS001</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-bullseye mr-1 sasaran"></i>Dapat
                                                                                mengenal berbagai warna dalam lingkungan
                                                                                sekitar</p>

                                                                            <p class="m-0 kodeprogram"><i
                                                                                    class="fas fa-key mr-1"></i>P001
                                                                            </p>
                                                                            <a
                                                                                href="detail_program_individu.php?id_program=P001">
                                                                                <button class="btn btndetail">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Detail
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

                                                                    <div class="col-md-12 col-12">
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Mengenal Angka
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0 text-success status"><i
                                                                                    class="fas fa-check"
                                                                                    aria-hidden="true"></i>
                                                                                <b>Selesai</b>
                                                                            </p>
                                                                            <p class="m-0  targetdate"><i
                                                                                    class="fas fa-calendar mr-1"
                                                                                    aria-hidden="true"></i> 11/06/2020
                                                                            </p>
                                                                            <p class="m-0 namaads"><i
                                                                                    class="fas fa-user mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Glenda Favier | ADS004</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-bullseye mr-1 sasaran"></i>Dapat
                                                                                mengenal berbagai angka dalam lingkungan
                                                                                sekitar</p>

                                                                            <p class="m-0 kodeprogram"><i
                                                                                    class="fas fa-key mr-1"></i>P002
                                                                            </p>
                                                                            <a
                                                                                href="detail_program_individu.php?id_program=P001">
                                                                                <button class="btn btndetail">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Detail
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

                                                                    <div class="col-md-12 col-12">
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Mengenal Huruf
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0 text-warning status"><i
                                                                                    class="fas fa-hourglass-half"
                                                                                    aria-hidden="true"></i>
                                                                                <b>Pending</b>
                                                                            </p>
                                                                            <p class="m-0  targetdate"><i
                                                                                    class="fas fa-calendar mr-1"
                                                                                    aria-hidden="true"></i> 11/06/2020
                                                                            </p>
                                                                            <p class="m-0  namaads"><i
                                                                                    class="fas fa-user mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                Debbie Scoomin | ADS002</p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-bullseye mr-1 sasaran"></i>Dapat
                                                                                mengenal berbagai huruf dalam lingkungan
                                                                                sekitar</p>

                                                                            <p class="m-0 kodeprogram"><i
                                                                                    class="fas fa-key mr-1"></i>P003
                                                                            </p>
                                                                            <a
                                                                                href="detail_program_individu.php?id_program=P001">
                                                                                <button class="btn btndetail">
                                                                                    <i class="fas fa-external-link-square-alt mr-1"
                                                                                        aria-hidden="true"></i>
                                                                                    Lihat Detail
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
