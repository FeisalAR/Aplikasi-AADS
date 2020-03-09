<?php
include 'connection.php';
session_start();
$id_user    = $_SESSION['id_user'];
$nomor_user = $_SESSION['nomor_user'];
$msg        = "";

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

$sql = 'SELECT * FROM tabel_user
INNER JOIN tabel_program ON tabel_user.nomor_user = tabel_program.nomor_user
WHERE tabel_user.id_user = :id_user ORDER BY tanggal_target DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$row = $stmt->fetchAll();

?>

<?php
if (isset($_POST['submit'])) {
 if ($_POST['submit'] == 'Tambah Program') {
  $namaprogram        = $_POST['namaprogram'];
  $tujuanprogram      = $_POST['tujuanprogram'];
  $keadaansekarang    = $_POST['keadaansekarang'];
  $sasaranprogram     = $_POST['sasaranprogram'];
  $sumbermateri       = $_POST['sumbermateri'];
  $pelaksanaanprogram = $_POST['pelaksanaanprogram'];
  $tanggaltarget      = $_POST['tanggaltarget'];
  $kategoricheck      = implode(", ", $_POST['kategoricheck']);

  $sql3 = "INSERT INTO tabel_program
                (nomor_user, nama_program, tujuan_program, keadaan_sekarang, sasaran_program, sumber_materi, cara_pelaksanaan, tanggal_target, kategori_program)
                VALUES (:nu, :np, :tp, :ks, :sp, :sm, :cp, :tt, :kp)";

  $stmt = $pdo->prepare($sql3);
  $stmt->execute(['nu' => $nomor_user, 'np' => $namaprogram, 'tp' => $tujuanprogram, 'ks' => $keadaansekarang, 'sp' => $sasaranprogram, 'sm' => $sumbermateri, 'cp' => $pelaksanaanprogram, 'tt' => $tanggaltarget, 'kp' => $kategoricheck]);

  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "HAHAHAAHA INSERT FAILED !";
  } else {
   echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: profil_ads.php?status=addsuccess");
  }

 } else if ($_POST['submit'] == 'Simpan') {
  $nama_user     = $_POST['nama_user'];
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
SET `email` = :email, `nama_user` = :nama, `tanggal_lahir` = :tlahir, `jenis_kelamin` = :jk, `nama_orang_tua` = :ortu, `nomor_telepon` = :notelp, `alamat` = :alamat, `kecamatan` = :kecamatan, `kota` = :kota, `kode_pos` = :kodepos
WHERE `tabel_user`.`nomor_user` = :nomor_user";

  $stmt = $pdo->prepare($sql4);
  $stmt->execute(['nomor_user' => $nomor_user, 'email' => $email, 'nama' => $nama_user, 'tlahir' => $tanggal_lahir, 'jk' => $jk, 'ortu' => $nama_ortu, 'notelp' => $notelepon, 'alamat' => $alamat, 'kecamatan' => $kecamatan, 'kota' => $kota, 'kodepos' => $kodepos]);
  $affectedrows = $stmt->rowCount();
  if ($affectedrows == '0') {
   echo "HAHAHAAHA UPDATE FAILED !";
  } else {
   echo "HAHAHAAHA GREAT SUCCESSS !";
   header("Location: profil_ads.php?status=editsuccess");
  }

 }

} else {
 echo "";
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

    <link rel='icon' href='favicon.ico' type='image/x-icon' />

    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Profil & Program Individu - Aplikasi AADS</title>
</head>

<body>

    <img class='dnapic' src='images/dnabg.png' alt='dnapic'>
    <div class='container-fluid'>
        <!-- Horizontal Navbar -->
        <div class='nav-wrapper'>
            <nav class='navbar navbar-expand-lg navbar-toggleable-lg hnavbar'>
                <div class='row buttonlogo'>
                    <div class='col togglebutton'>
                        <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse'
                            data-target='#HnavbarToggler'>
                            <span class='navbar-toggler-icon'><i class='fa fa-bars'></i></span>
                        </button>
                    </div>
                    <div class='col-6'>
                        <!-- Brand -->
                        <a class='navbar-brand navbar-nav navbar-collapse' href='index.php'>
                            <img src='images/logo.png' alt='Logo'>
                        </a>
                    </div>


                </div>


                <div class='collapse navbar-collapse' id='HnavbarToggler'>
                    <!-- Links -->
                    <ul class='userHmenu navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'><i class='icon fas fa-home'></i>Beranda</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link hactive' href='listing_ads.php'><i class='icon fas fa-child'></i>Kelola
                                ADS</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='listing_program.php'><i class='icon fas fa-tasks'></i>Kelola
                                Program</a>
                        </li>
                    </ul>

                    <!-- <ul class='guestHmenu navbar-nav navbar-collapse'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'><i class='icon fas fa-home'></i>Beranda</a>
                        </li>
                    </ul> -->

                    <!-- Search form -->
                    <form class='form-inline ml-auto navbar-nav navbar-collapse'>
                        <div class='input-group md-form form-sm form-2 pl-0'>
                            <input class='form-control my-0 py-1 red-border' type='text' placeholder='Cari ADS...'
                                aria-label='Search'>
                            <div class='input-group-append'>
                                <button class='btn btn-success' type='submit'><i class='fas fa-search text-grey'
                                        aria-hidden='true'></i></button>
                            </div>
                        </div>
                    </form>

                    <ul class='userlogin navbar-nav navbar-collapse'>
                        <li class='nav-item'>
                            <a class='nav-link' href='login.php'><i class='icon fas fa-sign-in-alt'></i>Log In</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='registrasi.php'><i
                                    class='icon fas fa-user-plus'></i>Registrasi</a>
                        </li>
                    </ul>
                    <!-- <ul class='userlogout navbar-nav navbar-collapse'>
                        <li class='nav-item'>
                            <a class='nav-link' href='#'><i class='icon fas fa-sign-out-alt'></i>Log Out</a>
                        </li>
                    </ul> -->


                </div>


            </nav>
        </div>
    </div>
    <!-- End of Horizontal Navbar -->

    <div class='vnavcontent row'>
        <div class='col-2'>
            <!-- Vertical navbar -->
            <div class='vertical-nav-wrapper'>
                <nav class='navbar'>
                    <ul class='userVmenu navbar-nav'>
                        <li class='nav-item'>
                            <a href='listing_ads.php' class='nav-link'>
                                <i class='icon fas fa-list'></i><span class='vmenutext'>Listing ADS</span>
                            </a>
                        </li>
                        <li class='nav-item'>
                            <a href='profil_ads.php' class='nav-link vactive'>
                                <i class='icon far fa-address-card'></i><span class='vmenutext'>Profil & Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <!-- <li class='nav-item'>
                            <a href='program_individu.php' class='nav-link'>
                                <i class='icon far fa-address-book'></i><span class='vmenutext'>Program
                                    Individu Saya</span>
                            </a>
                        </li>
                        <li class='nav-item'>
                            <a href='detail_program_individu.php' class='nav-link'>
                                <i class='icon far fa-calendar-check'></i><span class='vmenutext'>Detail Program &
                                    Catatan Harian</span>
                            </a>
                        </li> -->
                        <li class='nav-item'>
                            <a href='laporan_capaian.php' class='nav-link'>
                                <i class='icon fas fa-chart-line'></i><span class='vmenutext'>Laporan Capaian</span>
                            </a>
                        </li>
                    </ul>

                    <ul class='guestVmenu navbar-nav d-none'>
                        <li class='nav-item'>
                            <a href='listing_ads.php' class='nav-link vactive'>
                                <i class='icon fas fa-list'></i>
                                <span class='vmenutext'>Listing ADS</span>
                            </a>
                        <li class='nav-item'>
                            <a href='profil_ads.php' class='nav-link'>
                                <i class='icon far fa-address-card'></i><span class='vmenutext'>Profil ADS</span>
                            </a>
                        </li>
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
                            <h1>Profil Saya</h1>
                        </div>
                    </div>

                    <div class='col btntambahprogram mb-2'>
                        <a href='#'><button type='submit' data-toggle='modal' data-target='#editprofilmodal'
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
                                                    <li class='list-group-item'>
                                                        <div class='row'>
                                                            <div class='col-md-12 col-12'>
                                                                <div class='row'>
                                                                    <div
                                                                        class='col-sm-12 col-md-3 user-img text-center pt-1'>
                                                                        <img src='<?php echo $row[0]->foto_profil ?>'
                                                                            alt='Seth Frazier'
                                                                            class='img-responsive img-circle rounded-circle' />
                                                                    </div>
                                                                    <div class='col-sm-6 col-md-4'>
                                                                        <h5 class='font-weight-bold mb-1 namaads'>
                                                                            <?php echo $row[0]->nama_user; ?>
                                                                        </h5>
                                                                        <div class='user-detail'>
                                                                            <p class='m-0  kodeads'><i
                                                                                    class='fas fa-key mr-1'></i><?php echo $row[0]->id_user; ?>

                                                                            </p>
                                                                            <p class='m-0  bdads'><i
                                                                                    class='fas fa-birthday-cake mr-1'
                                                                                    aria-hidden='true'></i> <?php echo $row[0]->tanggal_lahir; ?>

                                                                            </p>
                                                                            <p class='m-0'><i class='fas fa-mars mr-1'
                                                                                    aria-hidden='true'></i>
                                                                                <?php echo $row[0]->jenis_kelamin; ?>
</p>
                                                                            <p class='m-0'><i
                                                                                    class='fa fa-user-friends mr-1 ortuads'></i><?php echo $row[0]->nama_orang_tua; ?>
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
                                                                                    class='fas fa-home mr-1'></i><?php echo $row[0]->alamat; ?>

                                                                            </p>
                                                                            <p class='m-0  kecamatan'><i
                                                                                    class='fas fa-landmark mr-1'></i><?php echo $row[0]->kecamatan . ', ' . $row[0]->kota; ?>

                                                                            </p>
                                                                            <p class='m-0  kodepos'><i
                                                                                    class='fas fa-envelope mr-1'></i><?php echo $row[0]->kode_pos; ?>

                                                                            </p>
                                                                            <p class='m-0  emailads'><i
                                                                                    class='fas fa-at mr-1'></i><?php echo $row[0]->email; ?>

                                                                            </p>
                                                                            <p class='m-0  teleponads'><i
                                                                                    class='fas fa-phone mr-1'></i><?php echo $row[0]->nomor_telepon; ?>

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
 if ($rowitems->status_program == 'Pending') {
  $statusicon  = 'fas fa-hourglass-half';
  $statusclass = 'text-warning';
 } else {
  $statusicon  = 'fas fa-check';
  $statusclass = 'text-success';
 }

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
                                                                        <p class='m-0  targetdate'><i
                                                                                class='fas fa-calendar mr-1'
                                                                                aria-hidden='true'></i>$rowitems->tanggal_target
                                                                        </p>
                                                                        <p class='m-0'><i
                                                                                class='fa fa-bullseye mr-1 sasaran'></i>$rowitems->sasaran_program</p>

                                                                        <p class='m-0 kodeprogram'><i
                                                                                class='fas fa-key mr-1'></i>$rowitems->id_program
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
                                        </div>
                                        <div class='form-group'>
                                            <label for='keadaansekarang'>Keadaan Sekarang:</label>
                                            <textarea class='form-control' id='keadaansekarang' name='keadaansekarang' rows='3'
                                                required></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sasaranprogram'>Sasaran:</label>
                                            <textarea class='form-control' id='sasaranprogram' name='sasaranprogram' rows='3'
                                                required></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sumbermateri'>Sumber Materi / Alat Peraga:</label>
                                            <textarea class='form-control' id='sumbermateri' name='sumbermateri' rows='3'
                                                required></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <label for='pelaksanaanprogram'>Cara Pelaksanaan:</label>
                                            <textarea class='form-control' id='pelaksanaanprogram' name='pelaksanaanprogram' rows='3'
                                                required></textarea>
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
                                    <form method="POST" action='profil_ads.php'>
                                        <div class='form-group'>
                                            <label for='namaads'>Nama:</label>
                                            <input type='text' class='form-control' id='nama_user' name='nama_user' required
                                                aria-required='true' value="<?php echo $row[0]->nama_user ?>">
                                        </div>

                                        <label>Foto Profil</label>
                                        <div class='form-group' id='fotoprofil'>
                                            <div>
                                                <label for='image_uploads'>Pilih Foto</label>
                                                <input type='file' class='form-control' id='image_uploads' name='foto_profil'
                                                    name='image_uploads' accept='.jpg, .jpeg, .png'>
                                            </div>
                                            <div class='preview'>
                                                <p>Tidak ada file yang dipilih</p>
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <label for='tanggallahir'>Tanggal Lahir:</label>
                                            <input type='date' class='form-control tanggal' id='tanggallahir' name='tanggal_lahir' required
                                                aria-required='true' value="<?php echo $row[0]->tanggal_lahir ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='jeniskelamin'>Jenis Kelamin:</label>
                                            <select class='form-control' id='jeniskelamin' name='jenis_kelamin' value="<?php echo $row[0]->jenis_kelamin ?>">
                                                <option>Laki-laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class='form-group'>
                                            <label for='namaortu'>Nama Orang Tua:</label>
                                            <input type='text' class='form-control' id='namaortu' name='namaortu' required
                                                aria-required='true' value="<?php echo $row[0]->nama_orang_tua ?>">
                                        </div>
                                        <div class='form-group'>
                                            <label for='email'>E-mail:</label>
                                            <input type='email' class='form-control' id='email' name='email' required
                                                aria-required='true' value="<?php echo $row[0]->email ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='notelepon'>No. Telepon / Handphone:</label>
                                            <input type='number' class='form-control' id='notelepon' name='notelepon' required
                                                aria-required='true' value="<?php echo $row[0]->nomor_telepon ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='alamat'>Alamat:</label>
                                            <textarea class='form-control' id='alamat' rows='3' name='alamat'><?php echo $row[0]->alamat ?>
</textarea>
                                        </div>

                                        <div class='form-group'>
                                            <label for='kecamatan'>Kecamatan:</label>
                                            <input type='text' class='form-control' id='kecamatan' name='kecamatan' value="<?php echo $row[0]->kecamatan ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='kota'>Kecamatan:</label>
                                            <input type='text' class='form-control' id='kota' name='kota' value="<?php echo $row[0]->kota ?>">
                                        </div>

                                        <div class='form-group'>
                                            <label for='kodepos'>Kode Pos:</label>
                                            <input type='number' class='form-control' id='kodepos' name='kodepos' value="<?php echo $row[0]->kode_pos ?>">
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
</body>


</html>