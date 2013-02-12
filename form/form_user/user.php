<?php
	require("../../db_config.php");
	$str="select * from user";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil user");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
	
		$str = "SELECT * FROM user WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="select * from user";
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
<h1><b><font color=”#006400”>Master user</b></font></h1>
<body bgcolor="#F5F5F5">
<div id="Formcontent"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<tr>

<form action="" method="post" name="pencarian" id="pencarian" >Search Option
						<td>: <select name="opsi" >
						<option value="username" >NPA
						</select>
 <tr> <input type="text" name="search" id="search"></tr>
  <input type="submit" name="sbtn" id="submit" value="Cari"> 

</form>
</tr>
<br>
<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil user");
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
		
		$("a.reset").click(function(){
			el=$(this);
			if(confirm("Anda yakin ingin mereset password?"))
			{
				$.ajax({
					url:$(this).attr("href"),
					type:"GET",
					success:function(hasil)
					{
						if(hasil==1)
						{
							alert('Berhasil Merestart password');
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
<th  width="11%">NPA</th><th width="11%">Admin</th><th width="11%">Ketua</th><th width="11%">USP</th><th width="11%">Toko</th><th width="11%">Anggota</th><th width="11%">Edit</th><th width="11%">Delete</th><th width="12%">Reset Password</th>
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
	//$sql = "SELECT * FROM user";

	//paging( $sql,$item_per_page );
	$batas = ($page - 1) * $item_per_page;
	$sql_ = $str." ORDER BY username ASC LIMIT $batas, $item_per_page";
	
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
	
			<td><?php echo $ret['username']; ?></td>
			<td align="center"><?php echo $ret['admin']; ?> </td>
			<td align="center"><?php echo $ret['ketua']; ?> </td>
			<td align="center"><?php echo $ret['usp']; ?> </td>
			<td align="center"><?php echo $ret['toko']; ?></td>
			<td align="center"><?php echo $ret['anggota']; ?></td>
			
			<td align="center"><a href="form_user.php?action=update&username=<?php echo $ret['username'];?>" class="edit"><img src="../../images/user_edit.png" alt="" title="" border="0"></a></td>
			<td align="center"><a href="proses_user.php?action=delete&username=<?php echo $ret['username'];?>" class="delete"><img src="../../images/trash.png"  border="0"></a></td>
			<td align="center"><a href="proses_reset.php?action=reset&npa=<?php echo $ret['username'];?>" class="reset"><img src="../../images/ResetIcon.png"  border="0"></a></td>
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
	<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>


</div>
</body>

</html>
