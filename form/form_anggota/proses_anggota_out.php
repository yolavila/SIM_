<?php
  include("../../db_config.php");//memanggil file koneksi database
    //GANTIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
	$testing = mysql_query("select substring(no_simpanan,4) as no from simpanan order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "OUT-".($v + 1);
	
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
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_anggota/anggota_out.php?id=$npa\">";
	}
	else
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_anggota/anggota_out.php?ket=pasif\">";
	}
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
		$simp_wajib=$_POST['simp_wajib'];
		$simp_pokok=$_POST['simp_pokok'];
		$simp_sukarela=$_POST['simp_sukarela'];
	}
	
	if (isset($_POST['save'])){
			$exec =  mysql_query("insert into simpanan ( no_simpanan, npa, tgl, simp_wajib, simp_pokok, simp_sukarela, jumlah, ket, tipe ) values ('$kode_lanjut','$npa','$tgl','$simp_wajib', '$simp_pokok', '$simp_sukarela', '$jumlah', '$ket', 'o')") or die(mysql_error());
			if ($exec){
			$exec = mysql_query("update anggota set tipe = 'p' where npa='$npa'")or die("data tidak berhasil di hapus");
			echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_anggota/tampil_out.php">';
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