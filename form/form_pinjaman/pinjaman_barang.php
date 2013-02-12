<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$npa="";
	$nama="";
	$instansi="";
	$tgl_pinjam="";
	$jenis_bayar="";
	$jenis_pinjaman="";
	$pinjaman_pokok="";
	$jasa="";
	$xangsuran="";
	$angsuran="";
	$tot_jasa="";
	$tot_angsuran="";
	$tgl_mulai="";
	$tgl_selesai="";
	
	
		//ANGGOTA PASIF
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
		$str="select * from pinjaman_barang where npa=".intval($_GET['npa']);
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$npa=$data['npa'];
		$nama=$data['nama'];
		$instansi=$data['instansi'];
		$tgl_pinjam=$data['tgl_pinjam'];
		$jenis_bayar=$data['jenis_bayar'];
		$jenis_pinjaman=$data['jenis_pinjaman'];
		$pinjaman_pokok=$data['pinjaman_pokok'];
		$jasa=$data['jasa'];
		$xangsuran=$data['xangsuran'];
		$angsuran=$data['angsuran'];
		$tot_jasa=$data['tot_jasa'];
		$tot_angsuran=$data['tot_angsuran'];
		$tgl_mulai=$data['tgl_mulai'];
		$tgl_selesai=$data['tgl_selesai'];
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
		salah.push("NPA wajib diisi");
	}
	var tanggal = document.getElementById("tanggal");
	if(tanggal.value == "")
	{
		//alert("simp wajib harus diisi dulu");
		//return false;
		cek=cek+0;
		salah.push("Wajib Diisi Semua");
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
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	$('#tanggal2').datepicker({dateFormat:'yy-mm-dd'});
	$('#tanggal1').datepicker({
     //your other configurations.     
		dateFormat:'yy-mm-dd',
		onSelect: function(){
		var start = $.datepicker.parseDate('yy-mm-dd', $('#tanggal1').val());
		var nextmonth = parseInt($('#xangsuran').val());
		if (nextmonth==''){
			nextmonth = 0;
		}
		start.setMonth(start.getMonth()+nextmonth);
		var d = start.getDate();
		if (d < 10) {d='0'+ d;}
		var m = start.getMonth();
		if (m < 10) {m='0'+ (m+1);}
		var y = start.getFullYear();
        $('#tanggal2').val(y+'-'+m+'-'+d);
		//var date = new Date(start);
		//var d = date.getDate();
		//var m = date.getMonth();
		//var y = date.getFullYear();
		//var edate= new Date(y, (m+nextmonth), d);
		//edate = $.datepicker.parseDate('yy-mm-dd',edate);
		//$('#tanggal2').val(edate);
		}
	});
});
</script>
<script type="text/javascript">
function hitungAngsuran(){
	pinjaman_pokok 	= document.formPerincian.pinjaman_pokok.value;
	jasa  		= document.formPerincian.jasa.value;
	xangsuran   = document.formPerincian.xangsuran.value;
			
	if (pinjaman_pokok==''){
		pinjaman_pokok = 0;
	}
	if (jasa==''){
		jasa = 1;
	}
	if (xangsuran==''){
		xangsuran = 10;
	}
	
	bunga = parseFloat(pinjaman_pokok)*(parseFloat(jasa)/100);
	document.formPerincian.angsuran.value = (parseFloat(pinjaman_pokok) / parseFloat(xangsuran))+bunga;
	tot_bunga = bunga * parseFloat(xangsuran)
	document.formPerincian.tot_jasa.value = tot_bunga;
	document.formPerincian.tot_angsuran.value = parseFloat(pinjaman_pokok) + tot_bunga; 
}
</script>
</head>
<?php
	include("../../db_config.php");
	if ($npa != "") $npax = $npa; 
	else $npax=$_GET['id'];
	
	$cariagt = "SELECT nama, instansi FROM anggota WHERE npa='$npax' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	if ($nama != "") $namax	 = $nama; 
	else $namax	 = $datacari['nama'];
	$instansix	 = $datacari['instansi'];
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

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
a:link{text-decoration:none;}
</style>
<body bgcolor="#F5F5F5" onload="document.formPerincian.npa.focus()">
<fieldset>
<center><h2 style="color:red;"><?php echo $alert; ?></h2></center>
<form method="post" name="formPerincian" action="proses_pinjam_barang.php" id="formPerincian" onSubmit="return cek();">	
<h1><b><font color=”#006400”>Form Pinjaman Barang</b></font></h1>

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
<button type="submit" name="save" value="simpan"> 
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

<a href="tampil_pinjaman_barang.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>
<a href="../../admin.php"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	
	<br>	
                
				<table>
				<tr>
				<td><label>NPA</label> </td>
					<td>: <input name="npa" id="npa" value="<?php echo $npax;?>" > 
					<input type="submit" name="caribtn" id="submit" value="Cari"> </td>
						
					<td><label>Jenis Pinjaman</label></td> 				
					<td>: <select name="jenis_pinjaman">
					<? $pinjamanxxxx = Array('upb'); 
						//$i = 0;
						foreach ($pinjamanxxxx as $dataxx){
							if ($jenis_pinjaman==$dataxx) $select = "selected=selected";
							else $select = "";
							echo '<option value="'.$dataxx.'" '.$select.'>'.strtoupper($dataxx).'</option>'; 
							//$i++;
						}
					?>
					</select>
					</td>								
				</tr>
				</fieldset>	
				
				<tr>
					<td><label>Nama</label> </td>
					<td>: <input name="nama" size="20" value="<?php echo $namax;?>"> 
									
					
					<td><label>Jenis Bayar</label></td> 
					<td>:
					<? if ($jenis_bayar == "bs"){?>
					<input type="radio" name="jenis_bayar" value="potong_gaji"/>Potong Gaji &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="jenis_bayar" value="bs" checked="checked"/>Bayar Sendiri
					<?}else{?>
					<input type="radio" name="jenis_bayar" value="potong_gaji" checked="checked"/>Potong Gaji &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="jenis_bayar" value="bs"/>Bayar Sendiri
					<?}?>
					</td>					
				</tr>
				
				<tr>
				<td>
					<label>Instansi</label> </td>
					<td>: <input name="instansi" type="text" size="20" value="<?php echo $instansix;?>" /></td>
										
					
				</tr>
				<tr>
					<td><label>Tanggal Pinjam</label> </td>
						<td>: <input type="date" name="tgl_pinjam" id="tanggal"  size="20" value="<? echo $tgl_pinjam;?>"/></td>
				</tr>
			
			</table>
			<hr>
			<table width="65%" border="1" bgcolor="#000000">
<tbody>
<tr>
<td style="text-align: left;" align="left" valign="top" bgcolor="#F5F5DC" width="auto"><span style="color: #000000;">
<fieldset>

				<legend>1. Perincian</legend>
				<!-- <form method="post" name="formPerincian" action="proses_pinjam.php" id="formPerincian">-->	
				<table>
				
				<tr>
					<td><label>a. Pinjaman Pokok</label> </td>
					<td>: <input name="pinjaman_pokok" type="text" size="30" onChange="hitungAngsuran()" value="<?php echo $pinjaman_pokok;?>" /></td>
				</tr>
				<tr>
					<td><label>b. Jasa</label> </td>
					<td>: <input name="jasa" type="text" size="30" onChange="hitungAngsuran()" value="<?php echo $jasa;?>" />%</td>
				</tr>
				<tr>
					<td><label>c. X Angsuran</label> </td>
					<td>: <input id="xangsuran" name="xangsuran" type="text" size="30" onChange="hitungAngsuran()" value="<?php echo $xangsuran;?>" /></td>
				</tr>
				<tr>
					<td><label>d. Angsuran</label> </td>
					<td>: <input name="angsuran" type="text" size="30" value="<?php echo $angsuran;?>" /></td>
				</tr>
				<tr>
					<td><label>e. Total Jasa</label> </td>
					<td>: <input name="tot_jasa" type="text" size="30" value="<?php echo $tot_jasa;?>" /></td>
				</tr>
				<tr>
					<td><label>f. Total Angsuran</label> </td>
					<td>: <input name="tot_angsuran" type="text" size="30" value="<?php echo $tot_angsuran;?>"  /></td>
				</tr>
				<tr>
					<td><label>g. Tanggal Mulai</label> </td>
					<td>: <input type="date" name="tgl_mulai" id="tanggal1"  size="30" value="<? echo $tgl_mulai;?>"/></td>
				</tr>
				<tr>
					<td><label>h. Tanggal Selesai</label> </td>
					<td>:  <input type="date" name="tgl_selesai" id="tanggal2"  size="30" value="<? echo $tgl_selesai;?>"/></td>
				</tr>
				</table> <br>
			
				<hr>
	<!--		<input type="button" size="30" value="Bukti Kas Masuk"/> <input type="button" size="30" value="Bukti Kas Keluar"/><br>
					</fieldset></span></td> -->
				</form>

</tr>
</tbody>
</table><br><br>

<div id="kontenbawah">

</div>			
</body>
</html>