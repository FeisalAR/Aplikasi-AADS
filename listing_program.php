<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if(isset($_SESSION['jabatan'])){
    $isPengurus = $_SESSION['jabatan'] == 2;
}
else{
    $isPengurus = false;
}

if (isset($_SESSION['id_user']))
{
    $my_id_user = $_SESSION['id_user'];
}
$my_id_user = "guest";


//Get program data

$sqlprogram = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
ORDER BY nomor_program DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row = $stmt->fetchAll();

//-------End get program data

$msg = "";

if (isset($_GET['status'])) {
 if ($_GET['status'] == 'addsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Tambah Program Individu Berhasil.</strong>
        </div>";
 } else if ($_GET['status'] == 'updatesuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Edit Program Individu Berhasil.</strong>
        </div>";
 }

}


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
    <title>Listing Program - Aplikasi AADS</title>
</head>

<body>

    


    <img class="dnapic" src="images/dnabg.png" alt="dnapic">
    <div class="container-fluid listingprogrampage">
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
                        <li class="nav-item" <?php if(!$isLoggedIn)echo 'style="display:none"';?>>
                            <a class="nav-link" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola ADS</a>
                        </li>
                        <li class="nav-item" <?php if(!$isLoggedIn)echo 'style="display:none"';?>>
                            <a class="nav-link hactive" href="listing_program.php"><i
                                    class="icon fas fa-tasks"></i>Kelola Program</a>
                        </li>
                    </ul>

                    <!-- <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                    </ul> -->

                    

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
        <div class="col-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    <ul class="programVmenu navbar-nav">
                        <li class="nav-item" <?php if(!$isLoggedIn)echo 'style="display:none"';?>>
                            <a href="listing_program.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        <li class="nav-item" <?php if(!$isLoggedIn)echo 'style="display:none"';?>>
                            <a href="tambah_program.php" class="nav-link">
                                <i class="icon far fa-plus-square"></i><span class="vmenutext">Tambah Program</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if(!$isPengurus)echo 'style="display:none"';?> >
                            <a href="kelola_standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-bar"></i><span class="vmenutext">Kelola Standar Perkembangan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listing_artikel.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Artikel</span>
                            </a>
                            </li>
                        <li class="nav-item" <?php if(!$isPengurus)echo 'style="display:none"';?> >
                            <a href="tambah_artikel.php" class="nav-link">
                                <i class="icon fas fa-plus"></i><span class="vmenutext">Tambah Artikel</span>
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
                            <?php echo $msg ?>
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
                                                                id="program-list-search-listing">
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-group" id="program-list">
                                                    <?php
foreach ($row as $rowitems) {
 $statusicon;
 $statusclass;


if(!empty($tanggalselesai)){
     
}
 

$tanggalselesaif = date("j F Y",strtotime($rowitems->tanggal_selesai));

 if ($rowitems->status_program == 'Pending') {
    $statusicon  = 'fas fa-hourglass-half';
    $statusclass = 'text-warning';
    $tanggalselisih = "";
    $tanggalselesai = "";
 } else {
  $statusicon  = 'fas fa-check';
  $statusclass = 'text-success';
  $tanggalselesai = $rowitems->tanggal_selesai;    
    $umurselesai = ageCompletedCalculator($rowitems->tanggal_lahir, $tanggalselesai);
  $tanggalselisih = "Pada: $tanggalselesaif (Umur $umurselesai)
                                          ";
 }
 

 $tanggaltargetf = date("j F Y",strtotime($rowitems->tanggal_target));


 if(($my_id_user == $rowitems->id_user) || ($isPengurus)){
     $idCheck = ' ';
 }
 else{
     $idCheck =' style="display:none" ';
 }

 echo "<li class='list-group-item'>
                                                    <div class='row'>
                                                        <div class='col-md-12 col-12'>
                                                            <div class='row'>

                                                                <div class='col-md-12 col-12'>
                                                                    <h5 class='font-weight-bold mb-1 namaprogram'>
                                                                        $rowitems->nama_program
                                                                    </h5>
                                                                    <div class='user-detail'>
                                                                    <p class='m-0 kodeprogram'><i
                                                                                class='fas fa-key mr-1'></i>$rowitems->id_program
                                                                        </p>
                                                                        <p class='m-0 $statusclass status'><i
                                                                                class='fas $statusicon
                                                                                aria-hidden='true'></i>
                                                                            <b>$rowitems->status_program</b>
                                                                        </p>
                                                                        $tanggalselisih
                                                                        <p class='m-0'><i
                                                                                class='fas fa-calendar mr-1'
                                                                                aria-hidden='true'></i><span class='targetdate'>Target: $tanggaltargetf</span>
                                                                        </p>
                                                                        <p class='m-0 namaads'><i
                                                                                class='fas fa-user mr-1 '></i>$rowitems->nama_user | $rowitems->id_user</p>
                                                                       
                                                                        <p class='m-0'><i
                                                                                class='fa fa-bullseye mr-1 sasaran'></i>Sasaran: $rowitems->sasaran_program</p>
                                                                        <a
                                                                            href='lihat_detail_program_individu.php?id_program=$rowitems->id_program&id_user=$rowitems->id_user'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-external-link-square-alt mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Lihat Detail
                                                                            </button></a><a $idCheck 
                                                                            href='edit_program.php?id_program=$rowitems->id_program'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-pencil-alt mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Edit Program
                                                                            </button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>";

}
?>

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
