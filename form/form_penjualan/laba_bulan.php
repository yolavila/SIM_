<?php
	require("../../db_config.php");
	//$str="select * from pinjaman_barang";
	//$res=mysql_query($str) or die("query gagal dijalankan pada tampil pinjaman_barang");
	
	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "select distinct(monthname(tgl_jual)) as periode from penjualan where year(tgl_jual) = '$opsi'";
		//echo $str;
	}else{
		$str="select distinct(monthname(tgl_jual)) as periode from penjualan";
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
<h1><b><font color=”#006400”>Laba Penjualan Perbulan</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<table border=0 width="120%">
<tr><td width="80%"><form action="" method="post" name="pencarian" id="pencarian" >Cari
						: <select name="opsi" >
						<option value="">Pilih Tahun</option>
						<?php
							$thn = mysql_query("SELECT distinct year(tgl_jual) as tahun FROM penjualan");
							while($tahun = mysql_fetch_array($thn))
							{
								if($opsi == $tahun['tahun'])
								{
									echo "<option value=\"".$tahun['tahun']."\" selected>".$tahun['tahun']."</option>";
								}
								else
								{
									echo "<option value=\"".$tahun['tahun']."\">".$tahun['tahun']."</option>";
								}
							}
						?>
						</select>
  <input type="submit" name="sbtn" id="submit" value="Cari"> 
</td><td style="text-align:right;">
	 <?php
	//Langkah 3: Hitung total data dan halaman
	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata Barang</b></p>";
	?>
</td>
</form>
</tr></table>

<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil anggota");
		?> 
		
	<script type="text/javascript">
	$(function(){
		$("a.edit").click(function(){
			page=$(this).attr("href");
			$("#Formcontent").html("loading...").load(page);
			return false;
		})
		$("a.delete").click(function(){
			el=$(this);
			if(confirm("Anda yakin data dihapus?"))
			{
				$.ajax({
					url:$(this).attr("href"),
					type:"GET",
					success:function(hasil)
					{
						if(hasil==1)
						{
							el.parent().parent().fadeOut('slow');
						}
						else
						{
							alert(hasil);
						}
					}
				})
			}
			return false;
		})
	})
	</script>

	<table width="50%" border="1" cellpadding="5" cellspacing="0">

	<thead>
	<tr bgcolor="#3CB371">
	<th>Bulan</th><th>Laba (Cash)</th><th>Laba (Kredit)</th>
	</thead>

	<tbody>

	<?php
	$page =  isset($_GET['page']) ? $_GET['page'] : 1 ; // halaman adalah didapat dari GET page. Jika tidak ada ya berarti halaman satu
	if( ( $page < 1) && (empty( $page ) ) ){
	  $page=1; 
	}
	$item_per_page = 20;
	$sql = $str;
	$query         = mysql_query( $sql );
	$jumlah_data   = mysql_num_rows($query);
	$jumlah_hal    = ceil( $jumlah_data/$item_per_page );
	if( $page>$jumlah_hal ){
	  $page=$jumlah_hal;
	}
	$lanjut  = $page + 1;
	$sebelum = $page - 1;
	?>

	<?php
	//$sql = "SELECT * FROM anggota";

	//paging( $sql,$item_per_page );
	$batas = ($page - 1) * $item_per_page;
	$sql_ = $str." ORDER BY tgl_jual ASC LIMIT $batas, $item_per_page";
	
	if ($jumlah_data==0){
	?>
		<tr class="gradeA">
			<td colspan="11"><center>Data Tidak ada<center></td>
		</tr>
	<?php
	}else{
	$query_ = mysql_query( $sql_ ) or die(mysql_error());
	while( $ret = mysql_fetch_array( $query_ ) ){
	?> 

	<tr class="gradeA">
				<td><?php echo $ret['periode']; ?></td>
				<td><?php
				$untung= mysql_query("SELECT b.id_barang, (b.harga_jual - b.harga_beli) as untung, sum(p.quatity) as jumlah, ((b.harga_jual - b.harga_beli)*sum(p.quatity)) as laba FROM `master_barang` b, penjualan p WHERE b.id_barang = p.id_barang and p.status='cash' and monthname(p.tgl_jual) = '".$ret['periode']."'")or die(mysql_error());
				//$untung = mysql_fetch_assoc($untung);
				$jml_laba = 0;
				while($laba = mysql_fetch_array($untung))
				{
					$jml_laba = $jml_laba + $laba['laba'];
				}
				echo $jml_laba;
				?></td>
				<td><?php
				$laba= mysql_query("SELECT SUM(tot_jasa) AS tot_jasa FROM pinjaman_barang where monthname(tgl_pinjam) = '".$ret['periode']."'")or die(mysql_error());
				$tot_jasa = mysql_fetch_assoc($laba);
				echo $tot_jasa['tot_jasa'];
				?></td>
		</tr>

	<?php
	 }
	}
	?>

	</tbody>
	</table>
	Hal <?php echo $page;?> dari <?php echo $jumlah_hal;?>
	&nbsp;&nbsp;
	<a href="?page=1">&lt;&lt;</a>&nbsp;&nbsp;<a href="?page=<?php echo $sebelum; ?>">&nbsp;Prev</a>&nbsp;&nbsp;
	||
	&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">Next&nbsp;</a>&nbsp;&nbsp;<a href="?page=<?php echo $jumlah_hal;?>">&gt;&gt;</a>
	 </align>
	 </br></br>

</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="60px" height="40px"></a>

</html>
