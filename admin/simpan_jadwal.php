<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");
 
$noap = $_POST['no'];
$tgl_jadwal = $_POST['thn'].'-'.$_POST['bln'].'-'.$_POST['tgl'];;
    
  $simpan = mysql_query ("INSERT INTO penjadwalan (no_applicant, jadwal, konfirmasi) VALUES ('$noap','$tgl_jadwal','')") or die("Kesalahan : ".mysql_error());
  
	if ($simpan){											
  header('location:../home.php?file=adm_data');
}else{
echo "<font color=red>Data Gagal Disimpan</font>";
}

?>