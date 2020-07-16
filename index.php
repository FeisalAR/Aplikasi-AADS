<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

//Artikel query
$sqlartikel = 'SELECT * FROM tabel_artikel ORDER BY nomor_artikel DESC LIMIT 3 ';

$stmt = $pdo->prepare($sqlartikel);
$stmt->execute();
$rowartikel = $stmt->fetchAll();

//-------Artikel query end

$sqlarsip = 'SELECT * FROM tabel_artikel ORDER BY nomor_artikel DESC LIMIT 8 ';

$stmt2 = $pdo->prepare($sqlarsip);
$stmt2->execute();
$rowarsip = $stmt2->fetchAll();

//-------Artikel Lain ^^^^^

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

    <link rel="icon" href="favicon.ico" type="image/x-icon" />


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Aplikasi AADS</title>
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
                            <a class="nav-link hactive" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class="nav-link" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola ADS</a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class="nav-link" href="listing_program.php"><i class="icon fas fa-tasks"></i>Kelola
                                Program</a>
                        </li>
                    </ul>

                    
                    <ul class="guestlogin navbar-nav navbar-collapse" <?php if ($isLoggedIn) {
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
        <div class="col-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    <ul class="userVmenu navbar-nav ">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list-ul"></i><span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="listing_program.php" class="nav-link">
                                <i class="icon fas fa-list-ol"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listing_artikel.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Artikel</span>
                            </a>
                            </li>
                </nav>
            </div>
            <!-- End of vertical navbar -->
        </div>

        <!-- Main content container -->
        <div class="col">
            <div class="container-fluid">
                <main>
                    <div class="row">
                        <!-- Content Title -->
                        <div class="col">
                            <h1>Selamat datang di aplikasi aads</h1>
                        </div>
                    </div>
                    <!-- Content Subtitle -->
                    <div class="row">

                        <div class="col">
                            <h2>Seputar ADS</h2>
                        </div>
                    </div>

                    <!-- Artikel Card -->
                    <div class="row card-group" id="card-group-index">

<?php

foreach ($rowartikel as $artikel){

    echo "
    <div class='artikelcard card'>
                            <img class='card-img-top' src='$artikel->gambar_artikel' alt='Card image' style='width:100%'>
                            <div class='card-body'>
                                <h2 class='card-title'>$artikel->judul_artikel</h2>
                                <p class='card-text'>$artikel->ringkasan_artikel</p>
                                <a href='artikel.php?id_artikel=$artikel->id_artikel' class='btn btn-primary stretched-link'>Selengkapnya</a>
                            </div>
                        </div>
    
    ";


}


?>
                        
                    </div>

                    <!-- Artikel Card End -->

                    <!-- Artikel Archives Subtitle -->
                    <div class="row">

                        <div class="col arsiptitle">
                            <h2>Artikel Lainnya</h2>
                        </div>
                    </div>

                    <!-- archives -->
                    <div class="row arsip">
                        <div class="col">
<?php
$i = 0;
foreach ($rowarsip as $arsip){
        echo "
                        <a href='artikel.php?id_artikel=$arsip->id_artikel'>$arsip->judul_artikel</a>    
    ";
    if ($i++ == 3) break;
}
?>

                        </div>
                        <div class="col">
<?php
$j = 0;
foreach ($rowarsip as $arsip){
    if ($j > 3){
        echo "
                        <a href='artikel.php?id_artikel=$arsip->id_artikel'>$arsip->judul_artikel</a>    
    ";
    }
        
    $j++;
    
    if ($j == 9) break;
    
}
?>
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
