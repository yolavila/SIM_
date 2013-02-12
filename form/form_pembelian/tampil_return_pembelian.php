<?php
	require("../../db_config.php");
	$str="select * from return_pembelian";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil return pembelian");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM return_pembelian WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
	$str="	SELECT m.nama as nambar, m.harga_beli, p.nama as namsup, s.* FROM return_pembelian s Left Join master_barang m  on s.id_barang=m.id_barang left join suplier p  on p.kode_suplier=s.kode_suplier";
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
	$id_return = $_GET['id_return'];
	if (isset($_GET['action'])){
	if ($action=="delete"){
	$eksekusi = mysql_query("delete from return_pembelian where id_return='$id_return'")or die("data tidak berhasil di hapus");
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
<h1><b><font color=”#006400”>Daftar Return Pembelian</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<br>
<tr>

<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="suplier">Suplier
						<option value="npb">NPB
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
<th>Suplier</th><th>Tgl Return</th><th>NPB</th><th>Id Barang</th><th>Nama Barang</th><th>Qty</th><th>Harga</th><th>Jumlah</th><th>Hapus</th>
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
			<td><?php echo $ret['namsup']; ?></td>
			<td><?php echo $ret['tgl']; ?></td>
			<td><?php echo $ret['npb']; ?></td>
			<td><?php echo $ret['id_barang']; ?></td>
			<td><?php echo $ret['nambar']; ?></td>
			<td><?php echo $ret['quatity']; ?></td>
			<td><?php echo $ret['harga_beli']; ?></td>
			<td><?php echo $ret['jumlah']; ?></td>
			
	<td align="center"><a href="tampil_return_pembelian.php?action=delete&id_return=<?php echo $ret['id_return'];?>" 	onclick="return confirm('Anda Yakin Ingin Menghapus?')"><img src="../../images/trash.png"  border="0"></a></td>
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
	&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">Next&nbsp;</a>&nbsp;&nbsp;<a href="?page=<?php echo 		   $jumlah_hal;?>">&gt;&gt;</a>
	 </align>
	 </br></br>

</div>
</body>
<a href="../../admin.php"   onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="60px" height="40px"></a>

</html>
