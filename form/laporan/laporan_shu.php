<!--<?php
	require("../../db_config.php");
	$str="select * from pinjaman_uang";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil pinjaman_uang");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM pinjaman_uang WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select distinct(year(tgl_pinjam)) as periode from pinjaman_uang";
	}

	?>  -->
	

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
<h1><b><font color=”#006400”><center>Laporan SHU(Sisa Hasil Usaha)</center></b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<br>


<tr>
</tr>

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
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
	<tr bgcolor="#3CB371">
	<th>Periode</th><th>Sisa Hasil Usaha</th><th>Jasa Pinjam (60%)</th><th>Jasa Sosial (15%)</th><th>Jasa Modal (12,5%)</th><th >Cadangan (12,5%)</th></tr> 
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
	$sql_ = $str." ORDER BY npa ASC LIMIT $batas, $item_per_page";
	
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
				$shu= mysql_query("SELECT SUM(tot_jasa) AS tot_jasa FROM pinjaman_uang")or die(mysql_error());
				$tot_jasa = mysql_fetch_assoc($shu);
				$totjasa = $tot_jasa['tot_jasa'];
				echo " ".number_format($totjasa,0, ',', '.')?></td>
												
							
				<td><?php $data=($totjasa*0.60);
					echo " ".number_format($data,0, ',', '.'); ?>
				</td>
				<td><?php $data=($totjasa*0.15); 
					echo " ".number_format($data,0, ',', '.'); ?>
				</td>
				<td><?php $data=($totjasa*0.125); 
					echo " ".number_format($data,0, ',', '.'); ?>
				</td>
				<td><?php $data=($totjasa*0.125); 
				echo " ".number_format($data,0, ',', '.'); ?>
				</td>
			
			
				
</tr>

	<?php
	 }
	}
	?>

	</tbody>
	</table>
	</form>
	Hal <?php echo $page;?> dari <?php echo $jumlah_hal;?>
	&nbsp;&nbsp;
	<a href="?page=1">&lt;&lt;</a>&nbsp;&nbsp;<a href="?page=<?php echo $sebelum; ?>">&nbsp;Prev</a>&nbsp;&nbsp;
	||
	&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">Next&nbsp;</a>&nbsp;&nbsp;<a href="?page=<?php echo $jumlah_hal;?>">&gt;&gt;</a>
	 </align>
	 </br></br>
	<!-- <form action="" method="get">Ke Halaman:&nbsp <input type="text" name="page"><input type="submit" value="Go"></form> -->	
	 <?php
	//Langkah 3: Hitung total data dan halaman
	
	//$tampil2= $str;
	//$hasil2=mysql_query($tampil2);
	//$jmldata=mysql_num_rows($hasil2);
	//echo "<p><b>Total : $jmldata Anggota</b></p>";
	?>

</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="60px" height="40px"></a>

</html>
