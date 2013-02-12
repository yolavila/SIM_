<?php
include '../../db_config.php';
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];
$tempo= $_POST['tempo'];

$query = mysql_query("insert into suplier ( kode, nama, alamat, kota, tempo) values ('$kode','$nama','$alamat','$kota','$tempo')") or die(mysql_error());

header ('location: ../suplier.php');
?>