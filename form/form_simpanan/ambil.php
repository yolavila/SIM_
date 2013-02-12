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
<script type="text/javascript">
/* Tambahan Function buat alert isi npa*/
function cek()
{
	var salah = [];
	var cek = 0;
	var npa = document.getElementById("npa");
	if(npa.value == "")
	{
		//alert("npa harus diisi dulu");
		//return false;
		cek = cek+1;
		salah.push("npa wajib diisi");
	}
	var tanggal = document.getElementById("tanggal");
	if(tanggal.value == "")
	{
		//alert("simp wajib harus diisi dulu");
		//return false;
		cek=cek+1;
		salah.push("tanggal harus diisi");
	}
	if(cek > 0)
	{
		alert(salah.join("\n"));
		return false;
	}
	var jumlah = document.getElementById("simp_");
	if(jumlah.value == "")
	{
		//alert("simp wajib harus diisi dulu");
		//return false;
		cek=cek+1;
		salah.push("jumlah pengambilan harus diisi");
	}
	if(cek > 0)
	{
		alert(salah.join("\n"));
		return false;
	}
}
</script>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>


<script type="text/javascript">
$(function() {
	  $("#npa").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
</script>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
a:link{text-decoration:none;}
</style>
<?php
	include("../../db_config.php");
	$npax=$_GET['id'];
	
	$cariagt = "SELECT a.nama FROM simpanan s, anggota a WHERE a.npa='$npax' AND s.tipe='s' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	$namax	 = $datacari['nama'];
	$itung	 = "SELECT count(*) as jml FROM simpanan WHERE npa='$npax' AND tipe='s'";
	$qitung  = mysql_fetch_assoc(mysql_query($itung));
	$hitung  = $qitung['jml'];
	if (($hitung==0)&&($npax!='')){
		?>
		<script type="text/javascript">
			alert("NPA Tidak Mempunyai Simpanan");			
		</script> 
		<?php
	}
	
?>
</head>
<body bgcolor="#F5F5F5">
	
   <fieldset>
    
<form method="post" name="formAmbil" action="proses_ambil.php" id="formAmbil" >	
<h1><b><font color=”#006400”>Form Ambil Simpanan</b></font></h1>
<div class="button"> 
<button type="submit" name="save" value="simpan" onClick="return cek();"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_ambil.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>

<a href="../../admin.php"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>		
<br>
              	<table>
				<tr>
					<td><label>NPA</label> </td>
					<td>: <input id="npa" name="npa" value="<?php echo $npax;?>" > 
					<input type="submit" name="caribtn" id="submit" value="Cari"> </td>
				</tr>
				</fieldset>	
				<tr> 
	<!--				<td><label>No.Simpan</label> </td>
					<td>: <input name="no_simpanan" value="<?php
	$t = mysql_query("SELECT no_simpanan FROM simpanan where npa = '$npax' AND tipe = 's'")or die(mysql_error());
	$no_simpanan = mysql_fetch_assoc($t);
	echo $no_simpanan['no_simpanan'];
	?>"/></td> -->
					</tr>
				<tr>
					<td><label>Nama</label> </td>
					<td>: <input name="nama" value="<?php echo $namax;?>"></td>
				</tr>
				<tr>
					<td><label>Tanggal</td>
					<td>: <input type="text" name="tgl" id="tanggal"  /> <value="<? echo $tgl;?>"/></td>
				</tr>
				
			
			</table>
			<hr>
			<table width="80%" border="1" bgcolor="#000000">
<tbody>
<tr>
<td style="text-align: left;" align="left" valign="top" bgcolor="#F5F5DC" width="auto"><span style="color: #000000;">
<fieldset>
				<legend>1. History Simpanan </legend>
				<table>		
				
		</tr>
				
					<tr>
					<td><label>Simpanan Wajib</label> </td>
					<td>: <input id="simp_wajib" name="simp_wajib" type="text" value="<?php
	$wajib = mysql_query("SELECT SUM(simp_wajib) AS simp_wajib FROM simpanan where npa = '$npax' AND tipe = 's'")or die(mysql_error());
	$wajib_ambil = mysql_query("SELECT SUM(simp_wajib) AS simp_wajib FROM simpanan where npa = '$npax' AND tipe = 'a'")or die(mysql_error());
	$simp_wajib = mysql_fetch_assoc($wajib);
	$ambil_wajib = mysql_fetch_assoc($wajib_ambil);
	if(($simp_wajib['simp_wajib'] - $ambil_wajib['simp_wajib']) == 0)
	{
		echo "";
	}
	else
	{
		echo ($simp_wajib['simp_wajib'] - $ambil_wajib['simp_wajib']);
	}
	?> " /> 
					</td>
				</tr>
				
				<tr>
					<td><label>Simpanan Pokok</label> </td>
					<td>: <input id="simpananpokok" name="simp_pokok" type="text" value="<?php
	$pokok = mysql_query("SELECT SUM(simp_pokok) AS simp_pokok FROM simpanan where npa = '$npax' AND tipe = 's'")or die(mysql_error());
	$pokok_ambil = mysql_query("SELECT SUM(simp_pokok) AS simp_pokok FROM simpanan where npa = '$npax' AND tipe = 'a'")or die(mysql_error());
	$simp_pokok = mysql_fetch_assoc($pokok);
	$ambil_pokok = mysql_fetch_assoc($pokok_ambil);
	if(($simp_pokok['simp_pokok'] - $ambil_pokok['simp_pokok']) == 0)
	{
		echo "";
	}
	else
	{
		echo ($simp_pokok['simp_pokok'] - $ambil_pokok['simp_pokok']);
	}

	?>"/> </td>
				</tr>
				
				<tr>						
					<td><label>Simpanan Sukarela</label> </td>
					<td>: <input  id="simp_sukarela" name="simp_sukarela" type="text" value="<?php
	$sukarela = mysql_query("SELECT SUM(simp_sukarela) AS simp_sukarela FROM simpanan where npa = '$npax' AND tipe = 's'")or die( mysql_error());
	$sukarela_ambil = mysql_query("SELECT SUM(simp_sukarela) AS simp_sukarela FROM simpanan where npa = '$npax' AND tipe = 'a'")or die( mysql_error());
	$simp_sukarela = mysql_fetch_assoc($sukarela);
	$ambil_sukarela = mysql_fetch_assoc($sukarela_ambil);
	if(($simp_sukarela['simp_sukarela'] - $ambil_sukarela['simp_sukarela']) == 0)
	{
		echo "";
	}
	else
	{
		echo ($simp_sukarela['simp_sukarela'] - $ambil_sukarela['simp_sukarela']);
	}
?>"/> </td>
	</tr>
			</fieldset>	
		<!--		<tr>
					<td><label >Jenis Simpanan </label></td>
					<td>: <select name="jenis_simpanan" style="width:215px">
					<option value="">Pilih........	</option>
					<option value="wajib">Wajib</option>
					<option value="pokok">Pokok</option>
					<option value="sukarela">Sukarela</option>
					</select>  -->
			
				
<!--				<tr>
					<td><label>Jumlah</label> </td>
					<td>: <input id="jumlah" name="jumlah" type="text" value="<?php
//	$total = mysql_query("SELECT SUM(jumlah) AS jumlah FROM simpanan where npa = '$npax' AND tipe = 's'")or die(mysql_error());
//	$jumlah = mysql_fetch_assoc($total);
//	echo $jumlah['jumlah'];
	?>"/></td>
				</tr>	-->
				</table> <br>
			</span></td>
<td style="text-align: left;" align="left" valign="top" bgcolor="#F5F5DC" width="auto"><span style="color: #000000;">
<fieldset>
			<legend>2. Transaksi</legend>
				<table>
					<td><label>Ambil Simpanan</label></td>
					<td>: <select name="status">
					<option value="1">Wajib</option>
					<option value="2">Pokok</option>
					<option value="3">Sukarela</option>
				</select>
				</td>

				</tr>
				
				<tr>
					<td><label>Jumlah Ambil</label> </td>
					<td>: <input id="simp_" name="simp_" type="text"/> 
					</td>
				</tr>
				
				<tr>
					<td><label>Keterangan</label> </td>
					<td>: <input name="ket" type="text"/> </td>
				</tr>
			</fieldset>	
		<!--		<tr>
					<td><label >Jenis Simpanan </label></td>
					<td>: <select name="jenis_simpanan" style="width:215px">
					<option value="">Pilih........	</option>
					<option value="wajib">Wajib</option>
					<option value="pokok">Pokok</option>
					<option value="sukarela">Sukarela</option>
					</select> 
	
				
				</table> <br>
				<hr>
				<input type="button" size="30" value="Bukti Kas Masuk"/> 	-->		
</span>

</tr>
</tbody>
</table>
	
<br><br>
			
<div id="kontenbawah">

</div>
				</html>