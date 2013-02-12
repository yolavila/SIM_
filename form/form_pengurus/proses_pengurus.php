<?php
	error_reporting(0);
	include("../../db_config.php");
	if(isset($_POST))
	{
	$err = array();
	$action=$_POST['action'];
	
	$npa=$_POST['npa'];
	if($npa == "")
	{
		$error++;
		array_push($err, "npa");
	}
	$nama=$_POST['nama'];
	$jabatan=$_POST['jabatan'];
	if($jabatan == "")
	{
		$error++;
		array_push($err, "jabatan");
	}
	$jk=$_POST['jk'];
	$ttl=$_POST['ttl'];
//	$alamat=$_POST['alamat'];
	$telp=$_POST['telp'];
	}
	if($action=="new")
	{
	
		/**
			cek dahulu apakah npa pegawai terdapat
			di dalam database
		**/
		$check=mysql_query("select * from pengurus where npa='$npa'");
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
		$sql = "insert into pengurus ( npa, jabatan) values ('$npa','$jabatan')";
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
		$exec=mysql_query("update pengurus set 
		jabatan = '$jabatan'
		where npa='$npa'") or die (mysql_error());
		if ($exec){
		echo 1 ;
		}else{
			echo "gagal mengupdate";
		}
		//echo $npa." ins ".$pegawai;
		exit;
	}
	elseif($_GET['action']=="delete")
	{
		$npa=($_GET['npa']);
		$exec = mysql_query("delete from pengurus where npa='$npa'")or die("data tidak berhasil di hapus");
		//echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/koperasi/form/form_pegawai/pegawai.php\">";
		if ($exec){
		echo 1;
		}else{
			echo "gagal menghapus";
		}
		exit;
		
		
	}
	elseif($_GET['action']=="add")
	{
		$cariagt = "SELECT nama, instansi FROM anggota WHERE npa='$npax' LIMIT 0,1";
		$qcari	 = mysql_query($cariagt) or die(mysql_error());
		$datacari= mysql_fetch_assoc($qcari);
		//if ($nama != "") $namax	 = $nama; 
		//else 
		$namax	 = $datacari['nama'];
		$instansix	 = $datacari['instansi'];
		$itung	 = "SELECT count(*) as jml FROM `anggota` WHERE npa='$npax'";
		$qitung  = mysql_fetch_assoc(mysql_query($itung));
		$hitung  = $qitung['jml'];
		if (($hitung==0)&&($npax!='')){
			?>
			<script type="text/javascript">
				alert("NPA tidak terdaftar");			
			</script>
			<?php
		}
	}
	
?>