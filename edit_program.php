<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
$isPengurus = $_SESSION['jabatan'] == 2;

if ($isLoggedIn) {
 $id_user    = $_SESSION['id_user'];
 $nomor_user = $_SESSION['nomor_user'];
} else {
 header('Location: listing_program.php');
}

$id_program = $_GET['id_program'];
if(!$id_program){
    header('Location: listing_program.php');
}

//User & Program data query
$sql = 'SELECT * FROM tabel_program
WHERE id_program = :id_program';

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_program' => $id_program]);
$row = $stmt->fetch();

//-------User & Program data query end

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
            SET nama_program = :np, status_program = :stp, tanggal_selesai = :ts, tujuan_program = :tp, keadaan_sekarang = :ks, sasaran_program = :sp, sumber_materi = :sm, cara_pelaksanaan = :cp, tanggal_target = :tt, kategori_program = :kp
            WHERE id_program = :id_program";

  $stmt = $pdo->prepare($sql3);
  $stmt->execute(['np' => $namaprogram, 'stp' => $status_program, 'ts' => $tanggal_selesai, 'tp' => $tujuanprogram, 'ks' => $keadaansekarang, 'sp' => $sasaranprogram, 'sm' => $sumbermateri, 'cp' => $pelaksanaanprogram, 'tt' => $tanggaltarget, 'kp' => $kategoricheck, 'id_program' => $id_program]);
  header("Location: listing_program.php?status=updatesuccess");
 }
}

//-----Edit Program end
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
    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
    <script src="trumbowyg/dist/trumbowyg.min.js"></script>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program Individu - Aplikasi AADS</title>
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
                        <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil Saya</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="edit_profil.php" class="nav-link">
                                <i class="icon fas fa-user-edit"></i><span class="vmenutext">Edit Profil Saya</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="program_individu.php" class="nav-link">
                                <i class="icon far fa-address-book"></i><span class="vmenutext">Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="detail_program_individu.php" class="nav-link">
                                <i class="icon far fa-calendar-check"></i><span class="vmenutext">Detail Program &
                                    Catatan Harian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Laporan Capaian</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="guestVmenu navbar-nav d-none">
                        <li class="nav-item">
                            <a href="listing_ads.php" class="nav-link">
                                <i class="icon fas fa-list"></i>
                                <span class="vmenutext">Listing ADS</span>
                            </a>
                            <!-- <li class="nav-item">
                            <a href="profil_ads.php" class="nav-link">
                                <i class="icon far fa-address-card"></i><span class="vmenutext">Profil ADS</span>
                            </a>
                        </li> -->
                    </ul>

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
                        <li class="nav-item" <?php if(!$isPengurus) {echo 'style="display: none"';} ?>>
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
                            <h1>Edit Program Individu</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="POST" action="">

                                        <div class="form-group">
                                            <label for="namaprogram">Nama Program Individu:</label>
                                            <input type="text" class="form-control" id="namaprogram" name="nama_program" required
                                                aria-required="true" value="<?php echo $row->nama_program ?>">
                                        </div>

                                        <label>Status:</label>
                                        <div class="form-group statusprogram" name="status_program">
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Pending" <?php if ($row->status_program == 'Pending') {
 echo 'checked';
}
?>>Pending</label>
                                            <label class="radio-inline"><input type="radio" name="radiostatus"
                                                    value="Selesai" <?php if ($row->status_program == 'Selesai') {
 echo 'checked';
}
?>
>Selesai</label>
                                        </div>

                                        <div class="form-group tanggalselesaitoggle" <?php if ($row->status_program == 'Selesai') {
 echo 'style="display:block"';
}
?>>
                                            <label for="tanggalselesai">Tanggal Selesai:</label>
                                            <input type="date" class="form-control tanggal" id="tanggalselesai" name="tanggal_selesai"
                                                value="<?php echo $row->tanggal_selesai ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="tujuanprogram">Tujuan:</label>
                                            <textarea class="form-control" id="tujuanprogram" rows="3" name="tujuan_program"
                                                required><?php echo $row->tujuan_program ?></textarea>
                                                <script>
                                                $('#tujuanprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                                </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="keadaansekarang">Keadaan Sekarang:</label>
                                            <textarea class="form-control" id="keadaansekarang" rows="3" name="keadaan_sekarang"
                                                required><?php echo $row->keadaan_sekarang ?></textarea>
                                                <script>
                                                $('#keadaansekarang').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                                </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="sasaranprogram">Sasaran:</label>
                                            <textarea class="form-control" id="sasaranprogram" rows="3" name="sasaran_program"
                                                required><?php echo $row->sasaran_program ?></textarea>
                                                <script>
                                                $('#sasaranprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                                </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="sumberprogram">Sumber Materi / Alat Peraga:</label>
                                            <textarea class="form-control" id="sumbermateri" rows="3" name="sumber_materi"
                                                required><?php echo $row->sumber_materi ?></textarea>
                                                <script>
                                                $('#sumbermateri').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                                </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="pelaksanaanprogram">Cara Pelaksanaan:</label>
                                            <textarea class="form-control" id="pelaksanaanprogram" rows="3" name="cara_pelaksanaan"
                                                required><?php echo $row->cara_pelaksanaan ?></textarea>
                                                <script>
                                                $('#pelaksanaanprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                                </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggaltarget">Tanggal Target:</label>
                                            <input type="date" class="form-control tanggal" id="tanggaltarget" name="tanggal_target" required
                                                aria-required="true" value="<?php echo $row->tanggal_target ?>">
                                        </div>

                                        <label>Kategori (Pilih minimal Satu):</label><br>
                                        <div class="form-group kategori">
<?php
$kognitifcheck    = "";
$motorikcheck     = "";
$sensorikcheck    = "";
$kemandiriancheck = "";
$sosialcheck      = "";
if (strpos($row->kategori_program, "Kognitif") > -1) {
 $kognitifcheck = "checked";
}
if (strpos($row->kategori_program, "Motorik") > -1) {
 $motorikcheck = "checked";
}
if (strpos($row->kategori_program, "Sensorik") > -1) {
 $sensorikcheck = "checked";
}
if (strpos($row->kategori_program, "Kemandirian") > -1) {
 $kemandiriancheck = "checked";
}
if (strpos($row->kategori_program, "Sosial-Emosional") > -1) {
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

                                        <input type="submit" class="btn btn-primary mr-2" name="submit" value="Simpan"> 
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
</body>

</html>
