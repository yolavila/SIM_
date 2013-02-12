<?php
	require("../../db_config.php");
	$str="select * from simpanan";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil simpanan");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM simpanan WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from simpanan";
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
<h1><b><font color=”#006400”>Form Simpanan</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<a href="form_simpanan.php?action=add" class="add" ><img src="../../images/add2.png" alt="" title="" border="0" width="40px" height="40px"></a>
<a href="../cetak/cetak.php"  onclick="self.history.back()"><img src="../../images/print.png" alt="" title="" border="0" width="40px" height="40px"></a>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/exit3.png" alt="" title="" border="0" width="40px" height="40px"></a>

<br><br><br>


<tr>

<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="no_simpanan" >No.simpanan
						<option value="npa" >NPA
						</select>
 <tr> <input type="text" name="search" id="search"></tr>
  <input type="submit" name="sbtn" id="submit" value="search"> 

</p>
</form>
</tr>

<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil simpanan");
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
	<th>No.Simpanan</th><th>NPA</th><th >Nama</th><th>Jumlah</th><th>Tanggal</th><th>Simpanan Wajib</th><th>Simpanan Pokok</th><th>Wajib Belanja</th><th>Keterangan</th><th width="50">Edit</th><th width="50">Delete</th>
	</tr> 
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
	$sql_ = $str." ORDER BY no_simpanan ASC LIMIT $batas, $item_per_page";
	
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
				<td><?php echo $ret['no_simpanan']; ?></td>
				<td><?php echo $ret['npa']; ?></td>
				<td><?php echo $ret['nama']; ?></td>
				<td><?php echo $ret['jumlah']; ?></td>
				<td><?php echo $ret['tgl']; ?></td>
				<td><?php echo $ret['simp_wajib']; ?></td>
				<td><?php echo $ret['simp_pokok']; ?></td>
				<td><?php echo $ret['wajib_belanja']; ?></td>
			<!--	<td><?php echo $ret['jenis_simpanan']; ?></td> -->
				<td><?php echo $ret['ket']; ?></td>
				<td><?php echo $ret['periode']; ?></td>
				
				<td align="center"><a href="form_simpanan.php?action=update&no_simpanan=<?php echo $ret['no_simpanan'];?>" class="edit"><img src="../../images/user_edit.png" alt="" title="" border="0"></a></td>
				<td align="center"><a href="proses_simpan.php?action=delete&no_simpanan=<?php echo $ret['no_simpanan'];?>" class="delete"><img src="../../images/trash.png"  border="0"></a></td>
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
	 <form action="" method="get">Ke Halaman:&nbsp <input type="text" name="page"><input type="submit" value="Go"></form> 	
	 <?php
	//Langkah 3: Hitung total data dan halaman
	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata Simpanan</b></p>";
	?>

</div>
</body>

</html>
