<?php
session_start();
$filex= "bayar_pinjaman_uang.php";

?>

<?php
	require("../../db_config.php");
	$str="select * from angsuran_uang";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil anggota");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
		
		$str = "SELECT * FROM angsuran_uang WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from angsuran_uang";
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
	var no_pinjam = document.getElementById("no_pinjam");
	//alert(no_pinjam.value);
	if(no_pinjam.value == "")
	{
		//alert("npa harus diisi dulu");
		//return false;
		cek = cek+1;
		salah.push("nomor pinjam wajib diisi");
	}
//	var tanggal = document.getElementById("tanggal1");
//	if(tanggal.value == "")
//	{
//		cek=cek+0;
//		salah.push("tanggal harus diisi");
//	}
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
<script type="text/javascript" src="../../js/autoNumeric-1.7.5.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>

</head>

<script type="text/javascript">
$(function() {
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	$('#tanggal1').datepicker({dateFormat:'yy-mm-dd'});
	$('#tanggal2').datepicker({dateFormat:'yy-mm-dd'});
	});
</script>
<?php
	if (isset($_POST['caribtn'])){
	$no_pinjam = $_POST['no_pinjam'];
//	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/bayar_pinjaman_uang.php?id=$npa\">";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/bayar_pinjaman_uang.php?id=$no_pinjam\">";
	}
	if(isset($_POST['save']))
	{
		$x=$_POST['xangsuran'];
		$no_pinjam = $_POST['no_pinjam'];
		$cek = 0;
		for($i=1;$i<=$x;$i++)
		{
			$byr = $_POST['bayar_'.$i.''];
			$idbyr = $_POST['idbayar_'.$i.''];
			if($byr == 1)
			{
				$qbyr = mysql_query("update angsuran_uang set bayar = '1' where id = '".$_POST['idbayar_'.$i.'']."'") or die(mysql_error());
				//echo $_POST['bayar_'.$i.''];
				if($qbyr)
				{
					$cek = $cek + 0;
				}
				else
				{
					$cek = $cek+1;
				}
			}
			else
			{
				$qbyr = mysql_query("update angsuran_uang set bayar = '0' where id = '".$_POST['idbayar_'.$i.'']."'") or die(mysql_error());
				//echo $_POST['bayar_'.$i.''];
				if($qbyr)
				{
					$cek = $cek + 0;
				}
				else
				{
					$cek = $cek+1;
				}
			}
		}
		if($cek == 0)
		{
			echo "Berhasil mengupdate";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/bayar_pinjaman_uang.php?id=$no_pinjam\">";
		}
		else
		{
			echo "Ada yg error";
		}
	}
	include("../../db_config.php");
//	$npax=$_GET['id'];
	$no_pinjamx=$_GET['id'];
	if(!isset($no_pinjamx))
	{
		$no_pinjamx = "";
	}
	$cariagt = "SELECT a.npa,a.nama, a.instansi, p.no_pinjam, p.pinjaman_pokok, p.jasa, p.xangsuran, p.angsuran, p.tot_jasa, p.tot_angsuran, p.tgl_mulai, p.tgl_selesai FROM pinjaman_uang p inner join anggota a on a.npa=p.npa AND p.no_pinjam='$no_pinjamx' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$jmlData = mysql_num_rows($qcari);
	if ($jmlData == 0 && $no_pinjamx != ""){
	?>
		<script type="text/javascript">
		alert("NO Pinjaman Tidak Ada");			
		</script>
	<?php
	}
	$datacari	 = mysql_fetch_assoc($qcari);
	$npax		 = $datacari['npa'];
	$namax		 = $datacari['nama'];
	$instansix	 = $datacari['instansi'];
	$no_pinjamx  = $datacari['no_pinjam'];
	$pinjaman_pokokx = $datacari['pinjaman_pokok'];
	$jasax	     = $datacari['jasa'];
	$xangsuranx	 = $datacari['xangsuran'];
	$angsuranx	 = $datacari['angsuran'];
	$tot_jasax	 = $datacari['tot_jasa'];
	$tot_angsuranx	 = $datacari['tot_angsuran'];
	$tgl_mulaix	 = $datacari['tgl_mulai'];
	$tgl_selesaix	 = $datacari['tgl_selesai'];
	$itung	 = "SELECT count(*) as jml FROM `pinjaman_uang` WHERE npa='$npax'";
	$qitung  = mysql_fetch_assoc(mysql_query($itung));
	$hitung  = $qitung['jml'];	
	
?>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
a:link{text-decoration:none;}
</style>
<body bgcolor="#F5F5F5" onload="document.formAngsuran.no_pinjam.focus()">
	
   <fieldset>
    
 <form method="post" name="formAngsuran" action="<?php echo $filex;?>" id="formAngsuran" onSubmit="return cek();">	
    
<h1><b><font color=”#006400”>Form Bayar Angsuran</b></font></h1>
<div class="button"> 
<button type="submit" name="save" value="simpan"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_angsuran_uang.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>

<a href="../../admin.php?menu=usp"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	
<br>
              	<table>
				<tr>
				<td><label>No.Pinjam</label> </td>
					<td>: <input name="no_pinjam" id="no_pinjam" type="text" size="20" value="<?php echo $no_pinjamx;?>"/>
						<input type="submit" name="caribtn" id="submit" value="Cari"> </td>
				</tr>
				</fieldset>	
				<tr>
					<td><label>NPA</label> </td>
					<td>: <input name="npa" id="npa" value="<?php echo $npax;?>" > </td>
				<!--	<input type="submit" name="caribtn" id="submit" value="Cari"> </td> -->
				</tr>
				<tr>
					<td><label>Nama</label> </td>
					<td>: <input name="nama" type="text" size="20" value="<?php echo $namax;?>"/></td>
				</tr>
				<tr>
					<td><label>Instansi</label> </td>
					<td>: <input name="instansi" type="text" size="20" value="<?php echo $instansix;?>"/></td>
				</tr>
				
			
			</table>
			<hr>
			<table width="100%" border="1" bgcolor="#000000">
<tbody>
<tr>
<td style="text-align: left;" align="left" valign="top" bgcolor="#F5F5DC" width="40%"><span style="color: #000000;">
<fieldset>
				<legend>1. Perincian </legend>
				<table>
				
				<tr>
					<td><label>a. Pinjaman Pokok</label> </td>
					<td>: <input name="pinjaman_pokok" type="text" size="30" value="<?php echo $pinjaman_pokokx;?>" /></td>
				</tr>
				<tr>
					<td><label>b.Jasa</label> </td>
					<td>: <input name="jasa" type="text" size="30" value="<?php echo $jasax;?>"/></td>
				</tr>
				<tr>
					<td><label>c. X Angsuran</label> </td>
					<td>: <input name="xangsuran" type="text" size="30" value="<?php echo $xangsuranx;?>"/></td>
				</tr>
				<tr>
					<td><label>d. Angsuran</label> </td>
					<td>: <input name="angsuran" type="text" size="30" value="<?php echo $angsuranx;?>"/></td>
				</tr>
				<tr>
					<td><label>e. Total Jasa</label> </td>
					<td>: <input name="tot_jasa" type="text" size="30" value="<?php echo $tot_jasax;?>" /></td>
				</tr>
				<tr>
					<td><label>f. Total Angsuran</label> </td>
					<td>: <input name="tot_angsuran" type="text" size="30" value="<?php echo $tot_angsuranx;?>"/></td>
				</tr>
				<tr>
					<td><label>g. Tanggal Mulai</label> </td>
					<td>: <input name="tgl_mulai" id="tanggal1" type="text" size="30" value="<?php echo $tgl_mulaix;?>" /></td>
				</tr>
				<tr>
					<td><label>h. Tanggal Selesai</label> </td>
					<td>: <input name="tgl_selesai" id="tanggal2" type="text" size="30" value="<?php echo $tgl_selesaix;?>"/></td>
				</tr>
				<tr>	
<!--					<td> &nbsp&nbsp&nbsp  <b><label>Nilai Jasa<label> </b></td>
					<td>: <input name="jumlah" type="text" size="30" /></td>
				</tr> -->
				</table> <br>
				<hr>
		<!--		<input type="button" size="30" value="Bukti Kas Masuk"/> -->
</fieldset></span></td>
<td style="text-align: left;" align="left" valign="top" bgcolor="#F5F5DC" width="auto"><span style="color: #000000;">
<fieldset>
			<legend>2. Perincian Cicilan</legend>
	
	<table width="" border="1" cellpadding="5" cellspacing="0">
	<thead>
	<tr bgcolor="#3CB371" align="center" >
		<th width="7%">Npa</th><th width="7%">No Pinjam</th><th width="4%" >Angsuran Ke-</th><th width="13%" >Tgl Angsur</th><th width="20%">Angsuran</th><th width="3%">Bayar</th>
	</tr> 
	</thead>
	
	<?php
	//for ($i=1;$i<=$xangsuranx;$i++){
	$no = 1;
	//$no_pinjamx=$_GET['id'];
	if(isset($no_pinjamx))
	{
	$cariang = "Select * from angsuran_uang where no_pinjam='$no_pinjamx'";
	$qcariang	 = mysql_query($cariang) or die(mysql_error());
	while($datacariang = mysql_fetch_array($qcariang))
	{
	?>
				
				<tr>
				<th><?php echo $npax;?></th>
				<th><?php echo $no_pinjamx;?></th>
				<th align="center"><?php echo $no; ?></th>
				<th><?php echo $datacariang['tgl_pinjam']; ?></th>
				<th><?php echo $angsuranx;?></th>
				<th align="center"><input type="checkbox" value="1" name="bayar_<?php echo $no; ?>" <?php if($datacariang['bayar'] == '1'){ echo "checked"; }?>/>
				<input type="hidden" value="<?php echo $datacariang['id']; ?>" name="idbayar_<?php echo $no; ?>"></input>
				</th>
				</tr>
				<?php
					$no++;
					}
					}
				?>
				
	</table> 
	Sisa Angsuran :
	<?php
	//echo "no-->0".$no_pinjamx."0";
	if(!isset($no_pinjamx))
	{
		$no_pinjamx = 0;
	}
	$qsisa = mysql_query("SELECT SUM(angsuran) AS tot_angsuran FROM angsuran_uang where no_pinjam = '$no_pinjamx' and bayar = '0'")or die(mysql_error());
	$sisa = mysql_fetch_assoc($qsisa);
	if(($sisa['tot_angsuran']) == NULL)
	{
		echo "0";
	}
	else
	{
		$data=$sisa['tot_angsuran'];
		echo " ".number_format($data,2);
	}
	?>
	
				
<!--	<input type="button" size="30" value="Cek Status Bayar"/> <br> -->
	</fieldset>
</span></td>
</tr>
</tbody>
</table>
	
<br><br>
			
<div id="kontenbawah">

</div>
</html>