<?php
include 'connection.php';
session_start();
$id_user    = $_SESSION['id_user'];
$nomor_user = $_SESSION['nomor_user'];
$msg        = "";
$id_program = $_GET['id_program'];

if (isset($_GET['status'])) {
 if ($_GET['status'] == 'updatesuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Edit Program Individu Berhasil.</strong>
        </div>";
 } else if ($_GET['status'] == 'addsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Tambah Catatan Harian Berhasil.</strong>
        </div>";
 }
}
//User & Program data query
$sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user AND id_program = :id_program';

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user, 'id_program' => $id_program]);
$row = $stmt->fetchAll();

$statusicon  = "";
$statusclass = "";
if ($row[0]->status_program == 'Pending') {
 $statusicon  = 'fas fa-hourglass-half';
 $statusclass = 'text-warning';
} else {
 $statusicon  = 'fas fa-check';
 $statusclass = 'text-success';
}

//-------User & Program data query end

//Catatan harian query

$sqlCatatan = 'SELECT * FROM tabel_catatan_harian
WHERE  id_program = :id_program ORDER BY tanggal_catatan DESC';

$stmt = $pdo->prepare($sqlCatatan);
$stmt->execute(['id_program' => $id_program]);
$rowCatatan = $stmt->fetchAll();

//-----Catatan harian query end
?>

<?php

//Edit Program query
if (isset($_POST['submit'])) {
 if ($_POST['submit'] == 'Simpan') {
  $namaprogram     = $_POST['nama_program'];
  $status_program  = $_POST['radiostatus'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
  if ($status_program == 'Pending') {
   $tanggal_selesai = null;
  }

  $tujuanprogram      = $_POST['tujuan_program'];
  $keadaansekarang    = $_POST['keadaan_sekarang'];
  $sasaranprogram     = $_POST['sasaran_program'];
  $sumbermateri       = $_POST['sumber_materi'];
  $pelaksanaanprogram = $_POST['cara_pelaksanaan'];
  $tanggaltarget      = $_POST['tanggal_target'];
  $kategoricheck      = implode(", ", $_POST['kategoricheck']);

  $sql3 = "UPDATE tabel_program
            SET nomor_user = :nu, nama_program = :np, status_program = :stp, tanggal_selesai = :ts, tujuan_program = :tp, keadaan_sekarang = :ks, sasaran_program = :sp, sumber_materi = :sm, cara_pelaksanaan = :cp, tanggal_target = :tt, kategori_program = :kp
            WHERE id_program = :id_program";

  $stmt = $pdo->prepare($sql3);
  $stmt->execute(['nu' => $nomor_user, 'np' => $namaprogram, 'stp' => $status_program, 'ts' => $tanggal_selesai, 'tp' => $tujuanprogram, 'ks' => $keadaansekarang, 'sp' => $sasaranprogram, 'sm' => $sumbermateri, 'cp' => $pelaksanaanprogram, 'tt' => $tanggaltarget, 'kp' => $kategoricheck, 'id_program' => $id_program]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "HAHAHAAHA UPDATE FAILED !";
  } else {
   echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: detail_program_individu.php?id_program=$id_program&status=updatesuccess");
  }

  //-----Edit Program end

  //Tambah Catatan Harian query
 } else if ($_POST['submit'] == 'Tambahkan') {
  $tanggal_catatan = $_POST['tanggal_catatan'];
  $kegiatan        = $_POST['kegiatan'];

  $sql4 = "INSERT INTO tabel_catatan_harian (id_program, tanggal_catatan, kegiatan)
            VALUES (:id_program, :tanggal_catatan, :kegiatan)";

  $stmt = $pdo->prepare($sql4);
  $stmt->execute(['id_program' => $id_program, 'tanggal_catatan' => $tanggal_catatan, 'kegiatan' => $kegiatan]);
  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "HAHAHAAHA INSERT FAILED !";
  } else {
   echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: detail_program_individu.php?id_program=$id_program&status=addsuccess");
  }

  //---------Tambah catatan harian end

 }

} else {
 echo "";
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
    <title>Detail Program Individu - Aplikasi AADS</title>
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
                            <a class="nav-link hactive" href="listing_ads.php"><i class="icon fas fa-child"></i>Kelola
                                ADS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listing_program.php"><i class="icon fas fa-tasks"></i>Kelola
                                Program</a>
                        </li>
                    </ul>

                    <!-- <ul class="guestHmenu navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="icon fas fa-home"></i>Beranda</a>
                        </li>
                    </ul> -->

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
                            <a class="nav-link" href="login.php"><i class="icon fas fa-sign-in-alt"></i>Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php"><i
                                    class="icon fas fa-user-plus"></i>Registrasi</a>
                        </li>
                    </ul>
                    <!-- <ul class="userlogout navbar-nav navbar-collapse">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon fas fa-sign-out-alt"></i>Log Out</a>
                        </li>
                    </ul> -->


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
                    <ul class="userVmenu navbar-nav">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list"></i><span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="edit_profil.php" class="nav-link">
                                <i class="icon fas fa-user-edit"></i><span class="vmenutext">Edit Profil Saya</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="program_individu.php" class="nav-link">
                                <i class="icon far fa-address-book"></i><span class="vmenutext">Program
                                    Individu Saya</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="detail_program_individu.php" class="nav-link vactive">
                                <i class="icon far fa-calendar-check"></i><span class="vmenutext">Detail Program &
                                    Catatan Harian</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="laporan_capaian.php" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Laporan Capaian</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="guestVmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link vactive">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing ADS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link vactive">
                                <i class="icon fas fa-sign"></i>
                                <span class="vmenutext">Log In</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil ADS</span>
                            </a>
                        </li> -->
                    </ul>


                </nav>
            </div>
            <!-- End of vertical navbar -->
        </div>

        <!-- Main content container -->
        <div class="col">
            <div class="container-fluid">
                <main>
                <?php echo $msg ?>
                    <div class="row">
                        <!-- Form Title -->
                        <div class="col">
                            <h1>Detail Program Individu & Catatan Harian</h1>
                        </div>
                    </div>

                    <div class="row" id="detailprogram">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <ul class="list-group" id="program-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <a class="backtoprofile font-weight-bold"
                                                                            href="profil_ads.php#program-list-search"><i
                                                                                class="fas fa-chevron-left"></i>Kembali
                                                                            ke profil</a>
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            <?php echo $row[0]->nama_program ?>
                                                                        </h5><a href="#" class="editlink"><button
                                                                                class="btn editbutton"
                                                                                data-toggle="modal"
                                                                                data-target="#editprogrammodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-pencil-alt"></i>Edit
                                                                                Program</button></a>
                                                                        <div class="container-fluid user-detail">
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 kodeprogram">
                                                                                    <p class="font-weight-bold">
                                                                                        Kode
                                                                                        Program</p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        <?php echo $row[0]->id_program ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 statusdetailprogram">
                                                                                    <p class="font-weight-bold">
                                                                                        Status
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12  content">
                                                                                    <p class="<?php echo $statusclass ?> status">
                                                                                        <i class="<?php echo $statusicon ?>"
                                                                                            aria-hidden="true"></i>
                                                                                        <b><?php echo $row[0]->status_program ?></b>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 namaadsdetail">
                                                                                    <p class="font-weight-bold">
                                                                                        Nama ADS
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        <?php echo $row[0]->nama_user ?> | <?php echo $row[0]->id_user ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tanggaltarget">
                                                                                    <p class="font-weight-bold">
                                                                                        Tanggal
                                                                                        Target
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p>
                                                                                        <?php echo $row[0]->tanggal_target ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tanggalselesai">
                                                                                    <p class="font-weight-bold">
                                                                                        Tanggal
                                                                                        Selesai
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12 content">
                                                                                    <p><?php if ($row[0]->tanggal_selesai == null) {
 echo " - ";
} else {
 echo $row[0]->tanggal_selesai;
}
?></p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 kategoridetail detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentkategori, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Kategori</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentkategori collapse contentall">
                                                                                    <p class="contentp"> <?php echo $row[0]->kategori_program ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 tujuan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contenttujuan, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Tujuan
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contenttujuan collapse contentall">
                                                                                    <p class="contentp"><?php echo $row[0]->tujuan_program ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 sasaran detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentsasaran, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Sasaran
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentsasaran  collapse contentall">
                                                                                    <p class="contentp"><?php echo $row[0]->tujuan_program ?></p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 keadaan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentkeadaan, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Keadaan
                                                                                        Sekarang</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentkeadaan collapse contentall">
                                                                                    <p class="contentp"><?php echo $row[0]->keadaan_sekarang ?></p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row  m-0">
                                                                                <div class="col-12 sumbermateri detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentsumber, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Sumber
                                                                                        Materi / Alat Peraga</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentsumber collapse contentall">
                                                                                    <p class="contentp"><?php echo $row[0]->sumber_materi ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row m-0">
                                                                                <div class="col-12 carapelaksanaan detailcollapser"
                                                                                    data-toggle="collapse"
                                                                                    data-target=".contentcara, .contentall">
                                                                                    <p
                                                                                        class="font-weight-bold fielddetail">
                                                                                        <i
                                                                                            class="icon fas fa-chevron-down"></i>
                                                                                        Cara
                                                                                        Pelaksanaan</p>
                                                                                </div>
                                                                                <div
                                                                                    class="col-12 contentcara collapse contentall">
                                                                                    <p class="contentp"><?php echo $row[0]->cara_pelaksanaan ?></p>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <!--End of list container -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>





                    <!-- CATATAN HARIAN -->
                    <div class="row" id="catatanharian">
                        <div class="col">
                            <div id="listingcards">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="card">
                                                <ul class="list-group" id="program-list">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <h5 class="font-weight-bold mb-1 namaprogram">
                                                                            Catatan Harian
                                                                        </h5><a href="#" class="editlink"><button
                                                                                class="btn editbutton"
                                                                                data-toggle="modal"
                                                                                data-target="#tambahcatatanmodal"
                                                                                data-backdrop="static"><i
                                                                                    class="icon fas fa-plus"></i>Tambah
                                                                                Catatan Harian</button></a>
                                                                        <div class="container-fluid user-detail">

                                                                        <?php
foreach ($rowCatatan as $rowitems) {
 echo "
                                                                        <div class='row  m-0 catatanentry'>
                                                                                <div class='col-sm-12 col-md-3'>
                                                                                    <p class='font-weight-bold'>
                                                                                        $rowitems->tanggal_catatan</p>
                                                                                </div>
                                                                                <div class='col-sm-12 col-md-6 content'>
                                                                                    <p>
                                                                                        $rowitems->kegiatan
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        ";
}
?>


                                                                        </div>
                                                                        <!--End of list container -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal fade" id="editprogrammodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Program Individu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="detail_program_individu.php?id_program=<?php echo $id_program ?>&status=addsuccess">
                                        <!-- <div class="form-group">
                                                                <label for="namaads">Nama ADS:</label>
                                                                <input type="text" class="form-control" id="namaads" required aria-required="true">
                                                            </div> -->

                                        <div class="form-group">
                                            <label for="namaprogram">Nama Program Individu:</label>
                                            <input type="text" class="form-control" id="namaprogram" name="nama_program" required
                                                aria-required="true" value="<?php echo $row[0]->nama_program ?>">
                                        </div>

                                        <label>Status:</label>
                                        <div class="form-group statusprogram" name="status_program">
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Pending" <?php if ($row[0]->status_program == 'Pending') {
 echo 'checked';
}
?>>Pending</label>
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Selesai" <?php if ($row[0]->status_program == 'Selesai') {
 echo 'checked';
}
?>
>Selesai</label>
                                        </div>

                                        <div class="form-group tanggalselesaitoggle" <?php if ($row[0]->status_program == 'Selesai') {
 echo 'style="display:block"';
}
?>>
                                            <label for="tanggalselesai">Tanggal Selesai:</label>
                                            <input type="date" class="form-control tanggal" id="tanggalselesai" name="tanggal_selesai"
                                                value="<?php echo $row[0]->tanggal_selesai ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="tujuanprogram">Tujuan:</label>
                                            <textarea class="form-control" id="tujuanprogram" rows="3" name="tujuan_program"
                                                required><?php echo $row[0]->tujuan_program ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="keadaansekarang">Keadaan Sekarang:</label>
                                            <textarea class="form-control" id="keadaansekarang" rows="3" name="keadaan_sekarang"
                                                required><?php echo $row[0]->keadaan_sekarang ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sasaranprogram">Sasaran:</label>
                                            <textarea class="form-control" id="sasaranprogram" rows="3" name="sasaran_program"
                                                required><?php echo $row[0]->sasaran_program ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sumberprogram">Sumber Materi / Alat Peraga:</label>
                                            <textarea class="form-control" id="sumbermateri" rows="3" name="sumber_materi"
                                                required><?php echo $row[0]->sumber_materi ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Cara Pelaksanaan:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="3" name="cara_pelaksanaan"
                                                required><?php echo $row[0]->cara_pelaksanaan ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggaltarget">Tanggal Target:</label>
                                            <input type="date" class="form-control tanggal" id="tanggaltarget" name="tanggal_target" required
                                                aria-required="true" value="<?php echo $row[0]->tanggal_target ?>">
                                        </div>

                                        <label>Kategori (Pilih minimal Satu):</label><br>
                                        <div class="form-group kategori">
<?php
$kognitifcheck    = "";
$motorikcheck     = "";
$sensorikcheck    = "";
$kemandiriancheck = "";
$sosialcheck      = "";
if (strpos($row[0]->kategori_program, "Kognitif") > -1) {
 $kognitifcheck = "checked";
}
if (strpos($row[0]->kategori_program, "Motorik") > -1) {
 $motorikcheck = "checked";
}
if (strpos($row[0]->kategori_program, "Sensorik") > -1) {
 $sensorikcheck = "checked";
}
if (strpos($row[0]->kategori_program, "Kemandirian") > -1) {
 $kemandiriancheck = "checked";
}
if (strpos($row[0]->kategori_program, "Sosial-Emosional") > -1) {
 $sosialcheck = "checked";
}
?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='kategoricheck[]'
                                                    value="Kognitif" <?php echo $kognitifcheck ?>>
                                                <label class="form-check-label" for="inlineCheckbox1">Kognitif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name='kategoricheck[]'
                                                    value="Motorik" <?php echo $motorikcheck ?>>
                                                <label class="form-check-label" for="inlineCheckbox2">Motorik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name='kategoricheck[]'
                                                    value="Sensorik" <?php echo $sensorikcheck ?>>
                                                <label class="form-check-label" for="inlineCheckbox3">Sensorik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name='kategoricheck[]'
                                                    value="Kemandirian" <?php echo $kemandiriancheck ?>>
                                                <label class="form-check-label"
                                                    for="inlineCheckbox3">Kemandirian</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name='kategoricheck[]'
                                                    value="Sosial-Emosional" <?php echo $sosialcheck ?>>
                                                <label class="form-check-label"
                                                    for="inlineCheckbox3">Sosial-Emosional</label>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Simpan"> <button
                                            type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="modal fade" id="tambahcatatanmodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan Harian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="detail_program_individu.php?id_program=<?php echo $id_program ?>&status=updatesuccess">
                                        <div class="form-group">
                                            <label for="tanggaltarget">Tanggal Kegiatan:</label>
                                            <input type="date" class="form-control tanggal" id="tanggaltarget" required
                                                aria-required="true" name="tanggal_catatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Deskripsi Kegiatan:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="3" name="kegiatan"
                                                required></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Tambahkan"><button
                                            type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Main Container end -->

                </main>
            </div>
        </div>
    </div>
    </div>
</body>


</html>