<?php
	session_start();
	require("../../db_config.php");
	$str="select * from pinjaman_uang";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil pinjaman");

		
	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
		if($_SESSION['level'] == 2 )
		{
			$str = "SELECT a.nama,s.* FROM `pinjaman_uang` s
					Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%'";
			$hapus = TRUE;
		}
		else
		{
			$npa = $_GET['npa'];
			$str = "SELECT a.nama,s.* FROM `pinjaman_uang` s
					Left Join anggota a on s.npa=a.npa WHERE s.".$opsi." LIKE '%$search%' AND s.npa = '$npa'";
			$hapus = FALSE;
		}
		//echo $str;
	}else{
		if($_SESSION['level'] == 2 ) //Tampilan Pada USP
		{
			$str="SELECT a.nama, a.instansi,s.* FROM `pinjaman_uang` s
					Left Join anggota a on s.npa=a.npa";
			$hapus = TRUE;
		}
		if($_SESSION['level'] == 4 ) //|| Tampilan Pada Anggota
		{
			$npa = $_GET['npa']; //select tampilan pinjaman anggota
			$str="SELECT a.nama, a.instansi,s.* FROM `pinjaman_uang` s
				inner join anggota a on s.npa=a.npa AND a.npa=$npa" ;
			$hapus = FALSE;
		}
		if($_SESSION['level'] == 1 ) //Tampilan Pada Ketua
		{
			$str="SELECT a.nama, a.instansi,s.* FROM `pinjaman_uang` s
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
	$eksekusi = mysql_query("delete from pinjaman_uang where no_pinjam='$no_pinjam'")or die("data tidak berhasil di hapus");
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

<body bgcolor="#F5F5F5"  LINK="black" >



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
	
					<h1><b><font color=”#006400”>Tampil Pinjaman Uang </b></font></h1>
					<div id="contact_form">
					<div id="main">
					</div>
					
	
    <table>
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
				<tr>
					<td><label>NPA</td>
					<td>:</td><td><?php echo $ret['npa']; ?></td>
				</tr>
				<tr>
					<td><label>Nama</td>
					<td>:</td><td><?php echo $ret['nama']; ?></td>
				</tr>
				<tr>
					<td><label>Instansi</td>
					<td>:</td><td><?php echo $ret['instansi']; ?></td>
				</tr>	
					
	<?php } ?>
	<?php
	 }
	?>
				
	<br>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
	<tr bgcolor="#3CB371">
	<th>No.Pinjam</th><th>Pinjaman Pokok</th><th>Jasa</th><th>X Angsuran</th><th>Angsuran</th><th>Total Jasa</th><th>Total Angsuran</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Periode</th>
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
				<td>
				<? 
				$data = $ret['sim_pokok'];
				echo " ".number_format($data,2);
				?></td>
				<td><?php echo $ret['jasa']; ?></td>
				<td><?php echo $ret['xangsuran']; ?></td>
					<td>
				<? 
				$data = $ret['angsuran'];
				echo " ".number_format($data,2);
				?></td>
				<td>
				<? 
				$data = $ret['tot_jasa'];
				echo " ".number_format($data,2);
				?></td>
				<td>
				<? 
				$data = $ret['tot_angsuran'];
				echo " ".number_format($data,2);
				?></td>
				<td><?php echo $ret['tgl_mulai']; ?></td>
				<td><?php echo $ret['tgl_selesai']; ?></td>
				<td><?php echo $ret['periode']; ?></td>
			</tr>
	<?php
	 }
	}
	?>

	</tbody>
	</table>
</div>
</body>
</html>
