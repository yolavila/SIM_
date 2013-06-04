<?php

include "../f_connect.php";

$no_ap=$_POST['no'];
$nama=$_POST['nama'];
$kantor=$_POST['kantor'];
$cabang=$_POST['cabang'];
$posisi=$_POST['posisi'];
$tanggal=$_POST['tanggal'];
 
$query=mysql_query("INSERT INTO hired VALUES ('$no_ap','$kantor','$cabang','$posisi','$tanggal')") or die("Kesalahan : ".mysql_error());
$qry=mysql_query("UPDATE applicant SET status='7' where no_applicant='$no_ap'") or die("salah : ".mysql_error());
 
 if($query && $qry){
	  header('location:../home.php?file=kry_hiredd');
 }else{
 echo "Update GAGAL";
 }
 
 ?>