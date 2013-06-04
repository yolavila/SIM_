<?php

include "../f_connect.php";

 $noap = $_POST['no'];
 $tanggal = $_POST['tanggal'];
 
 $query=mysql_query("UPDATE penjadwalan SET jadwal='$tanggal' where no_applicant='$noap'") or die("Kesalahan : ".mysql_error());
 
 if($query){
	  header('location:../home.php?file=penjadwalan');
 }else{
 echo "Update GAGAL";
 }
 
 ?>