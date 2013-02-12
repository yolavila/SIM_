<?php
  include("../../db_config.php");//memanggil file koneksi database
	
	$testing = mysql_query("select substring(no_pinjam,4) as no from pinjaman_uang order by no*1 DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	//$piece = explode("-", $v);
	$kode_lanjut = "PU-".($v + 1);
	
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
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/pinjaman_uang.php?id=$npa\">";
	}
	else
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/pinjaman_uang.php?ket=pasif\">";
	}
  }else{
	
 	$no_pinjam=$kode_lanjut;
	$npa=$_POST['npa'];
	$nama=$_POST['nama'];
	$instansi=$_POST['instansi'];
	$tgl_pinjam=$_POST['tgl_pinjam'];
	$jenis_bayar=$_POST['jenis_bayar'];
	$jenis_pinjaman=$_POST['jenis_pinjaman'];
	$pinjaman_pokok=$_POST['pinjaman_pokok'];
	$jasa=$_POST['jasa'];
	$xangsuran=$_POST['xangsuran'];
	$angsuran=$_POST['angsuran'];
	$tot_jasa=$_POST['tot_jasa'];
	$tot_angsuran=$_POST['tot_angsuran'];
	$tgl_mulai=$_POST['tgl_mulai'];
	$tgl_selesai=$_POST['tgl_selesai'];

  	if (isset($_POST['update'])){
				$exec=mysql_query("update pinjaman_uang set 
									npa = '$npa',
									tgl_pinjam = '$tgl_pinjam',
									jenis_bayar = '$jenis_bayar',
									jenis_pinjaman = '$jenis_pinjaman',
									pinjaman_pokok = '$pinjaman_pokok',
									jasa = '$jasa',
									xangsuran = '$xangsuran',
									angsuran = '$angsuran',
									tot_jasa = '$tot_jasa',
									tot_angsuran = '$tot_angsuran',
									tgl_mulai = '$tgl_mulai',
									tgl_selesai = '$tgl_selesai'
									where npa='$npa'") or die (mysql_error());
			if ($exec){	
				echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_pinjaman/tampil_pinjaman.php">';
			}else{
				echo "gagal mengupdate";
			}
		} else if (isset($_POST['save'])){
	$exec = mysql_query("insert into pinjaman_uang ( no_pinjam, npa,tgl_pinjam, jenis_bayar, jenis_pinjaman, pinjaman_pokok, jasa, xangsuran, angsuran, tot_jasa,tot_angsuran,tgl_mulai, tgl_selesai) values ('$no_pinjam','$npa','$tgl_pinjam','$jenis_bayar','$jenis_pinjaman','$pinjaman_pokok','$jasa','$xangsuran','$angsuran','$tot_jasa','$tot_angsuran','$tgl_mulai','$tgl_selesai')") or die(mysql_error());
	for($i=1; $i<=$xangsuran; $i++){
	mysql_query("insert into angsuran_uang ( npa, no_pinjam, tgl_pinjam, angsuran, bayar) values ('$npa','$no_pinjam', DATE_ADD('$tgl_mulai', INTERVAL '$i' MONTH),'$angsuran','0')") or die(mysql_error());			
	}
	if ($exec){	
				echo '<meta http-equiv="refresh" content="0;url=http://localhost/skripsi/form/form_pinjaman/pinjaman_uang.php">';
			}else{
				echo "gagal menyimpan";
			}
		}
		
}
?>

<?
     //buat susunan query sql sementara dalam variabel
//     mysql_query("insert into pinjaman_uang ( no_pinjam, npa, nama, instansi, tgl_pinjam, jenis_bayar, jenis_pinjaman, pinjaman_pokok, jasa, xangsuran, angsuran, tot_jasa,tot_angsuran,tgl_mulai, tgl_selesai) values ('$no_pinjam','$npa','$nama','$instansi','$tgl_pinjam','$jenis_bayar','$jenis_pinjaman','$pinjaman_pokok','$jasa','$xangsuran','$angsuran','$tot_jasa','$tot_angsuran','$tgl_mulai','$tgl_selesai')") or die(mysql_error());
//	 for($i=1; $i<=$xangsuran; $i++){
//		mysql_query("insert into angsuran_uang ( npa, no_pinjam, angsuran_ke, tgl_pinjam, angsuran, bayar) values ('$npa','$no_pinjam','angsuran_ke', DATE_ADD('$tgl_mulai', INTERVAL '$i' MONTH),'$angsuran','0')") or die(mysql_error());
	//}
	//jalankan query
    // mysql_query($query) or die("Gagal menyimpan karena :".mysql_error());
     //or die digunakan untuk memunculkan pesan jika query gagal dijalankan
//    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
//	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/tampil_pinjaman.php\">";
//	} 

?>