<?php
$namabarang = $_GET['nama'];
$namabrg= "";
$id_barang = "";
$harga	= "";

include "../../db_config.php";

$getdata = mysql_query("SELECT nama, id_barang, harga_jual FROM master_barang WHERE nama like '%$namabarang%'");
$data = mysql_fetch_array($getdata);

$namabrg = $data['nama'];
$id_barang  = $data['id_barang'];
$harga	 = $data['harga_jual'];

header("content-type: text/xml");
echo "
<xmlresponse>
<data>$namabrg</data>
<data>$id_barang</data>
<data>$harga</data>
</xmlresponse>
";

?>