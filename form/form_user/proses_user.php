<?php
	error_reporting(0);
	include("../../db_config.php");
	if(isset($_POST))
	{
	$action=$_POST['action'];
	$username=$_POST['username'];
	$admin=$_POST['admin'];
	$ketua=$_POST['ketua'];
	$usp=$_POST['usp'];
	$toko=$_POST['toko'];
	$anggota=$_POST['anggota'];
	}
	if($action=="new")
	{
	
		/**
			cek dahulu apakah npa anggota terdapat
			di dalam database
		**/
		$check=mysql_query("select * from user where username='$username'");
		if(mysql_num_rows($check)==0)
		{
		
		mysql_query("insert into user ( username, admin, ketua, usp, toko, anggota) values ('$username','$admin','$ketua','$usp','$toko','$anggota')") or die(mysql_error());
		echo 1;
		}
		else
		{
			echo "user sudah ada";
		}
		exit;
	}
	else if($action=="update")
	{
		$exec=mysql_query("update user set 
		username = '$username',
		admin = '$admin',
		ketua = '$ketua',
		usp = '$usp',
		toko = '$toko',
		anggota = '$anggota'
		where username='$username'") or die (mysql_error());
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		//echo $npa." ins ".$anggota;
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		$username=($_GET['username']);
		$exec = mysql_query("delete from user where username='$username'")or die("data tidak berhasil di hapus");
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/koperasi/form/form_anggota/anggota.php\">";
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
		
		
	}
	
?>