<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");
 
$noap = $_POST['no'];
$tanggal = $_POST['tanggal'];
    
  $simpan = mysql_query ("INSERT INTO terminate (no_applicant, tgl_terminate) VALUES ('$noap','$tanggal')") or die("Kesalahan : ".mysql_error());
  $update = mysql_query ("UPDATE applicant SET status='8' where no_applicant='$noap'");
  
	if ($simpan){											
  header('location:../home.php?file=kry_terminate');
}else{
echo "<font color=red>Data Gagal Disimpan</font>";
}

?>