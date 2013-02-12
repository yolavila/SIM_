<?php
include '../../db_config.php';
$id_satuan = $_POST['id_satuan'];
$satuan = $_POST['satuan'];
$ket = $_POST['ket'];


$query = mysql_query("insert into satuan ( id_satuan, satuan, ket ) values ('$id_satuan','$satuan','$ket')") or die(mysql_error());

header ('location: ../form_satuan.php');
?>