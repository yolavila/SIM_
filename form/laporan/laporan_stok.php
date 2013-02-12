<?php
	require("../../db_config.php");
	$str="select * from master_barang";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil simpanan");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM master_barang WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from master_barang";
	}

	?> 
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
<script type="text/javascript">

function validateForm()
{
var x=document.forms["laporanStok"]["tahun"].value;
if (x==null || x=="")
  {
  alert("Tahun harus diisi");
  return false;
  }
}
	
</script>
</head>

<h1><b><font color=”#006400”>Laporan Stok Barang</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil anggota");
		?> 
<form name="laporanStok" action="../cetak/cetak_stok.php" method="POST" target="_blank" onsubmit="return validateForm()">
<table>
	<tr>
	<td><label>Tanggal Cetak</td>
	<td>: <input type="text" name="tglCetak" id="tglCetak"  size="13" value="<?php echo date("j/n/Y"); ?>" readonly="readonly"/></td>
	<td>
		<input type="hidden" name="jdlLaporan" value="Laporan Stok Barang" />
<input type="hidden" name="nmTabel" value="master_barang" />
<button type="submit" name="save" value="simpan"> cetak
<img src="../../images/print.png" alt="" width="20px" height="20px" />
</button>

		</td>
	</tr>
		
	</tr>
</table>
<br>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" width="50px" height="40px" />

</form>
</div>
</body>
<br>
</html>
