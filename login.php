<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if ($isLoggedIn) {
 header("Location: profil_ads.php");
} else {
 $msg = '';
 if (isset($_GET['status'])) {
  if ($_GET['status'] == 'regsuccess') {
   $msg = "<div class='alert alert-success' role='alert'>
        <strong>Registrasi berhasil.</strong> Silahkan Log in.
        </div>";
  }
 }

 if (isset($_POST['submit'])) {
  $username = $_POST['tbusername'];
  $pwd      = $_POST['tbpwd'];

  $sql  = 'SELECT username, pwd, id_user, nomor_user FROM tabel_user WHERE username = :username';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username]);
  $row = $stmt->fetch();

  if (!empty($row)) { // checks if the user actually exists(true/false returned)
   if (password_verify($pwd, $row->pwd)) {
    $_SESSION['my_id_user'] = $row->id_user;
    $_SESSION['id_user']    = $row->id_user;
    $_SESSION['nomor_user'] = $row->nomor_user;
    $_SESSION['jabatan']    = $row->jabatan;

    header('Location: profil_ads.php');

    // password_verify success!
   } else {
    $msg = "<div class='alert alert-warning' role='alert'>
        <strong>Username atau Password salah.</strong>
        </div>";

   }
  } else {
   $msg = "<div class='alert alert-warning' role='alert'>
        <strong>Username tidak terdaftar.</strong>
        </div>";
   //email entered does not match any in DB
  }
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

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Aplikasi AADS</title>
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
                            <a class="nav-link hactive" href="listing_program.php"><i
                                    class="icon fas fa-tasks"></i>Kelola Program</a>
                        </li>
                    </ul>

                    <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                    </ul>

                    <!-- Search form -->
                    <form class="form-inline ml-auto navbar-nav navbar-collapse">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 red-border" type="text" placeholder="Cari ADS..."
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search text-grey"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>

                    <ul class="userlogin navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link hactive" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log
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
                        <li class="nav-item">
                            <a href="listing_program.php" class="nav-link">
                                <i class="icon fas fa-list-ol"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        </li>
                    </ul>

                    <!-- <ul class="programVmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a href="listing_program.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing Program</span>
                            </a>
                        <li class="nav-item">
                            <a href="tambah_program.php" class="nav-link vactive">
                                <i class="icon far fa-plus-square"></i><span class="vmenutext">Tambah Program</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_program.php" class="nav-link">
                                <i class="icon far fa-edit"></i><span class="vmenutext">Edit Program</span>
                            </a>
                        </li>
                    </ul> -->
                </nav>
            </div>
            <!-- End of vertical navbar -->
        </div>

        <!-- Main content container -->
        <div class="col">
            <div class="container-fluid">
                <main>
<?php
echo $msg;
?>
                    <div class="row">
                        <!-- Form Title -->
                        <div class="col">
                            <h1>Form Log In</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="tbusername" required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="namaprogram">Password:</label>
                            <input type="password" class="form-control" id="password" name="tbpwd" required aria-required="true">
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"
                                    checked>
                                <label class="form-check-label" for="inlineCheckbox1">Ingat saya</label>
                            </div>
                        </div>

                        <!-- <button type="submit" class="btn btn-primary">Log In</button> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Log In">
                        <div class="suggestdaftar">
                            <a href="registrasi.php">Belum punya akun? Klik disini.</a>
                        </div>
                    </form>

            </div> <!-- Main Container end -->

            </main>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
