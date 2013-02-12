<?php
include '../../db_config.php';
$no = $_POST['no'];
$nama = $_POST['nama'];
$instansi = $_POST['instansi'];
$kota = $_POST['kota'];
$jk = $_POST['jk'];

$query = mysql_query("insert into non_anggota ( no, nama, instansi, kota, jk) values ('$no','$nama','$instansi','$kota','$jk')") or die(mysql_error());

header ('location: ../non_anggota.php');
?>