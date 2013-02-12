<?php
	session_start();
	require("../../db_config.php");
	//$str="select * from pinjaman_uang";
	//$res=mysql_query($str) or die("query gagal dijalankan pada tampil pinjaman");

		
	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
		if($_SESSION['level'] == 3 )
		{
			$str = "SELECT a.nama,s.* FROM `pinjaman_barang` s
					Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%'";
			$hapus = TRUE;
		}
		else
		{
			$npa = $_GET['npa'];
			$str = "SELECT a.nama,s.* FROM `pinjaman_barang` s
					Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%' AND s.npa = '$npa'";
			$hapus = FALSE;
		}
		//echo $str;
	}else{
		if($_SESSION['level'] == 3 ) //Tampilan Pada Usp
		{
			$str="SELECT a.nama,a.instansi,s.* FROM `pinjaman_barang` s
					Left Join anggota a on s.npa=a.npa";
			$hapus = TRUE;
		}
		if($_SESSION['level'] == 4 ) //Tampilan Pada Anggota
		{
			$npa = $_GET['npa']; //select tampilan pinjaman anggota
			$str="SELECT a.nama,a.instansi,s.* FROM `pinjaman_barang` s
					inner join anggota a on s.npa=a.npa AND a.npa=$npa";
			$hapus = FALSE;
		}
		if($_SESSION['level'] == 1 ) //Tampilan Pada Ketua
		{
			$str="SELECT a.nama,a.instansi,s.* FROM `pinjaman_barang` s
					Left Join anggota a on s.npa=a.npa";
			$hapus = FALSE;
		}
		if($_SESSION['level'] == 0 ) //Tampilan Pada Admin
		{
			$str="SELECT a.nama,a.instansi,s.* FROM `pinjaman_barang` s
					Left Join anggota a on s.npa=a.npa";
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
	$no_pinjam = $_GET['no_pinjam'];
	if (isset($_GET['action'])){
	if ($action=="delete"){
	$eksekusi = mysql_query("delete from pinjaman_barang where no_pinjam='$no_pinjam'")or die("data tidak berhasil di hapus");
	if ($eksekusi){
	?>
		<script type="text/javascript">
			alert("Data berhasil dihapus");			
		</script>
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
<? 
?>
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
					<h1><b><font color=”#006400”>Tampil Angsuran Barang</b></font></h1>
					<div id="contact_form">
					<div id="main">
					</div>
					<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="npa">NPA
						<option value="no_pinjam">No Pinjaman
						<option value="nama">Nama
						<option value="instansi">Instansi
						</select>
						<tr> <input type="text" name="search" id="search"></tr>
						<input type="submit" name="sbtn" id="submit" value="search"> 

</p>
</form>
				</fieldset>		<br>

	<table width="80%" border="1" cellpadding="5" cellspacing="0">
	<thead>
	<tr bgcolor="#3CB371">
	<th width="10%">No.Pinjam</th><th width="8%">NPA</th><th width="20%">Nama</th><th width="100px">Instansi</th><th width="10px">Sisa Angsuran</th><th width="10px">Sisa Cicilan</th>
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
	$query         = mysql_query( $sql )  or die(mysql_error());
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
	$sql_ = $str." ORDER BY no_pinjam ASC LIMIT $batas, $item_per_page";
	
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
				<td><?php echo $ret['no_pinjam']; ?></td>
				<td><?php echo $ret['npa']; ?></td>
				<td><?php echo $ret['nama']; ?></td>
				<td><?php echo $ret['instansi']; ?></td>
				<td>
				<?php
				$qsisa = mysql_query("SELECT SUM(angsuran) AS tot_angsuran, count(angsuran) AS tot_cicilan FROM angsuran_barang where no_pinjam = '".$ret['no_pinjam']."' and bayar = '0'")or die(mysql_error());
				$sisa = mysql_fetch_assoc($qsisa);
	
				if(($sisa['tot_angsuran']) == NULL)
				{
					echo "0";
				}
				else
				{
					echo $sisa['tot_angsuran'];
				}
				?>
				</td>
				<td><?php echo $sisa['tot_cicilan']; ?></td>
	</tr>
	<?php
	 }
	}
	?>

</tbody>
</table>
</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>
	
</html>
