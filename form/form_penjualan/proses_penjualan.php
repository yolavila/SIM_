<?php
  include("../../db_config.php");//memanggil file koneksi database
	
//	$testing = mysql_query("select substring(no_simpanan,4) as no from simpanan order by no*1 DESC") or die(mysql_error());
	$testing = mysql_query("select njb from penjualan order by id_jual DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	$piece = explode("-", $v);
	$kode_lanjut = "J-".($piece[1] + 1);

	// contohh

		
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['npa'];
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_penjualan/form_penjualan_barang.php?id=$npa\">";
  }
  
  
   if (isset($_POST['save'])){
  
	$njb=$kode_lanjut;
	$npa=$_POST['npa'];
	$tgl_jual=$_POST['tgl_jual'];
	$status=$_POST['status'];
	$total=$_POST['total'];
	for ($i=0;$i<=100;$i++){
	$id_barang=$_POST['id_barang'.$i];
	$nama_barang=$_POST['nama_barang'.$i];
	$quatity=$_POST['quatity'.$i];
	$harga=$_POST['harga'.$i];
	$jumlah=$_POST['jumlah'.$i];
	
	
	if ($nama_barang != ""){
		mysql_query("insert into penjualan (njb, npa, tgl_jual, status, id_barang, quatity, jumlah) values ('$njb', '$npa', '$tgl_jual','$status','$id_barang','$quatity','$jumlah')") or die(mysql_error());
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] - $quatity;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$id_barang'") or die(mysql_error());
	}
	}

	    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_penjualan/form_penjualan_barang.php\">";
	} 

?>
