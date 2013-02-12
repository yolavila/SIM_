<?php
	require("../../db_config.php");
	$str="select * from anggota";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil anggota");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM anggota WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from anggota where level='4' AND tipe='a'";
	}

	?> 

	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>

<!-- MENGHILANGKAN JAVA
<script type="text/javascript">
$(function(){
	/**
	FUNGSI UNTUK MENAMPILKAN TAMBAH FORM INSTANSI,
	DIGUNAKAN JAVASCRIPT UNTUK MENAMPILKAN FORM
	**/
	$(function(){
		page="form_anggota.php?action=add";
		$("#Formcontent").html("loading...").load(page);
		return true
	})
})
</script>
-->
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
<fieldset>
					<h1><b><font color=”#006400”>Informasi Anggota</b></font></h1>
					<div id="contact_form">
					<div id="main">
					</div>
					<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="npa">NPA
						<option value="nama">Nama
						<option value="jk">JK
						</select>
						<tr> <input type="text" name="search" id="search"></tr>
						<input type="submit" name="sbtn" id="submit" value="Cari"> 
						</p>
					</form>
</fieldset>	
<body bgcolor="#F5F5F5" LINK="black" >
<div id="Formcontent"></div>

<table border=0 width="115%">
<tr><td width="50%">
<!--<a href="../cetak/cetak.php"  onclick="self.history.back()"><img src="../../images/print.png" alt="" title="" border="0" width="40px" height="40px"></a>
-->

</td><td style="text-align:right;">
	 <?php
	//Langkah 3: Hitung total data dan halaman
	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2) or die(mysql_error()) ; //ganti
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata Anggota</b></p>";
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

	<table width="115%" border="1" cellpadding="5" cellspacing="0">

<thead>
	<tr bgcolor="#3CB371">
	<th width="5%">NPA</th><th width="20%">Nama</th><th width="25%">Alamat</th><th width="15%">Instansi</th><th width="5%">Kota</th><th width="5%">JK</th><th width="20%">TTL</th><th width="5%">Telp</th>
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
	$sql_ = $str." ORDER BY instansi ASC LIMIT $batas, $item_per_page";
	
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
				<td><?php echo $ret['nama']; ?></a></td>
				<td><?php echo $ret['alamat']; ?></td>
				<td><?php echo $ret['instansi']; ?></td>
				<td><?php echo $ret['kota']; ?></td>
				<td><?php echo $ret['jk']; ?></td>
				<td><?php echo $ret['ttl']; ?></td>
				<td><?php echo $ret['telp']; ?></td>
				
		<!--		<td align="center"><a href="form_anggota.php?action=update&npa=<?php echo $ret['npa'];?>" class="edit"><img src="../../images/user_edit.png" alt="" title="" border="0"></a></td>
				<td align="center"><a href="proses_anggota.php?action=delete&npa=<?php echo $ret['npa'];?>" class="delete"><img src="../../images/trash.png"  border="0"></a></td>-->
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
	 </br>
	<!-- <form action="" method="get">Ke Halaman:&nbsp <input type="text" name="page"><input type="submit" value="Go"></form> 	-->
	<!-- <?php
	//Langkah 3: Hitung total data dan halaman
	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata Anggota</b></p>";
	?>
-->
</div>
</body>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>

</html>