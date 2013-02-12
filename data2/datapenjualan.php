<?php
$namabarang = $_GET['nama'];
$namabrg= "";
$satuan = "";
$harga	= "";

include "../db_config.php";

$getdata = mysql_query("SELECT nama, satuan, harga_jual FROM master_barang WHERE nama like '%$namabarang%'");
$data = mysql_fetch_array($getdata);

$namabrg = $data['nama'];
$satuan  = $data['satuan'];
$harga	 = $data['harga_jual'];

header("content-type: text/xml");
echo "
<xmlresponse>
<data>$namabrg</data>
<data>$satuan</data>
<data>$harga</data>
</xmlresponse>
";

?>