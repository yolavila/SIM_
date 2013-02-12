<?php
	require("../../db_config.php");
	$str="select s.nama as namsup,m.* from master_barang m Left Join suplier s on m.kode_suplier=s.kode_suplier";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil master barang");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
	$str = "select s.nama as namsup,m.* from master_barang m Left Join suplier s on m.kode_suplier=s.kode_suplier WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
	$str="select s.nama as namsup,m.* from master_barang m Left Join suplier s on m.kode_suplier=s.kode_suplier";
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
<h1><b><font color=”#006400”>Master Barang</b></font></h1>
<body bgcolor="#F5F5F5"  LINK="black">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN suplier FILE BENAR!
-->
<a href="form_barang.php?action=add" class="add" ><img src="../../images/add2.png" alt="" title="" border="0" width="40px" height="40px"></a>
<a href="../../admin.php?menu=toko"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>

<br>
<hr width="100%">
<table border=0 width="100%">
<tr><td width="80%"><form action="" method="post" name="pencarian" id="pencarian" >Cari
						: <select name="opsi" >
						<option value="id_barang">ID Barang
						<option value="kategori">Kategori
						<option value="satuan">Satuan
						</select>
<input type="text" name="search" id="search">
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

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil master_barang");
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
<th width="10%">Id</th><th width="15%">Nama Barang</th><th width="10%">Harga Beli</th><th width="10%">Harga Jual</th><th width="10%">Kategori</th><th width="15%">Suplier</th><th width="5%">Jumlah</th><th width="10%">Satuan</th><th width="5%">Diskon (%)</th><th width="5%">Titip</th><th width="5%">Delete</th>
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
	//$sql = "SELECT * FROM master_barang";

	//paging( $sql,$item_per_page );
	$batas = ($page - 1) * $item_per_page;

	$sql_ = $str." ORDER BY CONVERT(SUBSTRING_INDEX(id_barang,'-',-1),UNSIGNED INTEGER) ASC LIMIT $batas, $item_per_page";
	
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
			<td><?php echo $ret['id_barang']; ?></td>
			<td><a href="form_barang.php?action=update&id_barang=<?php echo $ret['id_barang'];?>&ks=<?php echo $ret['kode_suplier'];?>" style="text-decoration:none" class="edit"><?php echo $ret['nama']; ?></td>
				<td>
				<? 
				$data = $ret['harga_beli'];
				echo " ".number_format($data,0, ',', '.');
				?></td>
			<td>
				<? 
				$data = $ret['harga_jual'];
				echo " ".number_format($data,0, ',', '.');
				?></td>
			<td><?php echo $ret['kategori']; ?></td>
			<td><?php echo $ret['namsup']; ?></td>
			<td><?php echo $ret['jumlah']; ?></td>
			<td><?php echo $ret['satuan']; ?></td>
			<td><?php echo $ret['diskon']; ?></td> 
			<td><?php echo $ret['titip']; ?></td>
			
			<td align="center"><a href="proses_barang.php?action=delete&id_barang=<?php echo $ret['id_barang'];?>" class="delete"><img src="../../images/trash.png"  border="0"></a></td>
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
	 </div>
</body>

</html>
