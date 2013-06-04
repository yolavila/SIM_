<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
error_reporting(0);
session_start();
if ($_SESSION['username']){
    header("location:home.php?file=welcome");
} else {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ADMIN" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />

	<title>::.PT Swakarya Insan Mandiri.::</title>
</head>

<body>
<div id="header">
<div id="logo"><img src="images/logo_sim.png" class="logo" /></div>
<div class="site_title"><a href="index.php">PT. Swakarya Insan Mandiri</a></div>
<div class="site_slogan">Sistem Informasi Manajemen Sumber Daya Manusia</div>
<?php if ($_SESSION['level'] == "admin"){?>
<div id="menu_admin">
    <input type="button" value="Beranda" onclick="document.location='?menu=home'" />
    <input type="button" value="Profil" onclick="document.location='?menu=profil'" />
    <input type="button" value="Pengaturan" onclick="document.location='?menu=pengaturan'" />
    <input type="button" value="Keluar" onclick="document.location='?menu=keluar'" />
</div>
?>
<?php
}
?>
</div>

<div id="container">
<?php
switch($_GET['menu']) {
    default : include "f_welcome.php"; break;
    case daftar : include "f_daftar.php"; break;
    case cek_validasi : include "f_slip_validasi.php"; break;
    case proses : include "f_proses.php"; break;
    case proses2 : include "f_proses2.php"; break;
    case masuk : include "f_masuk.php"; break;
	case infodaftar : include "f_info.php"; break;
    case kembalikan : include "f_proses.php"; break;
    case login_admin : include "login/f_admin_login.php"; break;
    case login_dosen : include "login/f_dosen_login.php"; break;
    case login_mahasiswa : include "login/f_mahasiswa_login.php"; break;
	case login_manager : include "login/f_manager_login.php"; break;
    case cek_login : include "login/f_cek_login.php"; break;
    case keluar : include "f_logout.php"; break;

}
?>
</div>


<?php if ($_SESSION['level'] == "admin"){
?>
<div id="container_right">
<div id="container_right_main">
<?php include "admin/f_mahasiswa.php";?>
<?php } ?>

<?php if ($_SESSION['level'] == "dosen"){?>
<div id="main">
<div id="container_left">
    <ul>
      <li><a href="?menu=home">Home</a></li>
	  <li><a href="?menu=home">Daftar Mahasiswa Diampu</a></li>
	  <li><a href="?menu=home">Kelola Nilai</a></li>
	  <li><a href="?menu=home">Kelola Konsultasi</a></li>

    </ul>
</div>

<div id="container_right">
<div id="container_right_main">

</div></div>
</div>
<?php } ?>

<?php if ($_SESSION['level'] == "mahasiswa"){
 if ($_SESSION['status'] == "not_valid"){
        echo "<center /><strong /><blink /><font size='12px' />Silahkan Hubungi Pihak kampus untuk mengaktifkan akun anda";
       } else if ($_SESSION['status'] == "valid"){
        echo " <div id='main'>
<div id='container_left'>
    <ul>
      <li><a href='?menu=home'>Beranda</a></li>

    </ul>
</div>

<div id='container_right'>
<div id='container_right_main'>
</div></div>
</div>"; }
		?>

<?php } ?>
<div id="footer" align="center" style="font-family:Calibri">Copyright &copy; PT. Swakarya Insan Mandiri , <?php echo date("Y");?></div>
</body>
</html>
<?php } ?>