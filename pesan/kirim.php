<?php

/**
 * @author ADMIN
 * @copyright 2011
 */

session_start();
include "./f_connect.php";
if ($_SESSION['level']=='mahasiswa'){
$pengirim = $_POST['pengirim'];
$penerima = $_POST['penerima'];
$pesan = $_POST['pesan'];
$tgl = date("j F Y, g:i a");
$sukses = mysql_query("insert into konsultasi Values('','$pengirim','$penerima','$pesan','$tgl')");
if($sukses){
    echo "<script language='javascript'>
	alert('Pesan berhasil dikirim kepada Bapak/Ibu $penerima');
	document.location='?file=psn';
	</script>";
}
}elseif ($_SESSION['level']=='dosen'){
$pengirim = $_POST['pengirim'];
$penerima = $_POST['penerima'];
$pesan = $_POST['pesan'];
$tgl = date("j F Y, g:i a");
$sukses = mysql_query("insert into konsultasi Values('','$pengirim','$penerima','$pesan','$tgl')");
if($sukses){
    echo "<script language='javascript'>
	alert('Pesan berhasil dikirim kepada saudara/i $penerima');
	document.location='?file=psn';
	</script>";
}
}

?>