<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");
 
$noap = $_POST['no_applicant'];
$noid = $_POST['no_identitas'];
$nama = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];
$tlp = $_POST['no_tlp'];
$email = $_POST['email'];
$ttl = $_POST['tempat_lahir'];
$tgl_lahir = $_POST['thn'].'-'.$_POST['bln'].'-'.$_POST['tgl'];;
$jk = $_POST['jenis_kelamin'];
$status = $_POST['status_pernikahan'];
$agama = $_POST['agama'];
$gol = $_POST['gol_darah'];
$pend = $_POST['pendidikan'];
$penempatan = $_POST['penempatan'];
$posisi = $_POST['posisi'];
$foto = $_POST['image'];
    
  $simpan = mysql_query ("INSERT INTO applicant VALUES ('$noap','$noid','$nama','$alamat','$kota','$tlp','$email','$ttl','$tgl_lahir',
											'$jk','$status','$agama','$gol','$pend','$penempatan','$posisi','$foto','1')") or die("Kesalahan : ".mysql_error());
	$jadwal=mysql_query ("INSERT INTO penjadwalan VALUES ('$noap','','')") or die("Kesalahan : ".mysql_error());
  
	if ($simpan && $jadwal){											
  header('location:../home.php?file=adm_data');
}else{
echo "<font color=red>Data Gagal Disimpan</font>";
}

?>