<?php
  include("../../db_config.php");//memanggil file koneksi database
	
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['struk'];
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pembelian/return_pembelian.php?id=$npa\">";
  }
  
  if (isset($_GET['action']) && ($_GET['action']=='return')){
	$npbx = $_GET['id_beli'];
	$idbrg = $_GET['id_barang'];
	
		$qry = mysql_query("SELECT p.id_beli idbeli, p.npb npb, p.id_barang id, mb.nama nm, mb.kode_suplier spl, p.quatity qty, mb.harga_beli harga, p.jumlah jml FROM `pembelian` p
							LEFT JOIN master_barang mb ON mb.id_barang = p.id_barang
							WHERE p.npb = '$npbx' LIMIT 0,1") or die(mysql_error());
			$datass = mysql_fetch_array($qry);
			
			$qty = $datass['qty'];
			$suplier = $datass['spl'];
			$tgl=$_POST['tgl'];
			$npb = $datass['npb'];
			$jumlah = $datass['jml'];
			$id_beli = $datass['idbeli'];
		mysql_query("insert into return_pembelian (kode_suplier, tgl, id_beli, id_barang, npb, quatity, jumlah) values ('$suplier', CURDATE( ), '$id_beli','$idbrg','$npb','$qty','$jumlah')") or die(mysql_error());	
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$idbrg'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] - $qty;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$idbrg'") or die(mysql_error());
		mysql_query("DELETE FROM `pembelian` WHERE `pembelian`.`id_beli` = '$id_beli' LIMIT 1") or die(mysql_query());
		
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pembelian/return_pembelian.php?id=$npbx\">";
  }
  
  
   if (isset($_POST['save'])){
	
 //	$no_return=$kode_lanjut;
	$struk  = $_POST['struk'];
	$suplier=$_POST['suplier'];
	$kdsuplier = $_POST['kdsuplier'];
	$kodeSuplier = $_POST['suplier_'];
	$tgl=$_POST['tgl'];
	$ket=$_POST['ket'];
	$total=$_POST['total'];
	for ($i=0;$i<=100;$i++){
	$id_barang=$_POST['id_barang'.$i];
	$nama_barang=$_POST['nama_barang'.$i];
	$quatity=$_POST['quatity'.$i];
	$qtyreturn=$_POST['qtyreturn'.$i];
	$harga=$_POST['harga'.$i];
	$jumlah=$_POST['jumlah'.$i];	
	$sisaqty = $quatity - $qtyreturn;
	$jmlreturn = $qtyreturn * $harga;
	
	if ($nama_barang != ""){
		mysql_query("insert into return_pembelian ( npb, kode_suplier, tgl, id_barang, quatity, jumlah) values ('$struk','$kdsuplier','$tgl','$id_barang','$qtyreturn','$jmlreturn')") or die(mysql_error());	$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		mysql_query("UPDATE pembelian SET quatity = '$sisaqty', jumlah = '$jumlah' WHERE npb='$struk' AND id_barang='$id_barang'");
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] - $qtyreturn;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$id_barang'") or die(mysql_error());
	}
	}

	    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_pembelian/return_pembelian.php\">";
	} 

?>
