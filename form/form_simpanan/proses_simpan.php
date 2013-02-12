<?php
  include("../../db_config.php");//memanggil file koneksi database
  
  //GANTIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
	$testing = mysql_query("select substring(no_simpanan,4) as no from simpanan order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "SU-".($v + 1);
	
	
//Anggota Pasif	
function cekAktifPasif($npa)
{
	$query = mysql_query("select npa from anggota where npa = '$npa' AND tipe='p'") or die(mysql_error());
	if(mysql_num_rows($query) == 0)
	{
		//aktif -> benar
		return true;
	}
	else
	{
		return false;
	}
}
	
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['npa'];
	if(cekAktifPasif($npa))
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_simpanan/form_simpanan.php?id=$npa\">";
	}
	else
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_simpanan/form_simpanan.php?ket=pasif\">";
	}
  }else{
  
	if(isset($_POST))
	{
	$err = array();
	$action=$_POST['action'];
 	$no_simpanan=$kode_lanjut;
	$npa=$_POST['npa'];
	if($npa == "")
	{
		$error++;
		array_push($err, "npa");
	}
	$nama=$_POST['nama'];
	$tgl=$_POST['tgl'];
	$simp_wajib=$_POST['simp_wajib'];
	if($simp_wajib == "")
	{
		$error++;
		array_push($err, "simp_wajib");
	}
	$simp_pokok=$_POST['simp_pokok'];
	$simp_sukarela=$_POST['simp_sukarela'];
	$jumlah=$_POST['jumlah'];
	//$jenis_simpanan=$_POST['jenis_simpanan'];
	$ket=$_POST['ket'];
	}		
	if(isset($_POST['save']))
	{
	
		/**
			cek dahulu apakah id_barang master_barang terdapat
			di dalam database
		**/
		$check=mysql_query("select * from simpanan where no_simpanan='$no_simpanan'");
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
				$sql = mysql_query("insert into simpanan ( no_simpanan, npa, tgl, simp_wajib, simp_pokok, simp_sukarela, jumlah, ket, tipe) values ('$no_simpanan','$npa','$tgl','$simp_wajib','$simp_pokok','$simp_sukarela','$jumlah','$ket', 's')") or die(mysql_error());
				if(mysql_affected_rows() > 0)
				{
					echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_simpanan/form_simpanan.php">';
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
	if (isset($_POST['update'])){
		//no_simpanan naikkk
		$no_simpanan = $_POST['$no_simpanan'];
				$exec=mysql_query("update simpanan set 
									npa = '$npa',
									tgl = '$tgl',
									simp_wajib = '$simp_wajib',
									simp_pokok = '$simp_pokok',
									simp_sukarela = '$simp_sukarela',
									jumlah = '$jumlah',
									ket = '$ket'
									where npa='$npa'") or die (mysql_error());
			if ($exec){	
				echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_simpanan/tampil_simpanan.php">';
			}else{
				echo "gagal mengupdate";
			}
		} 
		
	}

?>