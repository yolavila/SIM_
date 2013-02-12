<?php
  include("../../db_config.php");//memanggil file koneksi database
	
  if (isset($_POST['caribtn'])){
	$npa  = $_POST['struk'];
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_penjualan/return_penjualan.php?id=$npa\">";
  }
  
  if (isset($_GET['action']) && ($_GET['action']=='return')){
	$njbx = $_GET['id_jual'];
	$idbrg = $_GET['id_barang'];
	
		$qry = mysql_query("SELECT p.npa npa, p.id_jual idjual, p.njb njb, p.id_barang id, mb.nama nm, p.quatity qty, mb.harga_jual harga, p.jumlah jml FROM `penjualan` p
							LEFT JOIN master_barang mb ON mb.id_barang = p.id_barang
							WHERE p.njb = '$njbx' LIMIT 0,1") or die(mysql_error());
			$datass = mysql_fetch_array($qry);
			
			$npax = $datass['npa'];
			$qty = $datass['qty'];
			$suplier = $datass['spl'];
			$njb = $datass['njb'];
			$jumlah = $datass['jml'];
			$id_jual = $datass['idjual'];
		mysql_query("insert into return_penjualan (npa,tgl, id_barang, njb, quatity, jumlah) values ('$npax',CURDATE(),'$idbrg','$njb','$qty','$jumlah')") or die(mysql_error());	
		
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$idbrg'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] + $qty;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$idbrg'") or die(mysql_error());
		mysql_query("DELETE FROM `penjualan` WHERE `penjualan`.`id_jual` = '$id_jual' LIMIT 1") or die(mysql_query());
		
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_penjualan/return_penjualan.php?id=$njbx\">";
  }
  
  
   if (isset($_POST['save'])){
	
 //	$no_return=$kode_lanjut;
	$struk  = $_POST['struk'];
	$npa = $_POST['npa'];
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
		if ($qtyreturn!=0){
		mysql_query("insert into return_penjualan ( njb, npa, tgl, id_barang, quatity, jumlah) values ('$struk','$npa','$tgl','$id_barang','$qtyreturn','$jmlreturn')") or die(mysql_error());	$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		}
		mysql_query("UPDATE penjualan SET quatity = '$sisaqty', jumlah = '$jumlah' WHERE njb='$struk' AND id_barang='$id_barang'");
		$query0 = mysql_query("select jumlah from master_barang where id_barang = '$id_barang'");
		$data = mysql_fetch_array($query0);
		$barangskr = $data['jumlah'] + $qtyreturn;
		$query2 = mysql_query("UPDATE master_barang SET jumlah = '$barangskr' WHERE id_barang = '$id_barang'") or die(mysql_error());
	}
	}

	    echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //Pesan tulisan dengan format H2 ini akan muncul jika berhasil
	echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/form/form_penjualan/return_penjualan.php\">";
	} 

?>
