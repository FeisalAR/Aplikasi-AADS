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
if(isset($_GET['tanggal_awal'])){
$sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user AND tanggal_target BETWEEN :tanggal_awal AND :tanggal_akhir';

 $stmt = $pdo->prepare($sql);
 $stmt->execute(['id_user' => $id_user, 'tanggal_awal' => $_GET['tanggal_awal'], 'tanggal_akhir' => $_GET['tanggal_akhir']]);
 $row = $stmt->fetchAll();

}
else{
    $sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user';

 $stmt = $pdo->prepare($sql);
 $stmt->execute(['id_user' => $id_user]);
 $row = $stmt->fetchAll();

}
 
//-------User & Program data query end

}

function ageCalculator($dob){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        if ($ag == 0)
        {
            return "$mn Bulan";            
        }
        else
        {
            return "$ag Tahun $mn Bulan";
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
    <title>Laporan Capaian - Aplikasi AADS</title>
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
                        <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="laporan_capaian.php" class="nav-link vactive">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Laporan Capaian</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-bar"></i><span class="vmenutext">Standar Perkembangan Anak</span>
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
                                                                            <p class="m-0 "><i
                                                                                    class="fas fa-birthday-cake mr-1"
                                                                                    aria-hidden="true"></i><span class="bdads">
                                                                                    <?php echo date("j F Y",strtotime($rowuser->tanggal_lahir)) ?></span>

                                                                            </p>
                                                                            <p class='m-0 '><i
                                                                                    class='fas fa-user-clock mr-1'
                                                                                    aria-hidden='true'></i><span class="umurads"> <?php echo ageCalculator($rowuser->tanggal_lahir) ?>
                                                                            </span>
                                                                            </p>
                                                                            <?php
                                                                                if($rowuser->jenis_kelamin == "Laki-laki"){
                                                                                    $jkicon = "mars";
                                                                                }
                                                                                else{
                                                                                    $jkicon = "venus";
                                                                                }
                                                                            ?>
                                                                            <p class="m-0"><i class="fas fa-<?php echo $jkicon?> mr-1"
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
                        <form method="GET" action="">
                            <div class="col-sm-12 col-md-12 periodefilter mb-2">
                                <label for="tanggaltarget" class="font-weight-bold">Periode:</label>
                                <input type="date" class="form-control tanggal" id="tanggalawal" name="tanggal_awal" required
                                aria-required="true">
                                <input type="date" class="form-control tanggal" id="tanggalakhir" name="tanggal_akhir" required
                                aria-required="true">
                                <input type="submit" class="btn btn-primary d-print-none" name="submit" value="Terapkan Filter">
                            </div>
                            <a class="mx-3 d-print-none" href="laporan_capaian.php">Reset filter</a>

                        </form>
                        

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

 $sqlCatatan = 'SELECT * FROM tabel_catatan_harian WHERE id_program = :id_program ORDER BY tanggal_catatan ASC';

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

if (!isset($rowitem->tanggal_selesai) || empty($rowitem->tanggal_selesai)) {
 $tanggalselesaif = " - ";
} else {
 $tanggalselesaif = date("j F Y",strtotime($rowitem->tanggal_selesai)) ;
}

  

 echo '<li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-md-12 col-12">
                                                                 <div class="row">
                                                                     <div class="col-md-12 col-12">
                                                                         <h5 class="font-weight-bold mb-1 namaprogram">
                                                                             ' . $rowitem->nama_program . ' <small class="kodeprogram"> | ' . $rowitem->id_program  . '</small>
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
                                                                                     class="col-sm-12 col-md-3 ">
                                                                                     <label class="capaianlabel">Tanggal
                                                                                         Target :
                                                                                     </label><span class="tanggalcapaian"
                                                                                         id="tanggaltargetcapaian">
                                                                                         ' . date("j F Y", strtotime($rowitem->tanggal_target))  . '</span>
                                                                                 </div>
                                                                                 <div
                                                                                     class="col-sm-12 col-md-3 ">
                                                                                     <label class="capaianlabel">Tanggal
                                                                                         Selesai : </label><span class="selesaicapaian"
                                                                                         id="selesaicapaian"> ' . $tanggalselesaif  . '</span>
                                                                                 </div>                                                                                 

                                                                                <div
                                                                                     class="col-sm-12 col-md-3 kategoricapaian">
                                                                                     <label class="capaianlabel">Kategori
                                                                                         : </label><span
                                                                                         id="kategoricapaian"> ' . $rowitem->kategori_program . '</span>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row sasarancapaianrow">
                                                                                
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
                                                                                             <p class="font-weight-bold catatantanggal">
                                                                                                 ' . date("j F Y", strtotime($catatan->tanggal_catatan))  . '</p>
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
