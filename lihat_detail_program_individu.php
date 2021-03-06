<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

$msg = "";
if (isset($_GET['id_program']) && isset($_GET['id_user'])) {
 $id_program = $_GET['id_program'];
 $id_user    = $_GET['id_user'];
} else {
 header('Location: listing_ads.php');
}

if (isset($_GET['status'])) {
 if ($_GET['status'] == 'updatesuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Edit Program Individu Berhasil.</strong>
        </div>";
 } else if ($_GET['status'] == 'addsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Tambah Catatan Harian Berhasil.</strong>
        </div>";
 }
}
//User & Program data query
$sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user AND id_program = :id_program';

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user, 'id_program' => $id_program]);
$row = $stmt->fetchAll();

$statusicon  = "";
$statusclass = "";
if ($row[0]->status_program == 'Pending') {
 $statusicon  = 'fas fa-hourglass-half';
 $statusclass = 'text-warning';
} else {
 $statusicon  = 'fas fa-check';
 $statusclass = 'text-success';
}

//-------User & Program data query end

//Catatan harian query

$sqlCatatan = 'SELECT * FROM tabel_catatan_harian
WHERE  id_program = :id_program ORDER BY tanggal_catatan DESC';

$stmt = $pdo->prepare($sqlCatatan);
$stmt->execute(['id_program' => $id_program]);
$rowCatatan = $stmt->fetchAll();

//-----Catatan harian query end

function ageCompletedCalculator($dob, $tanggalselesai){
        $birthdate = new DateTime($dob);
        $today   = new DateTime($tanggalselesai);
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        if ($ag == 0)
        {
            return "$mn Bulan  $dy Hari";            
        }
        else
        {
            return "$ag Tahun $mn Bulan $dy Hari";
        }        
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
    <title>Lihat Detail Program Individu - Aplikasi AADS</title>
</head>

<body>

    


    <img class="dnapic" src="images/dnabg.png" alt="dnapic">
    <div class="container-fluid">
        <!-- Horizontal Navbar -->
        <div class="nav-wrapper">
            <nav class="navbar navbar-expand-lg navbar-toggleable-lg hnavbar">
                <div class="row logo-row">
                    <div class="col-1-sm">
                            <!-- Potads logo -->
                            <a class="navbar-brand navbar-nav navbar-collapse" href="index.php">
                                <img id="potads-logo" src="images/potadslogotrspctrst.png" alt="Logo">
                            </a>
                    </div>
                    <div class="col-1-sm">
                            <!-- Brand -->
                            <a class="navbar-brand navbar-nav navbar-collapse" href="index.php">
                                <img id="brand-logo" src="images/logo.png" alt="Logo">
                            </a>
                    </div>
                </div> <!-- Logo row end -->
                <div class="row buttonlogo">
                    <div class="col togglebutton">
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                            data-target="#HnavbarToggler">
                            <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                        </button>
                    </div>


                </div>


                <div class="collapse navbar-collapse" id="HnavbarToggler">
                    <!-- Links -->
                    <ul class='userHmenu navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'><i class='icon fas fa-home'></i>Beranda</a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class='nav-link hactive' href='listing_ads.php'><i class='icon fas fa-child'></i>Kelola
                                ADS</a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class='nav-link' href='listing_program.php'><i class='icon fas fa-tasks'></i>Kelola
                                Program</a>
                        </li>
                    </ul>

                    

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
                    <ul class="userlogout navbar-nav navbar-collapse"<?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="icon fas fa-sign-out-alt"></i>Log Out</a>
                        </li>
                    </ul>
                    <!-- Search form -->
                    <form method="GET" class="form-inline ml-auto navbar-nav navbar-collapse" action="pencarian.php">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 red-border" type="text" placeholder="Cari ADS..."
                                aria-label="Search" name="query" required>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search text-grey"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>


                </div>


            </nav>
        </div>
    </div>
    <!-- End of Horizontal Navbar -->

    <div class="vnavcontent row">
        <div class="col-sm-12 col-md-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    <ul class="userVmenu Vmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list"></i><span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="laporan_capaian.php" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Laporan Capaian</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Standar Perkembangan Anak</span>
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
                            <h1>Lihat Detail Program Individu & Catatan Harian</h1>
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
                                                                            href="lihat_profil_ads.php?id_user=<?php echo $id_user ?>"><i
                                                                                class="fas fa-chevron-left"></i>Kembali
                                                                            ke profil</a>
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            <?php echo $row[0]->nama_program ?>
                                                                        </h5>
                                                                        <div class="container-fluid user-detail">
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 kodeprogram">
                                                                                    <p class="font-weight-bold">
                                                                                        Kode
                                                                                        Program</p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        <?php echo $row[0]->id_program ?>
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
                                                                                    <p class="<?php echo $statusclass ?> status">
                                                                                        <i class="<?php echo $statusicon ?>"
                                                                                            aria-hidden="true"></i>
                                                                                        <b><?php echo $row[0]->status_program ?></b>
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
                                                                                        <?php echo $row[0]->nama_user ?> | <?php echo $row[0]->id_user ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 ">
                                                                                    <p class="font-weight-bold">
                                                                                        Tanggal
                                                                                        Target
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content ">
                                                                                    <p class="targetdate">
                                                                                        <?php echo date("j F Y",strtotime($row[0]->tanggal_target)) ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 ">
                                                                                    <p class="font-weight-bold tanggalselesai">
                                                                                        Tanggal
                                                                                        Selesai
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p><?php if ($row[0]->tanggal_selesai == null) {
 echo " - ";
} else {
    $umurselesai = ageCompletedCalculator($row[0]->tanggal_lahir, $row[0]->tanggal_selesai);
    echo date("j F Y",strtotime($row[0]->tanggal_selesai)). "( Umur ".$umurselesai.")";
}
?></p>
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
                                                                                    <p class="contentp"> <?php echo $row[0]->kategori_program ?>
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
                                                                                    <p class="contentp"><?php echo $row[0]->tujuan_program ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- <div class="row  m-0">
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
                                                                                    <p class="contentp"><?php echo $row[0]->sasaran_program ?></p>
                                                                                </div>
                                                                            </div> -->

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
                                                                                    <p class="contentp"><?php echo $row[0]->keadaan_sekarang ?></p>
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
                                                                                    <p class="contentp"><?php echo $row[0]->sumber_materi ?>
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
                                                                                    <p class="contentp"><?php echo $row[0]->cara_pelaksanaan ?></p>
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
                                                                        </h5>
                                                                        <div class="container-fluid user-detail">

                                                                        <?php
foreach ($rowCatatan as $rowitems) {
$tanggal_catatanf = date("j F Y",strtotime($rowitems->tanggal_catatan));
 echo "
                                                                        <div class='row  m-0 catatanentry'>
                                                                                <div class='col-sm-12 col-md-3'>
                                                                                    <p class='font-weight-bold catatantanggal'>
                                                                                        $tanggal_catatanf</p>
                                                                                </div>
                                                                                <div class='col-sm-12 col-md-6 content'>
                                                                                    <p>
                                                                                        $rowitems->kegiatan
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        ";
}
?>


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





                    <!-- Main Container end -->

                </main>
            </div>
        </div>
    </div>
    </div>

    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f17f079a45e787d128be688/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<!-- Footer -->
<footer class="page-footer font-small footeraads">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <a href="https://www.instagram.com/pikpotadsjabar/"><i class="fab fa-instagram" aria-hidden="true"></i></a>
  
    <br>
    © <?php echo date("Y"); ?> Copyright
    <a href="https://potadsjabar.or.id/"> POTADS Jawa Barat</a>
    <br>
    
   Jumlah pengunjung: <!-- Default Statcounter code for AADS POTADS Jawa Barat http://aads.potadsjabar.or.id -->
<script type="text/javascript">
var sc_project=12365769;
var sc_invisible=0;
var sc_security="58b76b60";
var sc_text=2;
var sc_https=1;
var scJsHost = "https://";
document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+ "statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="Web Analytics Made Easy - StatCounter" href="https://statcounter.com/" target="_blank"><img class="statcounter" src="https://c.statcounter.com/12365769/0/58b76b60/0/" alt="Web Analytics Made Easy - StatCounter"></a></div></noscript>
<!-- End of Statcounter Code -->
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>


</html>
