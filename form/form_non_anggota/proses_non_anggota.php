<?php
	error_reporting(0);
	include("../../db_config.php");
	if(isset($_POST))
	{
	$action=$_POST['action'];
	$no=$_POST['no'];
	$nama=$_POST['nama'];
	$instansi=$_POST['instansi'];
	$alamat=$_POST['alamat'];
	$kota=$_POST['kota'];
	$jk=$_POST['jk'];
	}
	if($action=="new")
	{
	
		/**
			cek dahulu apakah npa anggota terdapat
			di dalam database
		**/
		$check=mysql_query("select * from non_anggota where no='$no'");
		if(mysql_num_rows($check)==0)
		{
		
		mysql_query("insert into non_anggota ( no, nama, instansi,alamat, kota, jk) values ('$no','$nama','$instansi','$alamat','$kota','$jk')") or die(mysql_error());
		echo 1;
		}
		else
		{
			echo "anggota sudah ada";
		}
		exit;
	}
	else if($action=="update")
	{
		$exec=mysql_query("update non_anggota set 
		nama = '$nama',
		instansi = '$instansi',
		alamat = '$alamat',
		kota = '$kota',
		jk = '$jk'
		where no='$no'") or die (mysql_error());
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		$no=intval($_GET['no']);
		$exec = mysql_query("delete from non_anggota where no='$no'")or die("data tidak berhasil di hapus");
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/koperasi/form/form_anggota/anggota.php\">";
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
		
		
	}
	
?>