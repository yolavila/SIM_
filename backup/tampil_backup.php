<?php
	require("../db_config.php");
	$str="select * from user";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil user");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM user WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from user";
	}

	?> 
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
$(function(){
	/**
	FUNGSI UNTUK MENAMPILKAN TAMBAH FORM INSTANSI,
	DIGUNAKAN JAVASCRIPT UNTUK MENAMPILKAN FORM
	**/
	$("a.add").click(function(){
		page=$(this).attr("href")
		$("#Formcontent").html("loading...").load(page);
		return false
	})
})
</script>
<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
</head>
<h1><b><font color=”#006400”>Backup Tabel Database</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<div id="content">

	<?php
		include "backup.php";
		?> 
		
	

</div>
</body>

</html>
