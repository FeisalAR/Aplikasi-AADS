<?php
include 'connection.php';
session_start();
$isLoggedIn = isset($_SESSION['id_user']) && !empty($_SESSION['id_user']);

if (isset($_GET['id_user'])) {
 $id_user = $_GET['id_user'];
} else {
 header('Location: listing_ads.php');
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

function ageCalculator($dob){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $ag = $birthdate->diff($today)->y;
        $mn = $birthdate->diff($today)->m;
        $dy = $birthdate->diff($today)->d;
        if ($ag == 0)
        {
            return "$mn Bulan";            
        }
        else
        {
            return "$ag Tahun $mn Bulan";
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

    <link rel='icon' href='favicon.ico' type='image/x-icon' />

    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Lihat Profil & Program Individu - Aplikasi AADS</title>
</head>

<body>

    


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

                    <!-- <ul class='guestHmenu navbar-nav navbar-collapse'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'><i class='icon fas fa-home'></i>Beranda</a>
                        </li>
                    </ul> -->

                    

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
                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='profil_ads.php' class='nav-link'>
                                <i class='icon far fa-address-card'></i><span class='vmenutext'>Lihat Profil & Program
                                    Individu ADS</span>
                            </a>

                        <li class='nav-item' <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href='laporan_capaian.php' class='nav-link'>
                                <i class='icon fas fa-chart-line'></i><span class='vmenutext'>Laporan Capaian</span>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (!$isLoggedIn) {
 echo 'style="display: none !important"';
}
?>>
                            <a href="standar_perkembangan.php" class="nav-link">
                                <i class="icon fas fa-chart-bar"></i><span class="vmenutext">Standar Perkembangan Anak</span>
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
                    <div class='row'>
                        <!-- Form Title -->
                        <div class='col'>
                        <a class="backtoprofile font-weight-bold"
                                                                            href="listing_ads.php"><i
                                                                                class="fas fa-chevron-left"></i>Kembali
                                                                            ke Listing ADS</a>
                            <h1>Profil ADS</h1>
                        </div>
                    </div>

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

                                                                            </span></p>
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

$tanggal_targetf = date("j F Y",strtotime($rowitems->tanggal_target));

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
                                                                        <p class='m-0 '><i
                                                                                class='fas fa-calendar mr-1'
                                                                                aria-hidden='true'></i><span class='targetdate'>$tanggal_targetf
                                                                        </span></p>
                                                                        <p class='m-0'><i
                                                                                class='fa fa-bullseye mr-1 sasaran'></i>$rowitems->sasaran_program</p>

                                                                        <p class='m-0 kodeprogram'><i
                                                                                class='fas fa-key mr-1'></i>$rowitems->id_program
                                                                        </p>
                                                                        <a
                                                                            href='lihat_detail_program_individu.php?id_program=$rowitems->id_program&id_user=$id_user'>
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
</body>


</html>
