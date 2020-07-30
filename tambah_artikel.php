<?php
include 'connection.php';
session_start();

$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
$isPengurus = $_SESSION['jabatan'] == 2;


if (!$isLoggedIn) {
 header('Location: login.php');
}
else if (!$isPengurus) {
 header('Location: profil_ads.php');
}
else{
if (isset($_POST['submit'])) {
  $id_user         = $_SESSION['id_user'];
  $judul_artikel        = $_POST['judul_artikel'];
  $ringkasan_artikel      = $_POST['ringkasan_artikel'];
  $isi_artikel    = $_POST['isi_artikel'];
  $randomstring = substr(md5(rand()), 0, 7);

      //Image upload
 //if (isset($_FILES['image_uploads'])) {
   $target_dir  = "images/uploads/";
   $target_file = $target_dir .'ART_'.$id_user .'_'.$randomstring. '.jpg';
   move_uploaded_file($_FILES["image_uploads"]["tmp_name"], $target_file);    
 //}  
 $sqlartikel = "INSERT INTO tabel_artikel
                (id_user, judul_artikel, ringkasan_artikel, isi_artikel, gambar_artikel)
                VALUES (:id_user, :judul_artikel, :ringkasan_artikel, :isi_artikel, :gambar_artikel)";

  $stmt = $pdo->prepare($sqlartikel);
  $stmt->execute(['id_user' => $id_user, 'judul_artikel' => $judul_artikel, 'ringkasan_artikel' => $ringkasan_artikel, 'isi_artikel' => $isi_artikel, 'gambar_artikel' => $target_file]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   //echo "HAHAHAAHA INSERT FAILED !";
  } else {
   //echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: listing_artikel.php?status=addsuccess");
  }
 }




  //---image upload end

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
    <title>Tambah Artikel - Aplikasi AADS</title>
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
        <div class="col-sm-12 col-md-2">
            <!-- Vertical navbar -->
            <div class="vertical-nav-wrapper">
                <nav class="navbar">
                    

                    <ul class="programVmenu Vmenu navbar-nav">
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

                        <li class="nav-item">
                            <a href="tambah_artikel.php" class="nav-link vactive">
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
                            <h1>Tambah Artikel</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="judul_artikel">Judul Artikel:</label>
                                            <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" required
                                                aria-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="ringkasan_artikel">Ringkasan Artikel:</label>
                                            <input type="text" class="form-control" id="ringkasan_artikel" name="ringkasan_artikel" required
                                                aria-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="isi_artikel">Isi Artikel:</label>
                                            <textarea id="isi_artikel" name="isi_artikel" required></textarea>
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
                                        
                                        
                                        

                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Tambah Artikel">
                                    </form>

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
