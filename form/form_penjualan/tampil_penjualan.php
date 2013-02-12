<?php
	session_start ();
	require("../../db_config.php");
	$str="SELECT a.nama,a.instansi,s.* FROM `penjualan` s Left Join anggota a on s.npa=a.npa";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil penjualan");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
	
	if($_SESSION['level'] == 3 )
		{
			$str = "SELECT a.nama,a.instansi,s.* FROM `penjualan` s
			Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%'";
			$hapus = TRUE;
		}
		else
		{
			$npa = $_GET['npa'];
			$str = "SELECT a.nama,a.instansi,s.* FROM `penjualan` s
			Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%' AND s.npa = '$npa'";
			$hapus = FALSE;
		}
		//echo $str;
	}else{
		if($_SESSION['level'] == 3 ) //Tampilan Pada Toko
		{
			$str="SELECT a.nama as namang, a.instansi, m.nama as nambar, m.harga_jual, p.* FROM `penjualan` p
Left Join master_barang m on p.id_barang=m.id_barang Left Join anggota a on p.npa=a.npa";
			$hapus = TRUE;
		}
		
		if($_SESSION['level'] == 1 ) //Tampilan Pada Ketua
		{
			$str="SELECT a.nama as namang, a.instansi, m.nama as nambar, m.harga_jual, p.* FROM `penjualan` p
Left Join master_barang m on p.id_barang=m.id_barang Left Join anggota a on p.npa=a.npa";
			$hapus = FALSE;
		}
		if($_SESSION['level'] == 4 ) //Tampilan Pada Ketua
		{
			$str="SELECT a.nama as namang, a.instansi, m.nama as nambar, m.harga_jual, p.* FROM `penjualan` p
Left Join master_barang m on p.id_barang=m.id_barang Left Join anggota a on p.npa=a.npa";
			$hapus = FALSE;
		}
		
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
	$id_jual = $_GET['id_jual'];
	if (isset($_GET['action'])){
	if ($action=="delete"){
	$eksekusi = mysql_query("delete from penjualan where id_jual='$id_jual'")or die("data tidak berhasil di hapus");
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
					<h1><b><font color=”#006400”>Tampil Penjualan Barang</b></font></h1>
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
						<input type="submit" name="sbtn" id="submit" value="search"> 

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
	<th>NJB</th><th>NPA</th><th >Nama</th><th>Instansi</th><th>Tanggal Jual</th><th>Ket</th><th>Id Brg</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Jumlah</th><?php if($hapus){ ?><th>Hapus</th><?php } ?>
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
	$jumlah_data   = mysql_num_rows($query) or die(mysql_error());
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
				<td><?php echo $ret['njb']; ?></td>
				<td><?php echo $ret['npa']; ?></td>
				<td><?php echo $ret['namang']; ?></td>
				<td><?php echo $ret['instansi']; ?></td>
				<td><?php echo $ret['tgl_jual']; ?></td>
				<td><?php echo $ret['status']; ?></td>
				<td><?php echo $ret['id_barang']; ?></td>
				<td><?php echo $ret['nambar']; ?></td>
				<td><?php $data = $ret['harga_jual']; 
				echo " ".number_format($data);
				?></td>
				
				<td><?php echo $ret['quatity']; ?></td>
				<td><?php $data=$ret['jumlah']; 
				echo "".number_format($data);
				?></td>
	<?php if($hapus){ ?>			
	<td align="center"><a href="tampil_penjualan.php?action=delete&id_jual=<?php echo $ret['id_jual'];?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')"><img src="../../images/trash.png"  border="0"></a></td>
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
	&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">Next&nbsp;</a>&nbsp;&nbsp;<a href="?page=<?php echo $jumlah_hal;?>">&gt;&gt;</a>
	 </align>
	 </br></br>

</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>
</html>
