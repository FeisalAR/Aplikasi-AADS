<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

 $id_artikel = $_GET['id_artikel'];

  $sqlartikel = 'SELECT * FROM tabel_artikel WHERE id_artikel = :id_artikel ';

$stmt = $pdo->prepare($sqlartikel);
$stmt->execute(['id_artikel' => $id_artikel]);
$rowartikel = $stmt->fetch();

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
    <title><?php echo $rowartikel->judul_artikel?> - Aplikasi AADS</title>
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
                    <ul class="userHmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola ADS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listing_program.php"><i
                                    class="icon fas fa-tasks"></i>Kelola Program</a>
                        </li>
                    </ul>

                    <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
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

                    <ul class="userlogin navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log
                                In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php"><i
                                    class="icon fas fa-user-plus"></i>Registrasi</a>
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
                    <ul class="userVmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list"></i><span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="guestVmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list-ul"></i>
                                <span class="vmenutext">Listing ADS</span>
                            </a>
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
                            <a href="listing_artikel.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Artikel</span>
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
                            <h1><?php echo $rowartikel->judul_artikel?></h1>
                            <span class="tanggalartikel">Publikasi: <?php echo date("j F Y", strtotime($rowartikel->tanggal_artikel)) ?></span>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <div class='col btntambahprogram mb-2'>
                    <!-- Form fields -->
                    <div class='row'>
                        <div class='col'>
                            <div id='listingcards'>
                                <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col col-12'>
                                            <div class='card'>
                                                <ul class='list-group' id='user-list-profile'>
                                                    <li class='list-group-item' id="articlebox">
                                                    <img src="<?php echo $rowartikel->gambar_artikel?>" class="articleimage mx-auto d-block">
                                                      <?php echo $rowartikel->isi_artikel?>
                                                              
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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
                    <div class="row d-block">
                        <a href='listing_artikel.php'>Listing Artikel></a>
                    </div>

            </div> <!-- Main Container end -->

            </main>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
