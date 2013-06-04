<?php
	include "../f_connect.php";
	$nama = $_GET['nama'];
	$tanggal_lahir = $_GET['tanggal_lahir'];
	
	$sql=mysql_query("SELECT * from applicant where nama_lengkap='$nama' AND tgl_lahir = '$tanggal_lahir'") or die (mysql_error());
	
	if($res = mysql_num_rows($sql) == 1)
	{
		//berarti ada double
		echo 1;
	}
	else
	{
		echo 0;
	}
?>