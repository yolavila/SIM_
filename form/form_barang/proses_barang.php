<?php
	error_reporting(0);
	include("../../db_config.php");
	$testing = mysql_query("select substring(id_barang,4) as no from master_barang order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "BK-".($v + 1);
	$error = 0;
	//$errfield = array();
	
	if(isset($_POST))
	{
	$err = array();
	$action=$_POST['action'];
	$id_barang=$kode_lanjut;
	$suplier_=explode(" ",$_POST['suplier']);
	$suplier = $suplier_[1];
	$nama=$_POST['nama'];
	if($nama == "")
	{
		$error++;
		array_push($err, "nama");
	}
	$harga_beli=$_POST['harga_beli'];
	//MEMBUAT ALERT JIKA TIDAK MEMASUKKAN DATA
	if($harga_beli == "")
	{
		$error++;
		array_push($err, "harga beli");
	}
	$harga_jual=$_POST['harga_jual'];
	//MEMBUAT ALERT JIKA TIDAK MEMASUKKAN DATA
	if($harga_jual == "")
	{
		$error++;
		array_push($err, "harga jual");
	}
	$kategori=$_POST['kategori'];
	$jumlah=$_POST['jumlah'];
	//MEMBUAT ALERT JIKA TIDAK MEMASUKKAN DATA
	if($jumlah == "")
	{
		$error++;
		array_push($err, "Isi Semua Form Yang Tersedia Yang");
	}
	$satuan=$_POST['satuan'];
	$diskon=$_POST['diskon'];
	$kodeSuplier = $_POST['suplier_'];
	if(isset($_POST['titip']))
	{
		$titip = "titip";
	}
	
	}
	if($action=="new")
	{
	
		/**
			cek dahulu apakah id_barang master_barang terdapat
			di dalam database
		**/
		$check=mysql_query("select * from master_barang where id_barang='$id_barang'");
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
				$sql = "insert into master_barang ( id_barang, nama, harga_beli, harga_jual, kategori, kode_suplier,jumlah, satuan, diskon, titip ) values ('$id_barang','$nama','$harga_beli','$harga_jual','$kategori','$kodeSuplier','$jumlah','$satuan','$diskon','$titip')" ;
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
			echo "barang sudah ada";
		}
		exit;
	}
	else if($action=="update")
	{
		//TAMBAHHHHHHHH
		$id_barang=$_POST['id_barang'];
		$exec=mysql_query("update master_barang set 
		nama = '$nama',
		harga_beli = '$harga_beli',
		harga_jual = '$harga_jual',
		kategori = '$kategori',
		kode_suplier = '$kodeSuplier',
		jumlah = '$jumlah',
		satuan = '$satuan',
		diskon = '$diskon',
		titip= '$titip'
		where id_barang='$id_barang'") or die (mysql_error());
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		//echo $id_barang." ins ".$master_barang;
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		//TAMBAHHHHHHHHHHh
		$id_barang=($_GET['id_barang']);
		$exec = mysql_query("delete from master_barang where id_barang='$id_barang'")or die("data tidak berhasil di hapus");
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
		
		
	}
	
?>