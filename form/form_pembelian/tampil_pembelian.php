<?php
	session_start ();
	require("../../db_config.php");
	$str="select * from pembelian";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil penjualan");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
	
	if($_SESSION['level'] == 3 )
		{
			$str = "SELECT m.nama as nambar, m.harga_jual, p.nama as namsup, s.* FROM pembelian s Left Join master_barang m  on s.id_barang=m.id_barang left join suplier p  on p.kode_suplier=s.kode_suplier WHERE s.".$opsi." LIKE '%$search%'";
			$hapus = TRUE;
		}
		else
		{
			$id_barang = $_GET['id_barang'];
			$str = "SELECT m.nama,m.harga_jual,s.* FROM `pembelian` s
			Left Join master_barang m on s.id_barang=m.id_barang WHERE s.".$opsi." LIKE '%$search%' AND s.id_barang = '$id_barang'";
			$hapus = FALSE;
		}
		//echo $str;
	}else{
		if($_SESSION['level'] == 3 ) //Tampilan Pada TOKO
		{
			$str="SELECT m.nama as nambar, m.harga_jual, p.nama as namsup, s.* FROM pembelian s Left Join master_barang m  on s.id_barang=m.id_barang left join suplier p  on p.kode_suplier=s.kode_suplier";
			$hapus = TRUE;
		}
		
		if($_SESSION['level'] == 1 ) //Tampilan Pada Ketua
		{
			$str="SELECT m.nama as nambar, m.harga_jual, p.nama as namsup, s.* FROM pembelian s Left Join master_barang m  on s.id_barang=m.id_barang left join suplier p  on p.kode_suplier=s.kode_suplier";
			$hapus = FALSE;
		}
		if($_SESSION['level'] == 0 ) //Tampilan Pada Ketua
		{
			$str="SELECT m.nama as nambar, m.harga_jual, p.nama as namsup, s.* FROM pembelian s Left Join master_barang m  on s.id_barang=m.id_barang left join suplier p  on p.kode_suplier=s.kode_suplier";
			$hapus = FALSE;
		}
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
<?php
	$action=$_GET['action'];
	$id_beli = $_GET['id_beli'];
	if (isset($_GET['action'])){
	if ($action=="delete"){
	$eksekusi = mysql_query("delete from pembelian where id_beli='$id_beli'")or die("data tidak berhasil di hapus");
	if ($eksekusi){
	?>

	<?php
	}	
	}
	}
	?>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
</head>
<fieldset>
<h1><b><font color=”#006400”>Daftar Pembelian</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<tr>

<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="nama">Nama
						<option value="satuan">Satuan
						</select>
 <tr> <input type="text" name="search" id="search"></tr>
  <input type="submit" name="sbtn" id="submit" value="Cari"> 

</p>
</form>
</tr>
</fieldset> <br>
<div id="content">

	<?php
		require("../../db_config.php");
		$res=mysql_query($str) or die("query gagal dijalankan pada tampil pembelian");
		?> 

		
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<thead>	
<tr bgcolor="#3CB371">
<th width="10%">Npb</th><th>Suplier</th><th>Tgl</th><th>Ket</th><th>Id Barang</th><th>Nama Barang</th><th>Quatity</th><th>Harga</th><th>Jumlah</th><?php if($hapus){ ?><th>Hapus</th><?php } ?>
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
	//$sql = "SELECT * FROM pembelian";

	//paging( $sql,$item_per_page );
	$batas = ($page - 1) * $item_per_page;
	$sql_ = $str." ORDER BY substring(npb,4)*1 ASC LIMIT $batas, $item_per_page";
	
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
			<td><?php echo $ret['npb']; ?></td>
			<td><?php echo $ret['namsup']; ?></td>
			<td><?php echo $ret['tgl']; ?></td>
			<td><?php echo $ret['ket']; ?></td>
			<td><?php echo $ret['id_barang']; ?></td>
			<td><?php echo $ret['nambar']; ?></td>
			<td><?php echo $ret['quatity']; ?></td>
			<td><?php echo $ret['harga_jual']; ?></td>
			<td><?php echo $ret['jumlah']; ?></td>
	<?php if($hapus){ ?>			
	<td align="center"><a href="tampil_pembelian.php?action=delete&id_beli=<?php echo $ret['id_beli'];?>" 	onclick="return confirm('Anda Yakin Ingin Menghapus?')"><img src="../../images/trash.png"  border="0"></a></td>
	</tr>
	<?php } ?>
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
	&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">Next&nbsp;</a>&nbsp;&nbsp;<a href="?page=<?php echo 		   $jumlah_hal;?>">&gt;&gt;</a>
	 </align>
	 </br></br>

</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="60px" height="40px"></a>

</html>
