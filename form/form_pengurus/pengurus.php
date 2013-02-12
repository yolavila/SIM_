<?php
	require("../../db_config.php");
	$str="SELECT a.nama,s.* FROM `pengurus` s Left Join anggota a on s.npa=a.npa";
//	$str="select * from pengurus";
	$res=mysql_query($str) or die("query gagal dijalankan pada tampil pengurus");

	if (isset($_POST['sbtn'])){
		$search = $_POST['search'];
		$opsi = $_POST['opsi'];
		//TAMBAH Pencarian
		if($opsi == "npa")
		{
			$opsi = "s.".$opsi;
		}
		$str = "SELECT a.nama, a.ttl, a.jk, a.telp, s.* FROM `pengurus` s Left Join anggota a on s.npa=a.npa WHERE $opsi LIKE '%$search%'";
		//echo $str;
	}else{
		$str="SELECT a.nama, a.ttl, a.jk, a.telp, s.* FROM `pengurus` s Left Join anggota a on s.npa=a.npa";
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
		page=$(this).attr("href");
		$("#Formcontent").html("loading...").load(page);
		return false;
	})
	
	$("a.adds").click(function(){
		pages=$(this).attr("href");
		//alert(pages);
		$("#Formcontent2").html("loading...").load(pages);
		return false;
	})

	var t = document.getElementById('test');
	var t2 = document.getElementById('test2');
	//alert(t.value);
	//alert(t2.value);
	if(t.value == 1 && t2.value==1)
	{
		$("#adds").click();
		return false;
	}
	
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
<h1><b><font color=”#006400”>Master Pengurus</b></font></h1>
<body bgcolor="#F5F5F5"  LINK="black">
<?php
if(isset($_GET['npa']))
	{
	?>
		<input type="hidden" name="test" id="test" value="1" />
	<?php
		$npa = $_GET['npa'];
		$q = mysql_query("select nama, alamat, jk, npa from anggota where npa='$npa'");
		//echo mysql_num_rows($q);
		if(mysql_num_rows($q) > 0)
		{
			?>
				<input type="hidden" name="test2" id="test2" value="1" />
			<?php
			$r = mysql_fetch_row($q);
			$nama = $r[0];
			$alamat = $r[1];
			$npa_ = $r[3];
		}
	}
	else
	{	
		?>
			<input type="hidden" name="test" id="test" value="0" />
		<?php
	}
	
?>

<div id="Formcontent"></div>
<div id="Formcontent2"></div>

<!--
MEMANGGIL FORMBARANG.PHP UNTUK DITAMPILKAN PADA JAVASCRIPT
JIKA INGIN DIPINDAH, PASTIKAN LOKASI FILE BENAR!
-->
<a href="form_pengurus.php?action=add" class="add" id="add"><img src="../../images/add2.png" alt="" title="" border="0" width="40px" height="40px"></a>
<a href="form_pengurus.php?action=add&id=<?php echo $npa_; ?>" class="adds" id="adds" style='display:none;'></a>
<a href="../../admin.php"  onclick="self.history.back()"><img src="../../images/out2.gif" alt="" title="" border="0" width="50px" height="40px"></a>

<hr>

<tr>
<table border=0 width="100%">
<tr><td width="50%"><form action="" method="post" name="pencarian" id="pencarian" >Search Option
						: <select name="opsi" >
						<option value="npa" >Npa </option>
						<option value="jabatan">Jabatan </option>
						</select>
<input type="text" name="search" id="search">
<input type="submit" name="sbtn" id="submit" value="Cari"> 
</td><td style="text-align:right;">
	 <?php
	//Langkah 3: Hitung total data dan halaman
	
	$tampil2= $str;
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	echo "<p><b>Total : $jmldata pengurus</b></p>";
	?>
</td>
</form>
</tr></table>


<div id="content">

	<?php
		require("../../db_config.php");

		$res=mysql_query($str) or die("query gagal dijalankan pada tampil pengurus");
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
	<th width='10%'>NPA</th><th width='20%'>Nama</th><th width='20%'>Jabatan</th><th width='10%'>Jenis Kelamin</th><th width='20%'>TTL</th><th width='15%'>Telp</th><th width='5%'>Delete</th>
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
				<td><a href="form_pengurus.php?action=update&npa=<?php echo $ret['npa'];?>" style="text-decoration:none"  class="edit"><?php echo $ret['nama']; ?></td>
				<td><?php echo $ret['jabatan']; ?></td>
				<td><?php echo $ret['jk']; ?></td>
				<td><?php echo $ret['ttl']; ?></td>
				<td><?php echo $ret['telp']; ?></td>
							
				<td align="center"><a href="proses_pengurus.php?action=delete&npa=<?php echo $ret['npa'];?>" class="delete"><img src="../../images/trash.png"  border="0"></a></td>
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
