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
    <title>Detail Program Individu - Aplikasi AADS</title>
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
                            <a href="listing_ads.php" class="nav-link">
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
                            <a href="edit_profil.php" class="nav-link">
                                <i class="icon fas fa-user-edit"></i><span class="vmenutext">Edit Profil Saya</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="program_individu.php" class="nav-link">
                                <i class="icon far fa-address-book"></i><span class="vmenutext">Program
                                    Individu Saya</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="detail_program_individu.php" class="nav-link vactive">
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
                        </li>
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link vactive">
                                <i class="icon fas fa-sign"></i>
                                <span class="vmenutext">Log In</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
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
                            <h1>Detail Program Individu & Catatan Harian</h1>
                        </div>
                    </div>

                    <div class="row" id="detailprogram">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <ul class="list-group" id="program-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <a class="backtoprofile font-weight-bold"
                                                                            href="profil_ads.php#program-list-search"><i
                                                                                class="fas fa-chevron-left"></i>Kembali
                                                                            ke profil</a>
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Mengenal Warna
                                                                        </h5><a href="#" class="editlink"><button
                                                                                class="btn editbutton"
                                                                                data-toggle="modal"
                                                                                data-target="#editprogrammodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-pencil-alt"></i>Edit
                                                                                Program</button></a>
                                                                        <div class="container-fluid user-detail">
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 kodeprogram">
                                                                                    <p class="font-weight-bold">
                                                                                        Kode
                                                                                        Program</p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        P001
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 statusdetailprogram">
                                                                                    <p class="font-weight-bold">
                                                                                        Status
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12  content">
                                                                                    <p class="text-warning status">
                                                                                        <i class="fas fa-hourglass-half"
                                                                                            aria-hidden="true"></i>
                                                                                        <b>Pending</b>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 namaadsdetail">
                                                                                    <p class="font-weight-bold">
                                                                                        Nama ADS
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        Nick Daniel | ADS001
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tanggaltarget">
                                                                                    <p class="font-weight-bold">
                                                                                        Tanggal
                                                                                        Target
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        11/06/2020
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tanggalselesai">
                                                                                    <p class="font-weight-bold">
                                                                                        Tanggal
                                                                                        Selesai
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>-</p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 kategoridetail detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentkategori, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Kategori</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentkategori collapse contentall">
                                                                                    <p class="contentp"> Kognitif,
                                                                                        Sensorik
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tujuan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contenttujuan, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Tujuan
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contenttujuan collapse contentall">
                                                                                    <p class="contentp">Lorem ipsum
                                                                                        dolor
                                                                                        sit amet
                                                                                        consectetur adipisicing elit.
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 sasaran detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentsasaran, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Sasaran
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentsasaran  collapse contentall">
                                                                                    <p class="contentp">Lorem ipsum
                                                                                        dolor
                                                                                        sit amet
                                                                                        consectetur adipisicing elit.
                                                                                        Maiores quisquam aliquam libero
                                                                                        doloremque soluta? Blanditiis
                                                                                        ipsam ut mollitia, dolor
                                                                                        voluptates repellat repudiandae
                                                                                        harum alias illum commodi nihil
                                                                                        cupiditate, quaerat autem.</p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 keadaan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentkeadaan, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Keadaan
                                                                                        Sekarang</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentkeadaan collapse contentall">
                                                                                    <p class="contentp">Lorem ipsum
                                                                                        dolor
                                                                                        sit amet
                                                                                        consectetur adipisicing elit.
                                                                                        Maiores quisquam aliquam libero
                                                                                        doloremque soluta? Blanditiis
                                                                                        ipsam ut mollitia, dolor
                                                                                        voluptates repellat repudiandae
                                                                                        harum alias illum commodi nihil
                                                                                        cupiditate, quaerat autem.</p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 sumbermateri detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentsumber, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Sumber
                                                                                        Materi / Alat Peraga</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentsumber collapse contentall">
                                                                                    <p class="contentp">Lorem ipsum
                                                                                        dolor
                                                                                        sit amet
                                                                                        consectetur adipisicing elit.
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row m-0">
                                                                                <div class="col-12 carapelaksanaan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentcara, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Cara
                                                                                        Pelaksanaan</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentcara collapse contentall">
                                                                                    <p class="contentp">Lorem ipsum
                                                                                        dolor
                                                                                        sit amet
                                                                                        consectetur adipisicing elit.
                                                                                        Maiores quisquam aliquam libero
                                                                                        doloremque soluta? Blanditiis
                                                                                        ipsam ut mollitia, dolor
                                                                                        voluptates repellat repudiandae
                                                                                        harum alias illum commodi nihil
                                                                                        cupiditate, quaerat autem.</p>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <!--End of list container -->
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

                    </div>












                    <!-- CATATAN HARIAN -->
                    <div class="row" id="catatanharian">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <ul class="list-group" id="program-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Catatan Harian
                                                                        </h5><a href="#" class="editlink"><button
                                                                                class="btn editbutton"
                                                                                data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Catatan Harian</button></a>
                                                                        <div class="container-fluid user-detail">
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        01/03/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna primer
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        11/03/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna sekunder
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        20/03/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna tersier
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        28/03/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna pentier
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        04/04/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna hextier
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0 catatanentry">
                                                                                <div class="col-sm-12 col-md-3">
                                                                                    <p class="font-weight-bold">
                                                                                        15/04/2020</p>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-6 content">
                                                                                    <p>
                                                                                        Mengenal warna septier
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <!--End of list container -->
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

                    </div>

                    <div class="modal fade" id="editprogrammodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Program Individu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/action_page.php">
                                        <!-- <div class="form-group">
                                                                <label for="namaads">Nama ADS:</label>
                                                                <input type="text" class="form-control" id="namaads" required aria-required="true">
                                                            </div> -->

                                        <div class="form-group">
                                            <label for="namaprogram">Nama Program Individu:</label>
                                            <input type="text" class="form-control" id="namaprogram" required
                                                aria-required="true">
                                        </div>

                                        <label>Status:</label>
                                        <div class="form-group statusprogram">
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Pending" checked>Pending</label>
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Selesai">Selesai</label>
                                        </div>

                                        <div class="form-group tanggalselesaitoggle">
                                            <label for="tanggalselesai">Tanggal Selesai:</label>
                                            <input type="date" class="form-control tanggal" id="tanggalselesai" required
                                                aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label for="tujuanprogram">Tujuan:</label>
                                            <textarea class="form-control" id="tujuanprogram" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="keadaansekarang">Keadaan Sekarang:</label>
                                            <textarea class="form-control" id="keadaansekarang" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sasaranprogram">Sasaran:</label>
                                            <textarea class="form-control" id="sasaranprogram" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sumberprogram">Sumber Materi / Alat Peraga:</label>
                                            <textarea class="form-control" id="sumberprogram" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Cara Pelaksanaan:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="3"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggaltarget">Tanggal Target:</label>
                                            <input type="date" class="form-control tanggal" id="tanggaltarget" required
                                                aria-required="true">
                                        </div>

                                        <label>Kategori (Pilih minimal Satu):</label><br>
                                        <div class="form-group kategori">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="option1" checked>
                                                <label class="form-check-label" for="inlineCheckbox1">Kognitif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                    value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Motorik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                    value="option3">
                                                <label class="form-check-label" for="inlineCheckbox3">Sensorik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                    value="option3">
                                                <label class="form-check-label"
                                                    for="inlineCheckbox3">Kemandirian</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                    value="option3">
                                                <label class="form-check-label"
                                                    for="inlineCheckbox3">Sosial-Emosional</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-3">Submit</button><button
                                            type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="modal fade" id="tambahcatatanmodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan Harian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/action_page.php">
                                        <div class="form-group">
                                            <label for="tanggaltarget">Tanggal Kegiatan:</label>
                                            <input type="date" class="form-control tanggal" id="tanggaltarget" required
                                                aria-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Deskripsi Kegiatan:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="3"
                                                required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-3">Submit</button><button
                                            type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Main Container end -->

                </main>
            </div>
        </div>
    </div>
    </div>
</body>


</html>
