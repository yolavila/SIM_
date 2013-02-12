<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$no_simpanan="";
	$npa="";
	$nama="";
	$tgl="";
	$simp_wajib="";
	$simp_pokok="";
	$simp_sukarela="";
	$jumlah="";
	$ket="";
	$tipe="";
	
	if(isset($_GET['ket']) == "pasif")
	{
		$alert = "!!!! Anggota Sudah Tidak Aktif !!!!";
	}
	else
	{
		$alert = "";
	}
		
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['npa']))
	{
		include("../../db_config.php");
		$str="select * from simpanan where npa=".intval($_GET['npa']);
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$no_simpanan=$data['no_simpanan'];
		$npa=$data['npa'];
		$nama=$data['nama'];
		$tgl=$data['tgl'];
		$simp_wajib=$data['simp_wajib'];
		$simp_pokok=$data['simp_pokok'];
		$simp_sukarela=$data['simp_sukarela'];
		$jumlah=$data['jumlah'];
		$ket=$data['ket'];
		$tipe=$data['tipe'];
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
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
<script type="text/javascript">
function hitungJml(){
	sukarela = document.formSimpanan.simp_sukarela.value;
	simpan  = document.formSimpanan.simp_wajib.value;
	pokok   = document.formSimpanan.simp_pokok.value;
	if (simpan==''){
		simpan = 0;
	}
	if (pokok==''){
		pokok = 0;
	}
	if (sukarela==''){
		sukarela = 0;
	}
	document.formSimpanan.jumlah.value = (parseInt(sukarela) + parseInt(simpan) + parseInt(pokok));
}
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
		cek=cek+1;
		salah.push("tanggal harus diisi");
	}
	if(cek > 0)
	{
		alert(salah.join("\n"));
		return false;
	}
	var simp_wajib = document.getElementById("wajibsimpanan");
	if(simp_wajib.value == "")
	{
		//alert("simp wajib harus diisi dulu");
		//return false;
		cek=cek+1;
		salah.push("simpanan wajib harus diisi");
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
	if ($npa != "") $npax = $npa; 
	else $npax=$_GET['id'];
	
	$cariagt = "SELECT nama FROM anggota WHERE npa='$npax' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	if ($nama != "") $namax	 = $nama; 
	else $namax	 = $datacari['nama'];
	$itung	 = "SELECT count(*) as jml FROM `anggota` WHERE npa='$npax'";
	$qitung  = mysql_fetch_assoc(mysql_query($itung));
	$hitung  = $qitung['jml'];
	if (($hitung==0)&&($npax!='')){
		?>
		<script type="text/javascript">
			alert("NPA tidak terdaftar");			
		</script> 
		<?php
	}
	
?>
</head>
<body bgcolor="#F5F5F5" >
<fieldset>
<center><h2 style="color:red;"><?php echo $alert; ?></h2></center>
<h1><b><font color=”#006400”>Form Simpanan</b></font></h1>
<!-- tambah onSubmit="return cek()  -->
<form method="post" name="formSimpanan" action="proses_simpan.php" id="formSimpanan" >	

<div class="button"> 
<?php
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['npa'])){
?>
<button type="submit" name="update" value="update"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Update 
<?php
	} else {
?>
<button type="submit" name="save" value="simpan" onClick="return cek();"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
<?php
	}
?>
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_simpanan.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>

<a href="../../admin.php?menu=usp"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	
</fieldset>		

	
<br>

<table width="800">
<input type="hidden" name="npa" size="50" value="<? echo $npa;?>" />
				<tr>
					<td><label>NPA</label> </td>
					<td>: <input id="npa" name="npa" size="30" value="<?php echo $npax;?>" > 
					<input type="submit" name="caribtn" id="submit" value="Cari"> 

					<td><label>Simpanan Sukarela</label> </td>
					<td>: <input id="simp_sukarela" name="simp_sukarela" type="text" size="30" onChange="hitungJml()" value="<?php echo $simp_sukarela;?>" /></td>
				</tr>
				
				<tr>
					<td><label>Nama</label> </td>
					<td>: <input name="nama" size="30" value="<?php echo $namax;?>" readonly="readonly"> </td>
											
					<td><label>Simpanan Wajib</label> </td>
					<td>: <input id="wajibsimpanan" name="simp_wajib" type="text" size="30" onChange="hitungJml()" value="<?php echo $simp_wajib;?>"/></td>
				</tr>
				<tr>
					<td><label>Tanggal</td>
					<td>: <input type="text" name="tgl" id="tanggal"  size="30" value="<?php echo $tgl;?>"/> </td>
					
					<td><label>Simpanan Pokok</label> </td>
					<td>: <input id="simpananpokok" name="simp_pokok" type="text" size="30" onChange="hitungJml()" value="<?php echo $simp_pokok;?>"/></td>
				</tr>
			</fieldset>			
				<tr>
				<td> </td>
				<td></td>
					<td><label>Jumlah</label> </td>
					<td>: <input id="jumlahuang" name="jumlah" type="text" size="30" value="<?php echo $jumlah;?>" /></td>
				</tr>
				
			</table>
			<br>
				<fieldset>	
				<table>
				<tr>
					<td><label>Keterangan</label> </td>
					<td>: <input name="ket" type="text" size="100" value="<?php echo $ket;?>"/></td>
				</tr>
				</table>
				</fieldset><br>	
				
		<!--	<input type="button" size="30" value="Bukti Kas Masuk"/><br>  -->
				
</form>	
</body>
</html>


