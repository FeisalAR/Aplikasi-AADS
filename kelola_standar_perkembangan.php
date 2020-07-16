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

//insert rekomendasi

if(isset($_POST['submit'])){
    if($_POST['submit'] == 'Tambahkan'){
        $nama_rekomendasi = $_POST['nama_rekomendasi'];
        $deskripsi_rekomendasi = $_POST['deskripsi_rekomendasi'];
        $umur_rekomendasi = $_POST['umur_rekomendasi'];

        $sqltambah = 'INSERT INTO tabel_rekomendasi (nama_rekomendasi, deskripsi_rekomendasi, umur_rekomendasi)
                      VALUES (:nr, :dr, :ur)';
        $stmt = $pdo->prepare($sqltambah);
        $stmt->execute(['nr' => $nama_rekomendasi, 'dr' => $deskripsi_rekomendasi, 'ur' => $umur_rekomendasi]);
        header('Location: kelola_standar_perkembangan.php?status=addsuccess');
    }
}



//------------end insert rekomendasi



$msg = "";

if (isset($_GET['status'])) {
 if ($_GET['status'] == 'addsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Tambah Rekomendasi Program Individu Berhasil.</strong>
        </div>";
 } else if ($_GET['status'] == 'updatesuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Edit Rekomendasi Program Individu Berhasil.</strong>
        </div>";
 }
 else if ($_GET['status'] == 'deletesuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Hapus Rekomendasi Program Individu Berhasil.</strong>
        </div>";
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
    <link href="css/progress-wizard.min.css" rel="stylesheet">


    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Standar Perkembangan Anak - Aplikasi AADS</title>
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
                            <a href="listing_program.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        <li class="nav-item" <?php if(!$isLoggedIn)echo 'style="display:none"';?>>
                            <a href="tambah_program.php" class="nav-link">
                                <i class="icon far fa-plus-square"></i><span class="vmenutext">Tambah Program</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if(!$isPengurus)echo 'style="display:none"';?> >
                            <a href="kelola_standar_perkembangan.php" class="nav-link vactive">
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
                            <h1>Kelola Standar Perkembangan Anak</h1>
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
        <div class="multisteps-form__panel bg-none js-active" data-animation="scaleIn">
          <div class=""><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                           
                                                                               <a class='btn btndetail mt-3'
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus</a>                                                                             
                                                                                                                                                    
                                                                                
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
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel bg-none" data-animation="scaleIn">
          <div class="multisteps-form__title"><a href="#"         class="btn text-white"               data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Rekomendasi Program</a></div>
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
                                                                        <a
                                                                            href='hapus.php?action=deleterekomendasi&nomor_rekomendasi=$rowitems->nomor_rekomendasi'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-trash mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Hapus
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

                    </div>
          </div>
        </div>
      </form>
     </div>
  </div>
</div>




                    <div class="modal fade" id="tambahcatatanmodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">                                
                                <div class="modal-body">
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <label for="tanggaltarget">Nama Program Rekomendasi:</label>
                                            <input type="text" class="form-control" id="tanggaltargets" required
                                                aria-required="true" name="nama_rekomendasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Deskripsi Program:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="4" name="deskripsi_rekomendasi"
                                                required></textarea>
                                                
                                        </div>
                                        <div class="form-group">
                            <label for="umur_rekomendasi">Umur minimum:</label><h5>(Rekomendasi hanya akan muncul jika anak sudah mencapai umur berikut):</h5>
                            <select class="form-control" id="umur_rekomendasi"  name="umur_rekomendasi" >
                                <option value="3">3 bulan</option>
                                <option value="6">6 bulan</option>
                                <option value="9">9 bulan</option>
                                <option value="12">12 bulan</option>
                                <option value="15">15 bulan</option>
                                <option value="18">18 bulan</option>
                                <option value="21">21 bulan</option>
                                <option value="24">24+ bulan</option>
                                
                            </select>
                        </div>
                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Tambahkan"><button
                                            type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
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
