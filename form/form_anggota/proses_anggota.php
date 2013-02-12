<?php
	error_reporting(0);
	include("../../db_config.php");
	
	function get_code() {
		$query  = mysql_query("SELECT RIGHT(`npa`, 4) AS `SEQ` FROM `anggota` ORDER BY `npa` DESC");
		$result = $query;
	if ($result == (mysql_num_rows($result) > 0)) {
		$seq = mysql_result($result, 0);
		return $seq;
	} else return '000';

	}
	
	{
	$err = array();
	$action=$_POST['action'];
	
	//TAMBAH
	$npa=$_POST['npa'];
	$nama=$_POST['nama'];
	if($nama == "")
	{
		$error++;
		array_push($err, "nama");
	}
	
	$alamat=$_POST['alamat'];
	$instansi=$_POST['instansi'];
	if($instansi == "")
	{
		$error++;
		array_push($err, "instansi");
	}
	$kota=$_POST['kota'];
	$tgl_masuk = $_POST['tgl_masuk'];
	if($tgl_masuk == "")
	{
		$error++;
		array_push($err, "tgl_masuk");
	}
	$jk=$_POST['jk'];
	$ttl=$_POST['ttl'];
	$telp=$_POST['telp'];
	}
	if($action=="new")
	{

		/**	cek dahulu apakah kode master_barang terdapat di dalam database	**/
		$check=mysql_query("select * from anggota where npa='$npa'");
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
			/**	cek dahulu apakah npa anggota terdapatdi dalam database **/
		
		$check=mysql_query("select * from anggota where npa='$npa'");
		if(mysql_num_rows($check)==0)
		{
		
		$lastSeq = get_code();
		$npa_ = 0;
		$currSeq = $lastSeq+1;
		if (strlen($currSeq)==1)
		{
			  $npa_ .= '000'.$currSeq;
		}
		if (strlen($currSeq)==2)
		{
			  $npa_ .= '00'.$currSeq;
		}
		if(strlen($currSeq)==3)
		{
			  $npa_ .= '0'.$currSeq;
		}
		if(strlen($currSeq)==4)
		{
			  $npa_ .= $currSeq;
		}
		
		}
		
			$npa = $npa_;
			$username=$npa;
			$password=md5($npa);
		
				$sql = "insert into anggota ( npa, nama, alamat, instansi, kota, tgl_masuk, jk, ttl, telp, password, level, tipe) values ('$npa','$nama','$alamat','$instansi','$kota','$tgl_masuk','$jk','$ttl','$telp', '$password', '4', 'a')" ;
				mysql_query("insert into user ( username,anggota) values ('$npa','1')") or die(mysql_error());
		
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
			echo "anggota sudah ada";
		}
		exit;
		
		
	}
	else if($action=="update")
	{
		$exec=mysql_query("update anggota set 
		nama = '$nama',
		alamat = '$alamat',
		instansi = '$instansi',
		kota = '$kota',
		tgl_masuk = '$tgl_masuk',
		jk = '$jk',
		ttl = '$ttl',
		telp = '$telp'
		where npa='$npa'") or die (mysql_error());
		
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		$npa=$_GET['npa'];
		$exec = mysql_query("update anggota set tipe = 'p' where npa='$npa'")or die("data tidak berhasil di hapus");
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
	}
?>