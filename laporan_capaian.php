<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if (!$isLoggedIn) {
 header("Location: login.php");
} else {
 $id_user    = $_SESSION['id_user'];
 $nomor_user = $_SESSION['nomor_user'];
 $msg        = "";

 $sqluser = 'SELECT * FROM tabel_user
WHERE id_user = :id_user';

 $stmt = $pdo->prepare($sqluser);
 $stmt->execute(['id_user' => $id_user]);
 $rowuser = $stmt->fetch();

//User & Program data query
 $sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user';

 $stmt = $pdo->prepare($sql);
 $stmt->execute(['id_user' => $id_user]);
 $row = $stmt->fetchAll();

//-------User & Program data query end

}

?>

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
    <title>Laporan Capaian - Aplikasi AADS</title>
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

                    <ul class="userlogin navbar-nav navbar-collapse" <?php if ($isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php"><i
                                    class="icon fas fa-user-plus"></i>Registrasi</a>
                        </li>
                    </ul>
                    <ul class="userlogout navbar-nav navbar-collapse" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="icon fas fa-sign-out-alt"></i>Log Out</a>
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
                            <a href="laporan_capaian.php" class="nav-link vactive">
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
                        <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil ADS</span>
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
                            <h1>Laporan Capaian</h1>
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
                                                <ul class="list-group" id="user-list-profile">

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div
                                                                        class="col-sm-12 col-md-3 user-img text-center pt-1">
                                                                        <img src="<?php echo $rowuser->foto_profil ?>"
                                                                            alt="Seth Frazier"
                                                                            class="img-responsive img-circle rounded-circle" />
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-4">
                                                                        <h5 class="font-weight-bold mb-1 namaads">
                                                                            <?php echo $rowuser->nama_user ?>
                                                                        </h5>
                                                                        <div class="user-detail">
                                                                            <p class="m-0  kodeads"><i
                                                                                    class="fas fa-key mr-1"></i>
                                                                                    <?php echo $rowuser->id_user ?>

                                                                            </p>
                                                                            <p class="m-0  bdads"><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                    <?php echo $rowuser->tanggal_lahir ?>

                                                                            </p>
                                                                            <p class="m-0"><i class="fas fa-mars mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                <?php echo $rowuser->jenis_kelamin ?>
                                                                                </p>
                                                                            <p class="m-0"><i
                                                                                    class="fa fa-user-friends mr-1 ortuads"></i>
                                                                                    <?php echo $rowuser->nama_orang_tua ?>
                                                                                </p>
                                                                            <p hidden class="m-0 text-warning status"><i
                                                                                    class="fas fa-hourglass-half"
                                                                                    aria-hidden="true"></i>
                                                                                <b>PendingSelesai</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-6 col-md-4">
                                                                        <div class="user-detail">
                                                                            <p class="m-0  alamatads"><i
                                                                                    class="fas fa-home mr-1"></i><?php echo $rowuser->alamat ?>

                                                                            </p>
                                                                            <p class="m-0  kecamatan"><i
                                                                                    class="fas fa-landmark mr-1"></i><?php echo $rowuser->kecamatan . ', ' . $rowuser->kota ?>

                                                                            </p>
                                                                            <p class="m-0  kodepos"><i
                                                                                    class="fas fa-envelope mr-1"></i><?php echo $rowuser->kode_pos ?>

                                                                            </p>
                                                                            <p class="m-0  emailads"><i
                                                                                    class="fas fa-at mr-1"></i><?php echo $rowuser->email ?>

                                                                            </p>
                                                                            <p class="m-0  teleponads"><i
                                                                                    class="fas fa-phone mr-1"></i><?php echo $rowuser->nomor_telepon ?>

                                                                            </p>
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

                    </div>



                    <div class="row programfilters">

                        <div class="col-sm-12 col-md-12 periodefilter mb-2">
                            <label for="tanggaltarget" class="font-weight-bold">Periode:</label>
                            <input type="date" class="form-control tanggal" id="tanggalawal" name="tanggalrange" required
                                aria-required="true">
                            <input type="date" class="form-control tanggal" id="tanggalakhir" required
                                aria-required="true">
                        </div>

                        <div class="col-sm-12 col-md-6 statusfilterlabel mb-2 mt-2 d-print-none">
                            <label class="font-weight-bold">Status:</label>
                            <div class="form-group filterstatusprogram mb-0">
                                <label class="radio-inline mr-2"><input type="radio" name="radiofilterstatus"
                                        value="Semua" checked>Semua</label>
                                <label class="radio-inline mr-2"><input type="radio" name="radiofilterstatus"
                                        value="Pending">Pending</label>
                                <label class="radio-inline mr-2"><input type="radio" name="radiofilterstatus"
                                        value="Selesai">Selesai</label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 btncetaklaporan mb-2 d-print-none">
                            <a href="#"><button onclick="window.print();return false;" type="submit"
                                    class="btn btn-primary mt-4 mb-2 cetaklaporanbtn"><i class="fas fa-print"></i>Cetak
                                    Laporan
                                    Capaian</button></a>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <div class="row search-div" style="display: block;">
                                                    <div class="col-md-12 col-12">
                                                        <div class="search-input d-print-none">
                                                            <input type="text"
                                                                class="form-control rounded-0 d-print-none"
                                                                placeholder="&#xF002;   Cari Kode Program atau Nama Program..."
                                                                aria-label="Recipient's username"
                                                                style="font-family: Montserrat, FontAwesome;"
                                                                aria-describedby="basic-addon2"
                                                                id="program-list-search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group" id="program-list">

<?php

foreach ($row as $rowitem) {
 //Catatan harian query

 $sqlCatatan = 'SELECT * FROM tabel_catatan_harian WHERE id_program = :id_program ORDER BY tanggal_catatan DESC';

 $stmt = $pdo->prepare($sqlCatatan);
 $stmt->execute(['id_program' => $rowitem->id_program]);
 $rowCatatan = $stmt->fetchAll();

//-----Catatan harian query end

 $statusicon  = "";
 $statusclass = "";
 if ($rowitem->status_program == 'Pending') {
  $statusicon  = 'fas fa-hourglass-half';
  $statusclass = 'text-warning';
 } else {
  $statusicon  = 'fas fa-check';
  $statusclass = 'text-success';
 }

 echo '<li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-md-12 col-12">
                                                                 <div class="row">
                                                                     <div class="col-md-12 col-12">
                                                                         <h5 class="font-weight-bold mb-1 namaprogram">
                                                                             ' . $rowitem->nama_program . '
                                                                         </h5>
                                                                         <div class="user-detail">
                                                                             <div class="row statuscapaianrow">
                                                                                 <div
                                                                                     class="col-sm-12 col-md-2 statuscapaian">
                                                                                     <label class="capaianlabel">Status :
                                                                                     </label>
                                                                                     <span class="' . $statusclass . ' status"
                                                                                         id="statuscapaian">
                                                                                         <i class="' . $statusicon . '"
                                                                                             aria-hidden="true"></i>
                                                                                         <b>' . $rowitem->status_program . '</b>
                                                                                     </span>
                                                                                 </div>
                                                                                 <div
                                                                                     class="col-sm-12 col-md-3 tanggalcapaian">
                                                                                     <label class="capaianlabel">Tanggal
                                                                                         Target :
                                                                                     </label><span
                                                                                         id="tanggaltargetcapaian">
                                                                                         ' . $rowitem->tanggal_target . '</span>
                                                                                 </div>
                                                                                 <div
                                                                                     class="col-sm-12 col-md-3 selesaicapaian">
                                                                                     <label class="capaianlabel">Tanggal
                                                                                         Selesai : </label><span
                                                                                         id="selesaicapaian">' . $rowitem->tanggal_selesai . '</span>
                                                                                 </div>

                                                                                <div
                                                                                     class="col-sm-12 col-md-3 kategoricapaian">
                                                                                     <label class="capaianlabel">Kategori
                                                                                         : </label><span
                                                                                         id="kategoricapaian"> ' . $rowitem->kategori_program . '</span>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row sasarancapaianrow">
                                                                                 <div class="col-sm-12 col-md-2 label">
                                                                                     <label
                                                                                         class="capaianlabel">Sasaran:</label>
                                                                                 </div>
                                                                                 <div class="col-sm-12 col-md-9 content">
                                                                                     <span id="sasarancontent"> ' . $rowitem->sasaran_program . '</span>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row kondisicapaianrow">
                                                                                 <div class="col-sm-12 col-md-2 label">
                                                                                     <label class="capaianlabel">Keadaan
                                                                                         Sekarang : </label>
                                                                                 </div>
                                                                                 <div class="col-sm-12 col-md-9 content">
                                                                                     <span id="kondisicontent"> ' . $rowitem->keadaan_sekarang . '</span>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row catatancapaianrow"
                                                                                 data-toggle="collapse"
                                                                                 data-target=".catatancontent' . $rowitem->id_program . '">
                                                                                 <label class="capaianlabel px-3"><i
                                                                                         class="icon fas fa-chevron-down"></i>Catatan
                                                                                     Harian</label>
                                                                             </div>

                                                                    ';
 foreach ($rowCatatan as $catatan) {
  echo '<div
                                                                                 class="row collapse catatanrowentry catatancontent' . $rowitem->id_program . ' ">
                                                                                 <div class="col catatanentrycontainer"><div class="row  m-0 catatanentry">
                                                                                         <div class="col-sm-12 col-md-2">
                                                                                             <p class="font-weight-bold">
                                                                                                 ' . $catatan->tanggal_catatan . '</p>
                                                                                         </div>
                                                                                         <div
                                                                                             class="col-sm-12 col-md-10 content">
                                                                                             <p>
                                                                                                 ' . $catatan->kegiatan . '
                                                                                             </p>
                                                                                         </div>

                                                                                     </div>
                                                                                     </div>
                                                                             </div>

';
 }
 echo '</div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </li>';

}

?>






                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
