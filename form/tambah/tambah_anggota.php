<?php
include '../../db_config.php';
$npa = $_POST['npa'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$instansi = $_POST['instansi'];
$kota = $_POST['kota'];
$tgl_masuk = $_POST['tahun'].'-'.$_POST['bulan'].'-'.$_POST['tanggal'];
$jk = $_POST['jk'];
$simp_pokok = $_POST['simp_pokok'];
$simp_wajib = $_POST['simp_wajib'];

$query = mysql_query("insert into anggota ( npa, nama, alamat, instansi, kota, tgl_masuk, jk, simp_pokok, simp_wajib) values ('$npa','$nama','$alamat','$instansi','$kota','$tgl_masuk','$jk','$simp_pokok','$simp_wajib')") or die(mysql_error());

header ('location: ../anggota.php');
?>