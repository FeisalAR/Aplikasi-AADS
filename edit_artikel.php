<?php
include 'connection.php';
session_start();

$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if (!$isLoggedIn) {
 header('Location: login.php');
}
else{
$id_user         = $_SESSION['id_user'];
$id_artikel = $_GET['id_artikel'];
    //Artikel query
$sqlartikel = 'SELECT * FROM tabel_artikel WHERE id_artikel = :id_artikel';

$stmt = $pdo->prepare($sqlartikel);
$stmt->execute(['id_artikel' => $id_artikel]);
$rowartikel = $stmt->fetch();

//-------Artikel query end


if (isset($_POST['submit'])) {  
  $judul_artikel        = $_POST['judul_artikel'];
  $ringkasan_artikel      = $_POST['ringkasan_artikel'];
  $isi_artikel    = $_POST['isi_artikel'];
  $status_artikel = $_POST['status_artikel'];
  //$randomstring = substr(md5(rand()), 0, 7);

      //Image upload
 //if (isset($_FILES['image_uploads'])) {
   move_uploaded_file($_FILES["image_uploads"]["tmp_name"], $rowartikel->gambar_artikel);
     //---image upload end    
 //}  
 $sqlartikel = "UPDATE tabel_artikel
                SET  status_artikel = :status_artikel, judul_artikel = :judul_artikel, ringkasan_artikel = :ringkasan_artikel, isi_artikel = :isi_artikel
                WHERE id_artikel = :id_artikel";

  $stmt = $pdo->prepare($sqlartikel);
  $stmt->execute(['id_artikel' => $id_artikel, 'status_artikel' => $status_artikel, 'judul_artikel' => $judul_artikel, 'ringkasan_artikel' => $ringkasan_artikel, 'isi_artikel' => $isi_artikel]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "HAHAHAAHA INSERT FAILED !";
  } else {
   echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: listing_artikel.php?status=updatesuccess");
  }
 }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href='css/bootstrap.css' />
    <link rel="stylesheet" type="text/css" href='css/style.css' />
    <link rel="stylesheet" href='css/all.css' />
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
    <script src="trumbowyg/dist/trumbowyg.min.js"></script>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - Aplikasi AADS</title>
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

                    <!-- <ul class="guestHmenu navbar-nav navbar-collapse d-none">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                    </ul> -->

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
                    <ul class="userlogout navbar-nav navbar-collapse">
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
                    

                    <ul class="programVmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_program.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>

                        <li class="nav-item">
                            <a href="tambah_program.php" class="nav-link">
                                <i class="icon far fa-plus-square"></i><span class="vmenutext">Tambah Program</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listing_artikel.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Artikel</span>
                            </a>
                            </li>

                        <li class="nav-item">
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
                            <h1>Edit Artikel</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="" enctype="multipart/form-data">
                                        <label>Status:</label>
                                        <div class="form-group statusartikel" name="status_artikel">
                                            <label class="radio-inline mr-3"><input type="radio" name="status_artikel"
                                                    value="Published"<?php if ($rowartikel->status_artikel == 'Published') {
 echo 'checked';
} else if(!$rowartikel->status_artikel) {echo "checked";}
?>>Published</label>
                                            <label class="radio-inline"><input type="radio" name="status_artikel"
                                                    value="Redacted" <?php if ($rowartikel->status_artikel == 'Redacted') {
 echo 'checked';
}
?>>Redacted</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="judul_artikel">Judul Artikel:</label>
                                            <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" required
                                                aria-required="true" value=<?php echo $rowartikel->judul_artikel ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="ringkasan_artikel">Ringkasan Artikel:</label>
                                            <input type="text" class="form-control" id="ringkasan_artikel" name="ringkasan_artikel" required
                                                aria-required="true" value=<?php echo $rowartikel->ringkasan_artikel ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="isi_artikel">Isi Artikel:</label>
                                            <textarea id="isi_artikel" name="isi_artikel"><?php echo $rowartikel->isi_artikel ?></textarea>
                                        <script>
                                                $('#isi_artikel').trumbowyg();
                                        </script>
                                        <label>Gambar Artikel</label>
                                        <div class='form-group' id='fotoprofil'>
                                            <div>
                                                <label for='image_uploads'>Pilih Gambar</label>
                                                <input type='file'  class='form-control' id='image_uploads'
                                                    name='image_uploads' accept='.jpg, .jpeg, .png'>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        
                                        

                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Simpan">
                                    </form>

            </div> <!-- Main Container end -->

            </main>
        </div>
    </div>
    </div>
    </div>
    
</body>

</html>
