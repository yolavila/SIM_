<?php
	require("../../db_config.php");

	$str="SELECT a.nama, a.instansi,s.* FROM `return_penjualan` s Left Join anggota a on s.npa=a.npa";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil penjualan");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM return_penjualan WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="SELECT a.nama, a.instansi, mb.nama as nambar, mb.harga_jual,s.* FROM `return_penjualan` s Left Join anggota a on s.npa=a.npa left join master_barang mb on s.id_barang=mb.id_barang";
	}

	?> 
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
	$eksekusi = mysql_query("delete from return_penjualan where id_return='$id_return'")or die("data tidak berhasil di hapus");
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

<body bgcolor="#F5F5F5">
<div id="content">

	<script type="text/javascript">
	$(function(){
		$("a.edit").click(function(){
			page=$(this).attr("href");
			$("#Formcontent").html("loading...").load(page);
			return false;
		})
	})
	</script>
				<fieldset>
					<h1><b><font color=”#006400”>Tampil Return Penjualan</b></font></h1>
					<div id="contact_form">
					<div id="main">
					</div>
					<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi">
						<option value="njb">NJB
						<option value="npa">NPA
						<option value="nama">Nama
						</select>
						<tr> <input type="text" name="search" id="search"></tr>
						<input type="submit" name="sbtn" id="submit" value="Cari"> 

</p>
</form>
</fieldset>	
<table border=0 width="100%">
<tr><td width="50%">
</td><td style="text-align:right;">
	 <?php
	//Langkah 3: Hitung total data dan halaman
/*	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata Transaksi</b></p>";*/
	?> 
</td>
</form>
</tr></table>

	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
	<tr bgcolor="#3CB371">
	<th>NPA</th><th >Nama</th><th>Instansi</th><th>Tanggal Return</th><th>Id Brg</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Jumlah</th><th width="50">Delete</th>
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
				<td><?php echo $ret['npa']; ?></td>
				<td><?php echo $ret['nama']; ?></td>
				<td><?php echo $ret['instansi']; ?></td>
				<td><?php echo $ret['tgl']; ?></td>
				<td><?php echo $ret['id_barang']; ?></td>
				<td><?php echo $ret['nambar']; ?></td>
				<td><?php echo $ret['harga_jual']; ?></td>
				<td><?php echo $ret['quatity']; ?></td>
				<td><?php echo $ret['jumlah']; ?></td>
				<td align="center"><a href="tampil_return_jual.php?action=delete&id_return=<?php echo $ret['id_return'];?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')"><img src="../../images/trash.png"  border="0"></a></td>
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
<a href="../../admin.php"   onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>
</html>
