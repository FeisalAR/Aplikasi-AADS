
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

if(!$isPengurus){
    header("Location: index.php");
}
else{
    $_GET['tbkodeads'] = "";
    $_GET['tbpwd'] = "";
    $pwdbaru = "";
}

 if (isset($_POST['submit'])) {
 $kodeads       = $_POST['tbkodeads'];
 $pwdhash       = password_hash($_POST['tbpwd'], PASSWORD_DEFAULT);

  $sql4 = "UPDATE `tabel_user`
            SET `pwd` = :pwd
            WHERE `tabel_user`.`id_user` = :id_user";

  $stmt = $pdo->prepare($sql4);
  $stmt->execute(['id_user' => $kodeads, 'pwd' => $pwdhash]);
 }

 $msg = "";
if (isset($_GET['status'])) {
  if ($_GET['status'] == 'gantisukses') {
   $msg = "<div class='alert alert-success' role='alert'>
        <strong>Password telah diganti.</strong>
        </div>";
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

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - Aplikasi AADS</title>
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
                    <ul class="userHmenu navbar-nav d-none">
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

                    <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
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
                            <a href="listing_artikel.php" class="nav-link">
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
                        <?php
echo $msg;
?>
                            <h1>Form Ganti Password</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="pwdrecovery.php?status=gantisukses">
                    <div class="form-group">
                            <label for="tbkode">Kode ADS (ADS00xxx):</label>
                            <input type="text" class="form-control" id="password" name="tbkodeads" required aria-required="true">
                        </div>
                    <div class="form-group">
                            <label for="namaprogram">Password Baru:</label>
                            <input type="text" class="form-control" id="password" name="tbpwd" required aria-required="true">
                        </div>

                        <!-- <button type="submit" class="btn btn-primary">Log In</button> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Ganti Password"/>
                    </form>

                    <?php
             
                        
                    ?>

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
