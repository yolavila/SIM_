<?php
include '../../db_config.php';
$kode = $_POST['kode'];
$nama_instansi = $_POST['nama_instansi'];

$query = mysql_query("insert into instansi ( kode, nama_instansi) values ('$kode','$nama_instansi')");

header ('location: ../instansi.php');
?>