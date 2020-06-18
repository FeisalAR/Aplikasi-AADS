<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if ($isLoggedIn) {
 header("Location: profil_ads.php");
} else {
 if (isset($_POST['submit'])) {
  $nama         = $_POST['tbnama'];
  $email        = $_POST['tbemail'];
  $username     = $_POST['tbusername'];
  $pwd          = password_hash($_POST['tbpwd'], PASSWORD_DEFAULT);
  $tanggallahir = $_POST['tanggallahir'];
  $jk           = $_POST['optjk'];
  $ortu         = $_POST['tbortu'];
  $telepon      = $_POST['tbtelepon'];
  $nama         = $_POST['tbnama'];
  $alamat       = $_POST['txtalamat'];
  $kecamatan    = $_POST['tbkecamatan'];
  $kota         = $_POST['tbkota'];
  $kodepos      = $_POST['tbkodepos'];
  $jabatan = 1;

  $sql = 'INSERT INTO tabel_user (username, pwd, email, nama_user, tanggal_lahir, jenis_kelamin, nama_orang_tua, nomor_telepon, alamat, kecamatan, kota, kode_pos, jabatan)
VALUES (:username, :pwd, :email, :nama_user, :tanggal_lahir, :jenis_kelamin, :nama_orang_tua, :nomor_telepon, :alamat, :kecamatan, :kota, :kode_pos, :jabatan)';

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username, 'pwd' => $pwd, 'email' => $email, 'nama_user' => $nama, 'tanggal_lahir' => $tanggallahir, 'jenis_kelamin' => $jk, 'nama_orang_tua' => $ortu, 'nomor_telepon' => $telepon, 'alamat' => $alamat, 'kecamatan' => $kecamatan, 'kota' => $kota, 'kode_pos' => $kodepos, 'jabatan' => $jabatan]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "Failed !";
  } else {
   header('Location: login.php?status=regsuccess');
  }

 } else {
  echo '';

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
    <title>Form Registrasi - Aplikasi AADS</title>
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
                            <a class="nav-link" href="listing_program.php"><i class="icon fas fa-tasks"></i>Kelola
                                Program</a>
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
                    <ul class="guestlogin navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hactive" href="registrasi.php"><i
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
                            <h1>Form Registrasi</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="registrasi.php">
                        <div class="form-group">
                            <label for="namaads">Nama ADS:</label>
                            <input type="text" class="form-control" id="namaads" name="tbnama" required aria-required="true" pattern="[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z.]*)*$" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="tbemail" required aria-required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="tbusername"  required aria-required="true" pattern="^(?=.{5,60}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$" title="Minimum 5 karakter">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="tbpwd"  required aria-required="true" minlength="6">
                        </div>

                        <div class="form-group">
                            <label for="tanggallahir">Tanggal Lahir:</label>
                            <input type="date" class="form-control tanggal" id="tanggallahir"  name="tanggallahir"  required
                                aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="jeniskelamin">Jenis Kelamin:</label>
                            <select class="form-control" id="jeniskelamin"  name="optjk" >
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="namaortu">Nama Orang Tua:</label>
                            <input type="text" class="form-control" id="namaortu" name="tbortu"  required aria-required="true" pattern="[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z.]*)*$">
                        </div>

                        <div class="form-group">
                            <label for="notelepon">No. Telepon / Handphone:</label>
                            <input type="number" class="form-control" id="notelepon" name="tbtelepon"  required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="txtalamat" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="kecamatan">Kecamatan:</label>
                            <input type="text" class="form-control" id="kecamatan" name="tbkecamatan" pattern="[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z.]*)*$">
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota:</label>
                            <input type="text" class="form-control" id="kota" name="tbkota" pattern="[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z.]*)*$">
                        </div>

                        <div class="form-group">
                            <label for="kodepos">Kode Pos:</label>
                            <input type="number" class="form-control" id="kodepos" name="tbkodepos" >
                        </div>

                        <!-- <button type="submit" name="submit" class="btn btn-primary">Submit</button> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Daftar">
                    </form>

            </div> <!-- Main Container end -->

            </main>
        </div>
    </div>
    </div>
    </div>
</body>


</html>
