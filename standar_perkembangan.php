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


//Get program data 3

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 3
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row3 = $stmt->fetchAll();

//-------End get program data 3

//Get program data 6

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 6
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row6 = $stmt->fetchAll();

//-------End get program data 6

//Get program data 9

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 9
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row9 = $stmt->fetchAll();

//-------End get program data 9

//Get program data 12
$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 12
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row12 = $stmt->fetchAll();

//-------End get program data 12

//Get program data 15

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 15
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row15 = $stmt->fetchAll();

//-------End get program data 15
//Get program data 18

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 18
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row18 = $stmt->fetchAll();

//-------End get program data 18
//Get program data 21

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 21
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row21 = $stmt->fetchAll();

//-------End get program data 21
//Get program data 24

$sqlprogram = 'SELECT * FROM tabel_rekomendasi
WHERE umur_rekomendasi = 24
ORDER BY nomor_rekomendasi DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute();
$row24 = $stmt->fetchAll();

//-------End get program data 24



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
    <link href="css/progress-wizard.min.css" rel="stylesheet">


    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Standar Perkembangan Anak - Aplikasi AADS</title>
</head>

<body>

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
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class="nav-link hactive" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola
                                ADS</a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
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
        <div class="col-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    <ul class="programVmenu navbar-nav">
                        <li class='nav-item'>
                            <a href='listing_ads.php' class='nav-link'>
                                <i class='icon fas fa-list'></i><span class='vmenutext'>Listing ADS</span>
                            </a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='profil_ads.php' class='nav-link'>
                                <i class='icon far fa-address-card'></i><span class='vmenutext'>Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>

                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='laporan_capaian.php' class='nav-link'>
                                <i class='icon fas fa-chart-line'></i><span class='vmenutext'>Laporan Capaian</span>
                            </a>
                        </li>

                        <li class="nav-item" >
                            <a href="standar_perkembangan.php" class="nav-link vactive">
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
                            <h1>Standar Perkembangan Anak</h1>
                            <h5 class="small">Berikut adalah rekomendasi program individu sebagai referensi berdasarkan umur anak</h5>
                        </div>
                    </div>



<div class="multisteps-form">
  <!--progress bar-->
  <div class="row mt-4">
    <div class="col-12  ml-auto mr-auto mb-4">
      <div class="multisteps-form__progress">
        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">3 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="6 bulan">6 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="9 bulan">9 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="12 bulan">12 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="15 bulan">15 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="18 bulan">18 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="21 bulan">21 bulan</button>
        <button class="multisteps-form__progress-btn" type="button" title="24 bulan">24+ bulan</button>
      </div>
    </div>
  </div>
  <!--form panels-->
  <div class="row">
    <div class="col-12 m-auto">
      <form class="multisteps-form__form">
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none js-active" data-animation="">

          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                <p class="bg-white  m-0 pl-3 p-1">Rekomendasi untuk Umur 3 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row3 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>                                                                        
                                                                           
                                                                                                                             
                                                                                
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 6 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row6 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                 
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 9 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row9 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                  
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 12 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row12 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                      
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 15 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row15 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                    
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 18 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row18 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                   
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 21 Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                    <?php
foreach ($row21 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                 
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"></div>
          <div class="multisteps-form__content">
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
                                                
                                                <ul class="list-group" id="program-list">
                                                 <p class="bg-white pl-3 p-1 m-0">Rekomendasi untuk Umur 24+ Bulan : </p>
                                                                <div class='border-top bg-white'></div>
                                                   <?php
foreach ($row24 as $rowitems) {
 


 if($isPengurus){
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
                                                                        $rowitems->nama_rekomendasi
                                                                    </h5>
                                                                    <div class='user-detail'>                                                                                                                                                                                                                                                                                       
                                                                        <p class='m-0'>$rowitems->deskripsi_rekomendasi</p>
                                                                                  
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

                    </div>
          </div>
        </div>
      </form>
     </div>
  </div>
</div>




                    

                </main>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
