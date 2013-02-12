<?php
	require("../../db_config.php");
	$str="select * from pinjaman_barang";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil pinjaman_barang");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM pinjaman_barang WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from pinjaman_barang";
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
var x=document.forms["laporanPinjaman"]["tahun"].value;
if (x==null || x=="")
  {
  alert("Tahun harus diisi");
  return false;
  }
}
	
</script>
</head>

<h1><b><font color=”#006400”>Laporan Pinjaman Barang</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil anggota");
		?> 
<form name="laporanPinjaman" action="../cetak/cetak_pinjaman_barang.php" method="POST" target="_blank" onsubmit="return validateForm()">
<table>
	<tr>
	<td><label>Tanggal Cetak</td>
	<td>: <input type="text" name="tglCetak" id="tglCetak"  size="13" value="<?php echo date("j/n/Y"); ?>" readonly="readonly"/></td>
	</tr>
	
	<tr>
	<td><label>Bulan</td>
	<td>:
		<select name="bulan">
			<option value="">-- pilih bulan --</option>
			<option value="1">Januari</option>
			<option value="2">February</option>
			<option value="3">Maret</option>
			<option value="4">April</option>
			<option value="5">Mei</option>
			<option value="6">Juni</option>
			<option value="7">Juli</option>
			<option value="8">Agustus</option>
			<option value="9">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
	</td>
	
	<td>Tahun</td>
	<td>
		<select name="tahun">
			<option value="">-- pilih tahun --</option>
		<?php
			$thn = mysql_query("select distinct year(tgl_pinjam) as tahun from pinjaman_barang") or die(mysql_error());
			while($tahun = mysql_fetch_array($thn))
			{
				echo "<option value=\"".$tahun['tahun']."\">".$tahun['tahun']."</option>";
			}
		?>
		</select>
		
		<td>
		<input type="hidden" name="jdlLaporan" value="Laporan Pinjaman Barang" />
<input type="hidden" name="nmTabel" value="pinjaman_barang" />
<button type="submit" name="save" value="simpan"> cetak
<img src="../../images/print.png" alt="" width="20px" height="20px" />
</button>

		</td>
	</tr>
</table>
<br>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" width="50px" height="40px" />

</form>
</div>
</body>
<br>
</html>
