<?php
session_start();
/**
 * @author ADMIN
 * @copyright 2013
 */
error_reporting(0);
include "f_connect.php";
if (!$_SESSION['username']){
	echo "<script language='javascript'>
	alert('harap login terlebih dahulu');
	document.location='index.php?menu=masuk';
	</script>";
} else {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ADMIN" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
	<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
	<link rel="stylesheet" href="js/ui/themes/base/jquery.ui.all.css" type="text/css" />
	<link rel="stylesheet" href="js/ui/themes/base/jquery.ui.datepicker.css" type="text/css" />
	 <script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>   
	<title>PT. SIM</title>
</head>

<body>
<div id="header">
<div id="logo"><img src="images/logo_sim.png" class="logo" /></div>
<div class="site_title"><a href="?file=welcome">PT. Swakarya Insan Mandiri</a></div>
<div class="site_slogan">Sistem Informasi Manajemen Sumber Daya Manusia</div>
<?php if ($_SESSION['level'] == "admin"){?>
<div id="menu_admin">
    <input type="button" value="Home" onclick="document.location='?file=welcome'" />
    <input type="button" value="Sign Out" onclick="document.location='f_logout.php'" />
</div>
<?php
} else if ($_SESSION['level'] == "manager"){?>
<div id="menu_admin">
    <input type="button" value="Home" onclick="document.location='?file=welcome'" />
    <input type="button" value="Sign Out" onclick="document.location='f_logout.php'" />
</div>
<?php
} else if ($_SESSION['level'] == "mahasiswa"){?>
<div id="menu_admin">
    <input type="button" value="Home" onclick="document.location='?file=welcome'" />
    <input type="button" value="Sign Out" onclick="document.location='f_logout.php'" />
</div>
<?php
} else {
?>
<div id="menu_admin">
    <input type="button" value="Mendaftar" onclick="document.location='?menu=daftar'" />
    <input type="button" value="Login" onclick="document.location='?menu=masuk'" />
    <input type="button" value="Info Pendaftaran" onclick="document.location='?menu=infodaftar'" />
</div>

<?php
}
?>
</div>

<div id="container_right">
<?php
switch($_GET['file']) {	
	case welcome : include "admin/f_welcome.php"; break;
	case adm_applicant : include "admin/aplicant.php"; break;
	case del_applicant : include "admin/f_hapus_applicant.php"; break;
	case adm_data : include "admin/data_applicant.php"; break;
	case penjadwalan : include "admin/jadwal.php"; break;
	case add_jadwal : include "admin/jadwal_add.php"; break;
	case proses : include "admin/proses_jadwal.php"; break;
	case konfirm: include "admin/konfirmasi.php"; break;
	case f_result : include "admin/result.php"; break;
	case inquiry : include "admin/inquiry_step1.php"; break;
	case penjadwalan2 : include "admin/penjadwalan_user.php"; break;
	case penjadwalan_user : include "admin/proses_jadwal_user.php"; break;
	case penjadwalan_user2 : include "admin/proses_jadwal_user2.php"; break;
	case inquiry_jadwal : include "admin/inqury_jadwal_user.php"; break;
	case cari_penjadwalan : include "admin/cari_inquiry.php"; break;
	case kry_hiredd : include "admin/hired.php"; break;
	case proses_kry_hired : include "admin/proses_kry_hired.php"; break;
	case proses_kry_hired2 : include "admin/proses_kry_hired2.php"; break;
	case cari_hired : include "admin/cari_hired.php"; break;
	case cari_terminate : include "admin/cari_terminate.php"; break;
	case kry_terminate : include "admin/kry_terminate.php"; break;
	case proses_terminate : include "admin/proses_kry_terminated.php"; break;
	case laporan_grafik : include "admin/laporan_grafik.php"; break;
	case laporan_tabel : include "admin/laporan_tabel.php"; break;
	case carii : include "admin/caricari.php"; break;
	case cari_grafik : include "admin/laporan_grafikk.php"; break;
    	case hapus_mhs : include "admin/f_hapus_mhs.php"; break;
		case hapus_dsn : include "admin/f_hapus_dsn.php"; break;
		case simpan_dsn : include "admin/f_simpan_dsn.php"; break;
		case simpan_add : include "admin/f_simpan_add.php"; break;
		case add_dsn : include "admin/f_add_dosen.php"; break;
		case carimhs : include "admin/cari.php"; break;
	    case simpan_edit : include "admin/f_simpan_edit.php"; break;
		//case nilai : include "admin/f_nilai_mahasiswa.php"; break;
	case allmhs : include "dosen/d_semua_mahasiswa.php"; break;
    case keluar : include "f_logout.php"; break;
	case simpan_nilai : include "admin/f_simpan_nilai.php"; break;
	case simpan_nilai2 : include "admin/f_simpan_nilai2.php"; break;
// 	case edit_applicant : include "admin/aplicant.php"; break;
	case carinilai : include "admin/cari2.php"; break;
	case seminar : include "admin/f_seminar.php"; break;
	case simpan_smnr : include "admin/f_simpan_seminar.php"; break;
	case jdwl : include "admin/f_view_seminar.php"; break;
	
	
    

}
?>
</div>


<?php if ($_SESSION['level'] == "admin"){?>

<div id="container_left" style='padding-left:90px'>
    <ul>
      <li><a href="?file=welcome">Home</a></li>
	  <li><a href="#">Human Capital</a>
	  	<ul id="sub_menu">
			<li><a href="?file=adm_data">Applicant</a></li>
			<li><a href="?file=penjadwalan">Scheduling</a></li>
			<li><a href="?file=konfirm">Confirmation</a></li>
			<li><a href="?file=f_result">Result</a></li>
		</ul>
	  </li>
	  <li><a href="#">Sending Employees</a>
	  	<ul id="sub_menu">
			<li><a href="?file=penjadwalan2">User Scheduling</a></li>
			<li><a href="?file=inquiry_jadwal">Inquiry</a></li>
		</ul>
	  </li>
	  <li><a href="#">Employees</a>
		<ul id="sub_menu">
			<li><a href="?file=kry_hiredd">Hired</a></li>
			<li><a href="?file=kry_terminate">Terminate</a></li>
		</ul>
	  <li><a href="#">Report Data Statistic</a></li>
		<ul id="sub_menu">
			<li><a href="?file=laporan_grafik">Graph</a></li>
			<li><a href="?file=laporan_tabel">Table</a></li>
		</ul>

</div>


</div></div></div>

<?php } ?>

<?php if ($_SESSION['level'] == "manager"){?>

<div id="container_left" style='padding-left:90px'>
    <ul>
      <li><a href="?file=welcome">Home</a></li>
	  <li><a href="#">Human Capital</a>
	  	<ul id="sub_menu">
			<li><a href="?file=adm_data">Applicant</a></li>
			<li><a href="?file=penjadwalan">Scheduling</a></li>
			<li><a href="?file=konfirm">Confirmation</a></li>
			<li><a href="?file=f_result">Result</a></li>
		</ul>
	  </li>
	  <li><a href="#">Sending Employees</a>
	  	<ul id="sub_menu">
			<li><a href="?file=penjadwalan2">User Scheduling</a></li>
			<li><a href="?file=inquiry_jadwal">Inquiry</a></li>
		</ul>
	  </li>
	  <li><a href="#">Employees</a>
		<ul id="sub_menu">
			<li><a href="?file=kry_hiredd">Hired</a></li>
			<li><a href="?file=kry_terminate">Terminate</a></li>
		</ul>
	  <li><a href="?file=nilai">Report Data Statistic</a></li>
		<ul id="sub_menu">
			<li><a href="?file=laporan_grafik">Graph</a></li>
			<li><a href="?file=laporan_tabel">Table</a></li>
		</ul>

</div>


</div></div></div>


</div>
<?php } ?>

<?php if ($_SESSION['level'] == "mahasiswa"){
 if ($_SESSION['status'] == "not_valid"){
        echo "<script language='JavaScript'>
TargetDate = '12/19/2011 11:04 PM';
BackColor = 'red';
ForeColor = 'white';
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = '%%D%% Hari, %%H%% Jam, %%M%% Menit, %%S%% Detik.';
FinishMessage = 'Segera Lakukan Seminar KP !';
</script>
<script language='JavaScript' src='doc/countdown.js'></script>
		<table><div id='container_right'><center /><strong><blink /><font size='12px' color='red'>Silahkan Penuhi Syarat-Syarat Pendaftaran KP, Hubungi Bagian TU untuk mengaktifkan akun anda</strong></font></div></table>";
       } else if ($_SESSION['status'] == "valid"){
        echo " <div >
<div id='container_left'  style='padding-left:160px'>
    <ul>
      <li><a href='?file=welcome'>Home</a></li>
	   <li><a href='?file=psn'>Konsultasi</a></li>
	   <li><a href='?file=nilai'>Lihat Nilai</a></li>
	   <li><a href='doc/CAI.docx'>Download proposal KP</a></li>
	   <li><a href='doc/CAI.docx'>Download Form Nilai Instansi</a></li>
	   <li><a href='?file=seminar'>Daftar Seminar</a></li>
	   <li><a href='?file=jdwl'>jadwal Seminar</a></li>
	   
    </ul>
	<br />
		<br />
			<br />
			<p style='font-size: 14px;font-family:trebuchet MS;color:green;'>Jangka Waktu Pelaksanaan KP</p>
	<script language='JavaScript'>
TargetDate = '1/11/2012 11:20 PM';
BackColor = 'red';
ForeColor = 'white';
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = '%%D%% Hari, %%H%% Jam, %%M%% Menit, %%S%% Detik.';
FinishMessage = 'Segera Lakukan Seminar KP !';
</script>
<script language='JavaScript' src='doc/countdown.js'></script>
</div>


</div></div>

</div>"; }
		?>

<?php } ?>
<div id="footer" align="center" style="font-family:Calibri">Copyright &copy; PT. Swakarya Insan Mandiri , <?php echo date("Y");?></div>
</body>
</html>
<?php } ?>
<? ob_flush(); ?>