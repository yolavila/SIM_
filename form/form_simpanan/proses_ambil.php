<?php
  include("../../db_config.php");//memanggil file koneksi database
  //GANTIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
	$testing = mysql_query("select substring(no_simpanan,4) as no from simpanan order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "SU-".($v + 1);
	
  
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['npa'];
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_simpanan/ambil.php?id=$npa\">";
  }else{
  
	$npa=$_POST['npa'];
	$no_simpanan=$_POST['no_simpanan'];
	$jumlah=$_POST['jumlah'];
	$tgl=$_POST['tgl'];
	$ket=$_POST['ket'];
	$simp_wajib = 0;
	$simp_pokok = 0;
	$simp_sukarela = 0;
	$status = $_POST['status'];
	if($status == 1)
	{
		$simp_wajib=$_POST['simp_'];
	}
	if($status == 2)
	{
		$simp_pokok=$_POST['simp_'];
	}
	if($status == 3)
	{
		$simp_sukarela=$_POST['simp_'];
	}
	
	if (isset($_POST['update'])){
				$exec=mysql_query("update simpanan set 
									npa = '$npa',
									tgl = '$tgl',
									simp_wajib = '$simp_wajib',
									simp_pokok = '$simp_pokok',
									simp_sukarela = '$simp_sukarela',
									ket = '$ket'
									where npa='$npa'") or die (mysql_error());
			if ($exec){	
				echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_simpanan/tampil_simpanan.php">';
			}else{
				echo "gagal mengupdate";
			}
		} else if (isset($_POST['save'])){
			$exec =  mysql_query("insert into simpanan (no_simpanan, npa, tgl, simp_wajib, simp_pokok, simp_sukarela, jumlah, ket, tipe ) values ('$kode_lanjut ','$npa','$tgl','$simp_wajib', '$simp_pokok', '$simp_sukarela', '$jumlah', '$ket', 'a')") or die("insert ".mysql_error());
			if ($exec){	
				echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_simpanan/tampil_ambil.php">';
			}else{
				echo "gagal menyimpan";
			}
		}
		
	}

?>

<?
//  {
     //buat susunan query sql sementara dalam variabel
//     mysql_query("insert into simpanan ( no_simpanan, npa, nama, tgl, simp_wajib, simp_pokok, simp_sukarela, jumlah, jenis_simpanan, ket, tipe ) values ('$no_simpanan','$npa','$nama','$tgl','$simp_wajib', '$simp_pokok', '$simp_sukarela', '$jumlah', '', '$ket', 'a')") or die(mysql_error());
     //jalankan query
    // mysql_query($query) or die("Gagal menyimpan karena :".mysql_error());
     //or die digunakan untuk memunculkan pesan jika query gagal dijalankan
//     echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
//	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_simpanan/ambil.php\">";
//	} 
	
//}

?>