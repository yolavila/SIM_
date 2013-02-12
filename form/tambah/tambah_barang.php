<?php
include '../../db_config.php';
$id_barang= $_POST['id_barang'];
$nama = $_POST['nama'];
$posisi = $_POST['posisi'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$lokasi = $_POST['lokasi'];
$satuan = $_POST['satuan'];
$titip = $_POST['titip'];

$query = mysql_query("insert into master_barang ( id_barang, nama, posisi, harga_beli, harga_jual, lokasi, satuan, titip ) values ('$id_barang','$nama','$posisi','$harga_beli','$harga_jual','$lokasi','$satuan','$titip')") or die(mysql_error());

header ('location: ../master_barang.php');
?>