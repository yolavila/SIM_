<?php
  include("../../db_config.php");//memanggil file koneksi database
	
//	$testing = mysql_query("select substring(no_simpanan,4) as no from simpanan order by no*1 DESC") or die(mysql_error());
	$testing = mysql_query("select npb from pembelian order by id_beli DESC") or die(mysql_error());
	$t = mysql_fetch_row($testing);
	$v = $t[0];
	$piece = explode("-", $v);
	$kode_lanjut = "B-".($piece[1] + 1);

	// contohh

		
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['npa'];
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pembelian/form_pembelian_barang.php?id=$npa\">";
  }
  
  
   if (isset($_POST['save'])){
	$npb=$kode_lanjut;
	$tgl=$_POST['tgl'];
	$ket=$_POST['ket'];
	$total=$_POST['total'];
	$kodeSuplier = $_POST['suplier_'];
	for ($i=0;$i<=100;$i++){
	$id_barang=$_POST['id_barang'.$i];
	$nama_barang=$_POST['nama_barang'.$i];
	$quatity=$_POST['quatity'.$i];
	$harga=$_POST['harga'.$i];
	$jumlah=$_POST['jumlah'.$i];
	
		if ($nama_barang != ""){
		mysql_query("insert into pembelian (npb, tgl, ket, id_barang, quatity, jumlah, kode_suplier) values ('$npb', '$tgl','$ket','$id_barang','$quatity','$jumlah', '$kodeSuplier')") or die(mysql_error());
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] + $quatity;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$id_barang'") or die(mysql_error());
	}
	}

	    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pembelian/form_pembelian_barang.php\">";
	} 

?>
