<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);
$isPengurus = $_SESSION['jabatan'] == 2;

if ($isLoggedIn) {
 $id_user    = $_SESSION['id_user'];
 $nomor_user = $_SESSION['nomor_user'];
} else {
 header('Location: listing_ads.php');
}

$msg = "";

if (isset($_GET['status'])) {
 if ($_GET['status'] == 'editsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Edit Profil Berhasil.</strong>
        </div>";
 } else if ($_GET['status'] == 'addsuccess') {
  $msg = "<div class='alert alert-success' role='alert'>
        <strong>Tambah Program Individu Berhasil.</strong>
        </div>";
 }
}

$sqluser = 'SELECT * FROM tabel_user
WHERE id_user = :id_user';

$stmt = $pdo->prepare($sqluser);
$stmt->execute(['id_user' => $id_user]);
$rowuser = $stmt->fetch();

//Get program data

$sqlprogram = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user ORDER BY tanggal_target DESC';

$stmt = $pdo->prepare($sqlprogram);
$stmt->execute(['id_user' => $id_user]);
$row = $stmt->fetchAll();

//-------End get program data

?>

<?php
if (isset($_POST['submit'])) {
 if ($_POST['submit'] == 'Tambah Program') {
  $namaprogram        = $_POST['namaprogram'];
  $tujuanprogram      = $_POST['tujuanprogram'];
  $keadaansekarang    = $_POST['keadaansekarang'];
  //$sasaranprogram     = $_POST['sasaranprogram'];
  $sumbermateri       = $_POST['sumbermateri'];
  $pelaksanaanprogram = $_POST['pelaksanaanprogram'];
  $tanggaltarget      = $_POST['tanggaltarget'];
  $kategoricheck      = implode(", ", $_POST['kategoricheck']);

  $sql3 = "INSERT INTO tabel_program
                (nomor_user, nama_program, tujuan_program, keadaan_sekarang, sumber_materi, cara_pelaksanaan, tanggal_target, kategori_program)
                VALUES (:nu, :np, :tp, :ks, :sm, :cp, :tt, :kp)";

  $stmt = $pdo->prepare($sql3);
  $stmt->execute(['nu' => $nomor_user, 'np' => $namaprogram, 'tp' => $tujuanprogram, 'ks' => $keadaansekarang, 'sm' => $sumbermateri, 'cp' => $pelaksanaanprogram, 'tt' => $tanggaltarget, 'kp' => $kategoricheck]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   //echo "HAHAHAAHA INSERT FAILED !";
  } else {
   //echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: profil_ads.php?status=addsuccess");
  }

  //Profile Update

 } else if ($_POST['submit'] == 'Simpan') {
  $nama_user = $_POST['nama_user'];

  //Image upload
  if (isset($_FILES['image_uploads'])) {
   $target_dir  = "images/uploads/";
   $target_file = $target_dir . $id_user . '.jpg';
   move_uploaded_file($_FILES["image_uploads"]["tmp_name"], $target_file);

  }
  else if($_FILES["file"]["error"] == 4) {
      $target_file = "images/pfdefault.png";
  }

  //---image upload end

  $tanggal_lahir = $_POST['tanggal_lahir'];
  $jk            = $_POST['jenis_kelamin'];
  $nama_ortu     = $_POST['namaortu'];
  $email         = $_POST['email'];
  $notelepon     = $_POST['notelepon'];
  $alamat        = $_POST['alamat'];
  $kecamatan     = $_POST['kecamatan'];
  $kota          = $_POST['kota'];
  $kodepos       = $_POST['kodepos'];
  $nama_user     = $_POST['nama_user'];

  $sql4 = "UPDATE `tabel_user`
SET `email` = :email, `nama_user` = :nama, foto_profil = :fp, `tanggal_lahir` = :tlahir, `jenis_kelamin` = :jk, `nama_orang_tua` = :ortu, `nomor_telepon` = :notelp, `alamat` = :alamat, `kecamatan` = :kecamatan, `kota` = :kota, `kode_pos` = :kodepos
WHERE `tabel_user`.`nomor_user` = :nomor_user";

  $stmt = $pdo->prepare($sql4);
  $stmt->execute(['nomor_user' => $nomor_user, 'fp' => $target_file, 'email' => $email, 'nama' => $nama_user, 'tlahir' => $tanggal_lahir, 'jk' => $jk, 'ortu' => $nama_ortu, 'notelp' => $notelepon, 'alamat' => $alamat, 'kecamatan' => $kecamatan, 'kota' => $kota, 'kodepos' => $kodepos]);
  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "";
  } else {
   //echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: profil_ads.php?status=editsuccess");
  }

 }

 //----------Profile update end

} else {
 echo "";
}

function ageCalculator($dob){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        if ($ag == 0)
        {
            return "$mn Bulan  $dy Hari";            
        }
        else
        {
            return "$ag Tahun $mn Bulan $dy Hari";
        }  
        
}

function ageCompletedCalculator($dob, $tanggalselesai){
        $birthdate = new DateTime($dob);
        $today   = new DateTime($tanggalselesai);
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        if ($ag == 0)
        {
            return "$mn Bulan  $dy Hari";            
        }
        else
        {
            return "$ag Tahun $mn Bulan $dy Hari";
        }        
    }



?>




<!DOCTYPE html>
<html lang='en'>

<head>
    <script src='js/jquery-3.4.1.js'></script>
    <script src='js/bootstrap.js'></script>
    <script src='js/popper.js'></script>
    <link rel='stylesheet' type='text/css' href='css/bootstrap.css' />
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' href='css/all.css' />
    <script src='js/script.js'></script>
    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
    <script src="trumbowyg/dist/trumbowyg.min.js"></script>

    <link rel='icon' href='favicon.ico' type='image/x-icon' />

    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Profil & Program Individu - Aplikasi AADS</title>
</head>

<body>

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


    <img class='dnapic' src='images/dnabg.png' alt='dnapic'>
    <div class='container-fluid'>
        <!-- Horizontal Navbar -->
        <div class='nav-wrapper'>
            <nav class='navbar navbar-expand-lg navbar-toggleable-lg hnavbar'>
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
                <div class='row buttonlogo'>
                    <div class='col togglebutton'>
                        <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse'
                            data-target='#HnavbarToggler'>
                            <span class='navbar-toggler-icon'><i class='fa fa-bars'></i></span>
                        </button>
                    </div>


                </div>


                <div class='collapse navbar-collapse' id='HnavbarToggler'>
                    <!-- Links -->
                    <ul class='userHmenu navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'><i class='icon fas fa-home'></i>Beranda</a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class='nav-link hactive' href='listing_ads.php'><i class='icon fas fa-child'></i>Kelola
                                ADS</a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class='nav-link' href='listing_program.php'><i class='icon fas fa-tasks'></i>Kelola
                                Program</a>
                        </li>
                    </ul>


                    <ul class='userlogin navbar-nav navbar-collapse' <?php if ($isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                        <li class='nav-item'>
                            <a class='nav-link' href='login.php'><i class='icon fas fa-sign-in-alt'></i>Log In</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='registrasi.php'><i
                                    class='icon fas fa-user-plus'></i>Registrasi</a>
                        </li>
                    </ul>
                    <ul class='userlogout navbar-nav navbar-collapse'>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a class='nav-link' href='logout.php'><i class='icon fas fa-sign-out-alt'></i>Log Out</a>
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

    <div class='vnavcontent row'>
        <div class='col-sm-12 col-md-2'>
            <!-- Vertical navbar -->
            <div class='vertical-nav-wrapper'>
                <nav class='navbar'>
                    <ul class='userVmenu Vmenu navbar-nav'>
                        <li class='nav-item'>
                            <a href='listing_ads.php' class='nav-link'>
                                <i class='icon fas fa-list'></i><span class='vmenutext'>Listing ADS</span>
                            </a>
                        </li>
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='profil_ads.php' class='nav-link vactive'>
                                <i class='icon far fa-address-card'></i><span class='vmenutext'>Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>

                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='laporan_capaian.php' class='nav-link'>
                                <i class='icon fas fa-chart-line'></i><span class='vmenutext'>Laporan Capaian</span>
                            </a>
                        </li>
                         <li class="nav-item" >
                            <a href="standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-bar"></i><span class="vmenutext">Standar Perkembangan Anak</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-line"></i><span class="vmenutext">Standar Perkembangan Anak</span>
                            </a>
                        </li> -->
                    </ul>

                </nav>
            </div>
            <!-- End of vertical navbar -->
        </div>

        <!-- Main content container -->
        <div class='col'>
            <div class='container-fluid'>
                <main>
<?php
echo $msg;
?>
                    <div class='row'>
                        <!-- Form Title -->
                        <div class='col'>
                            <h1>Profil Saya<?php if ($isPengurus) {
 echo ' (Pengurus)';
}
?></h1>
                        </div>
                    </div>

                    <div class='col btntambahprogram mb-2'>
                        <a href='#'><button type='submit' data-toggle='modal' data-target='#editprofilmodal' id="btneditprofil"
                                data-backdrop='static' class='btn btn-primary mt-3 mb-2'><i
                                    class='fas fa-pencil-alt'></i>Edit Profil</button></a>
                    </div>
                    <!-- Form fields -->
                    <div class='row'>
                        <div class='col'>
                            <div id='listingcards'>
                                <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col col-12'>
                                            <div class='card'>
                                                <ul class='list-group' id='user-list-profile'>
                                                    <li class='list-group-item' id="profilbox">
                                                        <div class='row'>
                                                            <div class='col-md-12 col-12'>
                                                                <div class='row'>
                                                                    <div
                                                                        class='col-sm-12 col-md-3 user-img text-center pt-1'>
                                                                        <img src='<?php echo $rowuser->foto_profil ?>'
                                                                            alt='Foto Profil'
                                                                            class='img-responsive img-circle rounded-circle' onerror="this.src='images/pfdefault.png';"/>
                                                                    </div>
                                                                    <div class='col-sm-6 col-md-4'>
                                                                        <h5 class='font-weight-bold mb-1 namaads'>
                                                                            <?php echo $rowuser->nama_user; ?>
                                                                        </h5>
                                                                        <div class='user-detail'>
                                                                            <p class='m-0  kodeads'><i
                                                                                    class='fas fa-key mr-1'></i><?php echo $rowuser->id_user; ?>

                                                                            </p>
                                                                            <p class='m-0 '><i
                                                                                    class='fas fa-birthday-cake mr-1'
                                                                                    aria-hidden='true'></i><span class="bdads"> <?php echo date("j F Y",strtotime($rowuser->tanggal_lahir)); ?>
                                                                            </span>
                                                                            </p>
                                                                            <p class='m-0 '><i
                                                                                    class='fas fa-user-clock mr-1'
                                                                                    aria-hidden='true'></i><span class="umurads"> <?php echo ageCalculator($rowuser->tanggal_lahir) ?>
                                                                            </span>
                                                                            </p>
                                                                            <?php
                                                                                if($rowuser->jenis_kelamin == "Laki-laki"){
                                                                                    $jkicon = "mars";
                                                                                }
                                                                                else{
                                                                                    $jkicon = "venus";
                                                                                }
                                                                            ?>
                                                                            <p class="m-0"><i class="fas fa-<?php echo $jkicon?> mr-1"
                                                                                    aria-hidden="true"></i>
                                                                                <?php echo $rowuser->jenis_kelamin ?>
                                                                                </p>
                                                                            <p class='m-0'><i
                                                                                    class='fa fa-user-friends mr-1 ortuads'></i><?php echo $rowuser->nama_orang_tua; ?>
</p>
                                                                            <p hidden class='m-0 text-warning status'><i
                                                                                    class='fas fa-hourglass-half'
                                                                                    aria-hidden='true'></i>
                                                                                <b>PendingSelesai</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>


                                                                    <div class='col-sm-6 col-md-4'>
                                                                        <div class='user-detail'>
                                                                            <p class='m-0  alamatads'><i
                                                                                    class='fas fa-home mr-1'></i><?php echo $rowuser->alamat; ?>

                                                                            </p>
                                                                            <p class='m-0  kecamatan'><i
                                                                                    class='fas fa-landmark mr-1'></i><?php echo $rowuser->kecamatan . ', ' . $rowuser->kota; ?>

                                                                            </p>
                                                                            <p class='m-0  kodepos'><i
                                                                                    class='fas fa-envelope mr-1'></i><?php echo $rowuser->kode_pos; ?>

                                                                            </p>
                                                                            <p class='m-0  emailads'><i
                                                                                    class='fas fa-at mr-1'></i><?php echo $rowuser->email; ?>

                                                                            </p>
                                                                            <p class='m-0  teleponads'><i
                                                                                    class='fas fa-phone mr-1'></i><?php echo $rowuser->nomor_telepon; ?>

                                                                            </p>
                                                                        </div>
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


                    <div class='row programads'>
                        <!-- Form Title -->
                        <div class='col' id='#programanchor'>
                            <h2 class='mt-4'>Daftar Program Individu</h2>
                        </div>
                    </div>

                    <div class='row programfilters'>
                        <div class='col btntambahprogram mb-2'>
                            <a href='#'><button type='submit' data-toggle='modal' data-target='#tambahprogrammodal'
                                    data-backdrop='static' class='btn btn-primary mt-3 mb-2'><i
                                        class='fas fa-plus'></i>Tambah
                                    Program Individu</button></a>
                        </div>

                        <div class='col-md-8'>
                            <label class='font-weight-bold'>Status:</label>
                            <div class='form-group filterstatusprogram mb-0'>
                                <label class='radio-inline mr-2'><input type='radio' name='radiofilterstatus'
                                        value='Semua' checked>Semua</label>
                                <label class='radio-inline mr-2'><input type='radio' name='radiofilterstatus'
                                        value='Pending'>Pending</label>
                                <label class='radio-inline mr-2'><input type='radio' name='radiofilterstatus'
                                        value='Selesai'>Selesai</label>
                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col'>
                            <div id='listingcards'>
                                <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col col-12'>
                                            <div class='card'>
                                                <div class='row search-div' style='display: block;'>
                                                    <div class='col-md-12 col-12'>
                                                        <div class='search-input'>
                                                            <input type='text' class='form-control rounded-0'
                                                                placeholder='&#xF002;   Cari Kode Program atau Nama Program...'
                                                                aria-label='Recipient's username'
                                                                style='font-family: Montserrat, FontAwesome;'
                                                                aria-describedby='basic-addon2'
                                                                id='program-list-search'>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class='list-group' id='program-list'>

<?php
foreach ($row as $rowitems) {
 $statusicon;
 $statusclass;


if(!empty($tanggalselesai)){
     
}
 

$tanggalselesaif = date("j F Y",strtotime($rowitems->tanggal_selesai));

 if ($rowitems->status_program == 'Pending') {
    $statusicon  = 'fas fa-hourglass-half';
    $statusclass = 'text-warning';
    $tanggalselisih = "";
    $tanggalselesai = "";
 } else {
  $statusicon  = 'fas fa-check';
  $statusclass = 'text-success';
  $tanggalselesai = $rowitems->tanggal_selesai;    
    $umurselesai = ageCompletedCalculator($rowitems->tanggal_lahir, $tanggalselesai);
  $tanggalselisih = "Pada: $tanggalselesaif (Umur $umurselesai)
                                          ";
 }
 

 $tanggaltargetf = date("j F Y",strtotime($rowitems->tanggal_target));

 echo "<li class='list-group-item'>
                                                    <div class='row'>
                                                        <div class='col-md-12 col-12'>
                                                            <div class='row'>

                                                                <div class='col-md-12 col-12'>
                                                                    <h5 class='font-weight-bold mb-1 namaprogram'>
                                                                        $rowitems->nama_program
                                                                    </h5>
                                                                    <div class='user-detail'>
                                                                        <p class='m-0 $statusclass status'><i
                                                                                class='fas $statusicon
                                                                                aria-hidden='true'></i>
                                                                            <b>$rowitems->status_program</b>
                                                                        </p>
                                                                        $tanggalselisih
                                                                        <p class='m-0'><i
                                                                                class='fas fa-calendar mr-1'
                                                                                aria-hidden='true'></i><span class='targetdate'>Target: $tanggaltargetf</span>
                                                                        </p>                                                                    
                                                                        

                                                                        <p class='m-0 kodeprogram'><i
                                                                                class='fas fa-key mr-1'></i>$rowitems->id_program
                                                                        </p>
                                                                        <p class='m-0 kodeprogram'><i
                                                                                class='fas fa-bullseye mr-1'></i>Tujuan: $rowitems->tujuan_program
                                                                        </p>
                                                                        <a
                                                                            href='detail_program_individu.php?id_program=$rowitems->id_program'>
                                                                            <button class='btn btndetail'>
                                                                                <i class='fas fa-external-link-square-alt mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                Lihat Detail
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





                    <div class='modal fade' id='tambahprogrammodal' tabindex='-1' role='dialog'
                        aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Tambah Program Individu</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <form method="POST" action='profil_ads.php'>
                                        <div class='form-group'>
                                            <label for='namaprogram'>Nama Program Individu:</label>
                                            <input type='text' class='form-control' id='namaprogram' name='namaprogram' required
                                                aria-required='true'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='tujuanprogram'>Tujuan:</label>
                                            <textarea class='form-control' id='tujuanprogram' name='tujuanprogram' rows='3'
                                                required></textarea>
                                                <script>
                                                $('#tujuanprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                        </script>
                                        </div>
                                        <div class='form-group'>
                                            <label for='keadaansekarang'>Keadaan Sekarang:</label>
                                            <textarea class='form-control' id='keadaansekarang' name='keadaansekarang' rows='3'
                                                required></textarea>
                                                <script>
                                                $('#keadaansekarang').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                        </script>
                                        </div>
                                        <!-- <div class='form-group'>
                                            <label for='sasaranprogram'>Sasaran:</label>
                                            <textarea class='form-control' id='sasaranprogram' name='sasaranprogram' rows='3'
                                                required></textarea>
                                                <script>
                                                $('#sasaranprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                        </script>
                                        </div> -->
                                        <div class='form-group'>
                                            <label for='sumbermateri'>Sumber Materi / Alat Peraga:</label>
                                            <textarea class='form-control' id='sumbermateri' name='sumbermateri' rows='3'
                                                required></textarea>
                                                <script>
                                                $('#sumbermateri').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                        </script>
                                        </div>
                                        <div class='form-group'>
                                            <label for='pelaksanaanprogram'>Cara Pelaksanaan:</label>
                                            <textarea class='form-control' id='pelaksanaanprogram' name='pelaksanaanprogram' rows='3'
                                                required></textarea>
                                                <script>
                                                $('#pelaksanaanprogram').trumbowyg({
                                                btns: [['bold', 'italic'], ['undo', 'redo'], ['unorderedList', 'orderedList'],
                                                ['horizontalRule']]
                                                });
                                        </script>
                                        </div>
                                        <div class='form-group'>
                                            <label for='tanggaltarget'>Tanggal Target:</label>
                                            <input type='date' class='form-control tanggal' id='tanggaltarget' name='tanggaltarget' required
                                                aria-required='true'>
                                        </div>

                                        <label>Kategori (Pilih minimal Satu):</label><br>
                                        <div class='form-group kategori'>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='checkbox' id='inlineCheckbox1' name='kategoricheck[]'
                                                    value='Kognitif' checked>
                                                <label class='form-check-label' for='inlineCheckbox1'>Kognitif</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='checkbox' id='inlineCheckbox2' name='kategoricheck[]'
                                                    value='Motorik'>
                                                <label class='form-check-label' for='inlineCheckbox2'>Motorik</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='checkbox' id='inlineCheckbox3' name='kategoricheck[]'
                                                    value='Sensorik'>
                                                <label class='form-check-label' for='inlineCheckbox3'>Sensorik</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='checkbox' id='inlineCheckbox3'name='kategoricheck[]'
                                                    value='Kemandirian'>
                                                <label class='form-check-label'
                                                    for='inlineCheckbox3'>Kemandirian</label>
                                            </div>
                                            <div class='form-check form-check-inline'>
                                                <input class='form-check-input' type='checkbox' id='inlineCheckbox3'name='kategoricheck[]'
                                                    value='Sosial-Emosional'>
                                                <label class='form-check-label'
                                                    for='inlineCheckbox3'>Sosial-Emosional</label>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary" name="submit" value="Tambah Program">
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class='modal fade' id='editprofilmodal' tabindex='-1' role='dialog'
                        aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Edit Profil</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <form method="POST" enctype="multipart/form-data" action='profil_ads.php'>
                                        <div class='form-group'>
                                            <label for='namaads'>Nama:</label>
                                            <input type='text' class='form-control' id='nama_user' name='nama_user' required
                                                aria-required='true' value="<?php echo $rowuser->nama_user ?>">
                                        </div>

                                        <label>Foto Profil</label>
                                        <div class='form-group' id='fotoprofil'>
                                            <div>
                                                <label for='image_uploads'>Pilih Foto</label>
                                                <input type='file'  class='form-control' id='image_uploads'
                                                    name='image_uploads' accept='.jpg, .jpeg, .png'>
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <label for='tanggallahir'>Tanggal Lahir:</label>
                                            <input type='date' class='form-control tanggal' id='tanggallahir' name='tanggal_lahir' required
                                                aria-required='true' value="<?php echo $rowuser->tanggal_lahir ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='jeniskelamin'>Jenis Kelamin:</label>
                                            <select class='form-control' id='jeniskelamin' name='jenis_kelamin' value="<?php echo $rowuser->jenis_kelamin ?>">
                                                <option <?php if ($rowuser->jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                                <option <?php if ($rowuser->jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class='form-group'>
                                            <label for='namaortu'>Nama Orang Tua:</label>
                                            <input type='text' class='form-control' id='namaortu' name='namaortu' required
                                                aria-required='true' value="<?php echo $rowuser->nama_orang_tua ?>">
                                        </div>
                                        <div class='form-group'>
                                            <label for='email'>E-mail:</label>
                                            <input type='email' class='form-control' id='email' name='email' required
                                                aria-required='true' value="<?php echo $rowuser->email ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='notelepon'>No. Telepon / Handphone:</label>
                                            <input type='number' class='form-control' id='notelepon' name='notelepon' required
                                                aria-required='true' value="<?php echo $rowuser->nomor_telepon ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='alamat'>Alamat:</label>
                                            <textarea class='form-control' id='alamat' rows='3' name='alamat'><?php echo $rowuser->alamat ?>
</textarea>
                                        </div>

                                        <div class='form-group'>
                                            <label for='kecamatan'>Kecamatan:</label>
                                            <input type='text' class='form-control' id='kecamatan' name='kecamatan' value="<?php echo $rowuser->kecamatan ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='kota'>Kecamatan:</label>
                                            <input type='text' class='form-control' id='kota' name='kota' value="<?php echo $rowuser->kota ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='kodepos'>Kode Pos:</label>
                                            <input type='number' class='form-control' id='kodepos' name='kodepos' value="<?php echo $rowuser->kode_pos ?>">
                                        </div>

                                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                                        <button
                                            type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
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
