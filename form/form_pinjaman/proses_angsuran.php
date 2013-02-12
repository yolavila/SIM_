<?php
  include("../../db_config.php");//memanggil file koneksi database

  if (isset($_POST['save'])){
	$x=$_POST['xangsuran'];
	for($i=1;$i<=$x;$i++)
	{
		echo $_POST['bayar_'.$i.''];
	}
  /*
 	$npa=$_POST['npa'];
	$no_pinjam=$_POST['no_pinjam'];
	$angsuran_ke=$_POST['angsuran_ke'];
	$tgl_pinjam=$_POST['tgl_pinjam'];
	$angsuran=$_POST['angsuran'];
  // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi
  //if($nama!="" && $email!="" && $website!="" && $pesan!="")
  
     //buat susunan query sql sementara dalam variabel
     mysql_query("insert into angsuran_uang ( npa, no_pinjam,angsuran, tgl_pinjam, angsuran) values ('$npa','$no_pinjam','$angsuran','$tgl_pinjam','$angsuran')") or die(mysql_error());
     //jalankan query
    // mysql_query($query) or die("Gagal menyimpan karena :".mysql_error());
     //or die digunakan untuk memunculkan pesan jika query gagal dijalankan
    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pinjaman/tampil_angsuran.php\">";
	*/
	} 

?>