<?php
mysql_connect("localhost", "root", "");
mysql_select_db("sim");

 $noap = $_POST['no'];
 $tgl_jadwal = $_POST['thn'].'-'.$_POST['bln'].'-'.$_POST['tgl'];;
 
 $query=mysql_query("UPDATE penjadwalan SET jadwal='$tgl_jadwal' where no_applicant='$noap'");
 
 if($query){
	  header('location:../../skripsi/home.php?file=penjadwalan');
 }else{
 echo "Update GAGAL";
 }
 
 ?>