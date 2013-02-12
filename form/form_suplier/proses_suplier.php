<?php
	error_reporting(0);
	include("../../db_config.php");
	
	$testing = mysql_query("select substring(kode_suplier,4) as no from suplier order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "SB-".($v + 1);
	if(isset($_POST))
	{
	$err = array();
	$action=$_POST['action'];
	$kode_suplier=$kode_lanjut;
	$nama=$_POST['nama'];
	if($nama == "")
	{
		$error++;
		array_push($err, "nama");
	}
	$alamat=$_POST['alamat'];
	if($alamat == "")
	{
		$error++;
		array_push($err, "alamat");
	}
	$kota=$_POST['kota'];
	$telepon=$_POST['telepon'];
	}
	if($action=="new")
	{
	
		/**
			cek dahulu apakah kode suplier terdapat
			di dalam database
		**/
		/**
			cek dahulu apakah kode suplier terdapat
			di dalam database
		**/
		$check=mysql_query("select * from suplier where kode_suplier='$kode_suplier'");
		if(mysql_num_rows($check)==0)
		{
			if($error > 0)
			{
				//echo "lengkapi data";
				for($i=0; $i<count($err);$i++)
				{
					echo $err[$i]." belum diisi";
					echo "\n";
				}
			}
			else
			{
				$sql = "insert into suplier (kode_suplier, nama, alamat, kota,telepon) values ('$kode_suplier','$nama','$alamat','$kota','$telepon')";
				if(mysql_query($sql))
				{
					echo 1;
				}
				else
				{
					echo "Terjadi Kesalahan";
				}
			}
		}
		else
		{
			echo "Suplier sudah ada";
		}
		exit;
	}
	else if($action=="update")
	{
	//TAMBAHHHHHHH INIII
		$kode_suplier=($_POST['kode_suplier']);
		$exec=mysql_query("update suplier set 
		nama = '$nama',
		alamat = '$alamat',
		kota = '$kota',
		telepon = '$telepon'
		where kode_suplier='$kode_suplier'") or die (mysql_error());
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		//echo $kode." ins ".$suplier;
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		$kode_suplier=($_GET['kode_suplier']);
		$exec = mysql_query("delete from suplier where kode_suplier='$kode_suplier'")or die("data tidak berhasil di hapus");
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/koperasi/form/form_suplier/suplier.php\">";
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
		
		
	}
	
?>